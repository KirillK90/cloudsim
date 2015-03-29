<?php

class CDbMultiInsertCommand extends CDbCommand{

    /** @var CActiveRecord $class */
    private $class;

    /** @var string $insert_template */
    private $insert_template = "INSERT INTO %s(%s) ";

    /** @var string $value_template */
    private $value_template = "(%s)";

    /** @var string $query */
    public $query;

    /** @var array */
    public $rows = array();

    public $bulk = true;

    /** @var CDbColumnSchema[] $columns */
    private $columns;

    /** @var boolean $fresh */
    public $fresh;

    private $withId = false;
    private $replaceId = '_id';

    /** @param CActiveRecord $model
     */
    public function __construct($model, $withId = false, $idName = false)
    {
        $this->class = $model;
        $this->withId = $withId;
        $this->replaceId = $idName;
        $this->createTemplate();

        parent::__construct($model->getDbConnection());
    }

    private function createTemplate()
    {
        $this->fresh = true;
        $this->columns = $this->class->getMetaData()->tableSchema->columns;
        $counter = 0;
        $value_template = array();
        $columns_string = array();
        foreach($this->columns as $column){
            /** @var CDbColumnSchema $column */
            if($column->autoIncrement) {
                if ($this->withId) {
                    $value_template[] = "%d";
                } else {
                    continue;
                }
            } else {
                $value_template[] = "%s";
            }
            $columns_string[] = $column->rawName;
            $counter ++;
        }
        $value_template = implode(', ', $value_template);
        $columns_string = implode(', ', $columns_string);
        $this->insert_template = sprintf($this->insert_template, $this->class->tableName(), $columns_string);
        $this->value_template = sprintf($this->value_template, $value_template);
    }

    /** @param boolean $validate
     * @param CActiveRecord $record
     * @return bool
     */
    public function add($record, $validate = true)
    {
        $values = array();
        if($validate){
            if(!$record->validate()){
                return false;
            }
        }
        $counter = 0;
        foreach($this->columns as $column){
            if($column->autoIncrement && !$this->withId){
                continue;
            }

            $values[$counter] = $this->prepareValue($record->{$column->name}, $column->type);
            $counter ++;
        }

        $this->fresh = false;
        $this->rows[] = vsprintf($this->value_template, $values);
        return true;
    }

    public function getSql($old = false)
    {
        if ($this->replaceId) {
            $this->insert_template = str_replace('`id`', "`{$this->replaceId}`", $this->insert_template);
        }
        if ($old) {
            return $this->insert_template." VALUES ".implode(";\n{$this->insert_template} VALUES ", $this->rows).';';
        } else {
            return $this->insert_template." VALUES ".implode(",\n", $this->rows).';';
        }

    }

    public function execute()
    {
        $this->setText($this->insert_template." VALUES ".implode(",\n", $this->rows));
        return parent::execute();
    }

    private function prepareValue($value, $type)
    {
        if (is_null($value)) {
            return 'null';
        } elseif ($type == 'boolean') {
            return $value ? 'true' : 'false';
        } elseif ($type == 'string') {
            return "'".pg_escape_string($value)."'";
        } else {
            return $value;
        }
    }
}
