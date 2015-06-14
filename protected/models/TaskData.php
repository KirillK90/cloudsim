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
 * @property integer $nuclear_charge
 * @property integer $valence_electrons
 * @property double $s_orbital
 * @property double $p_orbital
 * @property double $d_orbital
 * @property double $f_orbital
 * @property double $g_orbital
 * @property boolean $auto_calculate
 * @property integer $max_energy
 * @property double $accuracy_calculation
 * @property integer $number_points
 * @property boolean $calculation_zone
 * @property integer $max_energy_graph
 * @property integer $min_energy_graph
 * @property integer $time_calculation
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
			array('description, index_nano_n, index_nano_m, length_link, indent_radius_inside, indent_radius_outwards, nuclear_charge, valence_electrons, s_orbital, p_orbital, d_orbital, f_orbital, g_orbital, auto_calculate, max_energy, accuracy_calculation, number_points, calculation_zone, max_energy_graph, min_energy_graph, time_calculation', 'required'),
			array('task_id, index_nano_n, index_nano_m, nuclear_charge, valence_electrons, max_energy, number_points, max_energy_graph, min_energy_graph, time_calculation', 'numerical', 'integerOnly'=>true),
			array('length_link, indent_radius_inside, indent_radius_outwards, s_orbital, p_orbital, d_orbital, f_orbital, g_orbital, accuracy_calculation', 'numerical'),
			array('description', 'length', 'max'=>255),
			array('auto_calculate, calculation_zone', 'boolean'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, description, index_nano_n, index_nano_m, length_link, indent_radius_inside, indent_radius_outwards, nuclear_charge, valence_electrons, s_orbital, p_orbital, d_orbital, f_orbital, g_orbital, auto_calculate, max_energy, accuracy_calculation, number_points, calculation_zone, max_energy_graph, min_energy_graph, time_calculation', 'safe', 'on'=>'search'),
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
			'description' => 'Описание проекта',
			'index_nano_n' => 'Индекс нанотрубки N',
			'index_nano_m' => 'Индекс нанотрубки M',
			'length_link' => 'Длина связи С-С',
			'indent_radius_inside' => 'Отступ от радиуса внутрь',
			'indent_radius_outwards' => 'Отступ от радиуса наружу',
			'nuclear_charge' => 'Заряд ядра',
			'valence_electrons' => 'Валентных электронов',
			's_orbital' => 'Энергия s орбитали',
			'p_orbital' => 'Энергия p орбитали',
			'd_orbital' => 'Энергия d орбитали',
			'f_orbital' => 'Энергия f орбитали',
			'g_orbital' => 'Энергия g орбитали',
			'auto_calculate' => 'Автоматически рассчитывать координаты атомов',
			'max_energy' => 'Максимальная энергия для которой ищутся базисные функции(Энергия обрезания)',
			'accuracy_calculation' => 'Точность вычисления двойных интегралов и сходимости по 1',
			'number_points' => 'Начальное колличество точек рассчета в зоне Бриллюэна',
			'calculation_zone' => 'Рассчет по полной зоне Бриллюэна(-pi/c -pi/c)',
			'max_energy_graph' => 'Максимальное значение энергии на графике',
			'min_energy_graph' => 'Минимальное значение энергии на графике',
			'time_calculation' => 'Ограничение времени рассчета(минут)',

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
		$criteria->compare('nuclear_charge',$this->nuclear_charge);
		$criteria->compare('valence_electrons',$this->valence_electrons);
		$criteria->compare('s_orbital',$this->s_orbital);
		$criteria->compare('p_orbital',$this->p_orbital);
		$criteria->compare('d_orbital',$this->d_orbital);
		$criteria->compare('f_orbital',$this->f_orbital);
		$criteria->compare('g_orbital',$this->g_orbital);
		$criteria->compare('auto_calculate',$this->auto_calculate);
		$criteria->compare('max_energy',$this->max_energy);
		$criteria->compare('accuracy_calculation',$this->accuracy_calculation);
		$criteria->compare('number_points',$this->number_points);
		$criteria->compare('calculation_zone',$this->calculation_zone);
		$criteria->compare('max_energy_graph',$this->max_energy_graph);
		$criteria->compare('min_energy_graph',$this->min_energy_graph);
		$criteria->compare('time_calculation',$this->time_calculation);

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
