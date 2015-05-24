<?php

/**
 * This is the model class for table "task_data".
 *
 * The followings are the available columns in table 'task_data':
 * @property integer $id
 * @property integer $task_id
 * @property string $description
 * @property integer $index_nano_n
 * @property integer $index_nano_m
 * @property double $length_link
 * @property double $indent_radius_inside
 * @property double $indent_radius_outwards
 *
 * The followings are the available model relations:
 * @property Task $task
 */
class TaskData extends UActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, index_nano_n, index_nano_m, length_link, indent_radius_inside, indent_radius_outwards', 'required'),
			array('task_id, index_nano_n, index_nano_m', 'numerical', 'integerOnly'=>true),
			array('length_link, indent_radius_inside, indent_radius_outwards', 'numerical'),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, description, index_nano_n, index_nano_m, length_link, indent_radius_inside, indent_radius_outwards', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'task' => array(self::BELONGS_TO, 'Task', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => 'Task',
			'description' => 'Description',
			'index_nano_n' => 'Index Nano N',
			'index_nano_m' => 'Index Nano M',
			'length_link' => 'Length Link',
			'indent_radius_inside' => 'Indent Radius Inside',
			'indent_radius_outwards' => 'Indent Radius Outwards',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('index_nano_n',$this->index_nano_n);
		$criteria->compare('index_nano_m',$this->index_nano_m);
		$criteria->compare('length_link',$this->length_link);
		$criteria->compare('indent_radius_inside',$this->indent_radius_inside);
		$criteria->compare('indent_radius_outwards',$this->indent_radius_outwards);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
