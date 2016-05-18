<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $created
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $role
 * @property string $status
 * @property string $activation_key
 */
class Users extends UActiveRecord
{
	public $oldPassword;
	public $newPassword;
	public $verifyPassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, name, role', 'required'),
			array('password', 'required', 'on' => 'insert'),
			array('password', 'length', 'min' => 6, 'max' => 32, 'on' => 'insert'),
			array('newPassword', 'length', 'max' => 32),
			array('email', 'length', 'max'=>64),
			array('email', 'unique', 'caseSensitive' => false),
			array('name, newPassword, role', 'length', 'max'=>32),
			array('role', 'in', 'range'=> UserRole::getValues()),
			array('oldPassword, newPassword, verifyPassword', 'required', 'on' => 'changePassword'),
			array('oldPassword', 'match', 'on' => 'changePassword'),
			array('verifyPassword', 'compare', 'compareAttribute'=>'newPassword','message'=>'Пароли не совпадают'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created, email, name, password, role', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'match' validator as declared in rules().
	 */
	public function match($attribute,$params)
	{
		if ($this->password != UserHelper::hash($this->oldPassword))
			$this->addError('oldPassword','Текущий пароль указан неверно');
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Создан',
			'email' => 'Email',
			'name' => 'Имя',
			'password' => 'Пароль',
			'oldPassword' => 'Старый пароль',
			'newPassword' => 'Новый пароль',
			'verifyPassword' => 'Повтор пароля',
			'role' => 'Роль',
		);
	}

	public function beforeSave()
	{
		if ($this->newPassword)
			$this->password = UserHelper::hash($this->newPassword);

		if ($this->isAttributeSafe('password'))
			$this->password = UserHelper::hash($this->password);

		return parent::beforeSave();
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function setPassword($password)
	{
		$this->password = md5($password);
	}

	public function isGuest() {
		return $this->role == UserRole::GUEST;
	}

	public function isAdmin() {
		return $this->role == UserRole::ADMIN;
	}

	public function getName()
	{
		return $this->name ? $this->name : $this->email;
	}

}
