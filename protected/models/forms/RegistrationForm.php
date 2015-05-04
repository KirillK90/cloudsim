<?php

class RegistrationForm extends UFormModel
{
    public $name;
    public $email;
    public $password;
    public $password2;



    private $_identity;

    public function rules()
    {
        return array(
            array('name, email, password, password2', 'required'),
            array('password2', 'compare', 'compareAttribute' => 'password'),
            array('email', 'email'),
            array('email', 'unique', 'className' => 'Users', 'attributeName' => 'email' ),
        );
    }

    public function setUser(Users $user) {
        $this->email = $user->email;
        $this->password = $user->password;

    }

    public function registration()
    {
        $model = new Users();

        /* присвоим нужные поля */
        $model->email  = $this->email;
        $model->name  = $this->name;
        $model->password    = $this->password;
        $model->role    = UserRole::USER;
        //$model->name   = (string) str_replace(" ","",$_POST['Users']['name']);
        //$model->role = (int) 1;
        /* Если запрос прошел валидацию */
        if(!$model->save()) {
            HDev::logSaveError($model);
            return false;
        }


        return true;


        // return true;
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
        );
    }

}