<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 24.05.15
 * Time: 4:11
 */
class TaskForm extends CFormModel
{

    public $email;
    public $password;

    private $_identity;

    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('email', 'email'),
        );
    }

    public function setUser(Users $user) {
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UUserIdentity($this->email,$this->password);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UUserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity, 3600 * 24 * 365 * 10);
            return true;
        }
        elseif ($this->_identity->errorCode === UUserIdentity::ERROR_USERNAME_INVALID) {
            $this->addError('email', 'Пользовтель не найден');
        }
        elseif ($this->_identity->errorCode === UUserIdentity::ERROR_PASSWORD_INVALID) {
            $this->addError('password', 'Неправильный пароль');
        }

        return false;
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'E-mail',
            'password' => 'Пароль',
        );
    }

}