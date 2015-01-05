<?php

class CDbMultiInsertCommand extends CDbCommand{

    /** @var CActiveRecord $class */
    private $class;

    /** @var string $insert_template */
    private $insert_template = "insert into %s(%s) ";

    /** @var string $value_template */
    private $value_template = "(%s)";

    /** @var string $query */
    public $query;

    /** @var CDbColumnSchema[] $columns */
    private $columns;

    /** @var boolean $fresh */
    private $fresh;

    /** @param CActiveRecord $model
     */
    public function __construct($model)
    {
        $this->class = $model;
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
            if($column->autoIncrement){
                continue;
            }
            else if($column->type == "integer" || $column->type == "boolean") {
                $value_template[] = "%d";
            }
            else if($column->type == "float" || $column->type == "double") {
                $value_template[] = "%f";
            }
            else{
                $value_template[] = "%s";
            }
            $columns_string[] = $column->name;
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
            if($column->autoIncrement){
                continue;
            }
            $values[$counter] = $this->prepareValue($record->{$column->name});
            $counter ++;
        }
        if(!$this->fresh){
            $this->query .= ",";
        }
        else{
            $this->query = "values";
        }
        $this->fresh = false;
        $this->query .= vsprintf($this->value_template, $values);
        return true;
    }

    public function execute()
    {
        $this->setText($this->insert_template." ".$this->query);
        return parent::execute();
    }

    private function prepareValue($value)
    {
        if (is_null($value)) {
            return 'null';
        } elseif (is_string($value)) {
            return "'".str_replace("'", "''", $value)."'";
        } else {
            return $value;
        }
    }
}
