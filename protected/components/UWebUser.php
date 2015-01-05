<?php

class UWebUser extends CWebUser
{
    /** @var Users  */
    protected $model = null;

    public function getModel()
    {
        if ($this->id) {
            if (!$this->model || $this->model->id != $this->id) {
                $this->model = Users::model()->findByPk($this->id);
                if (!$this->model) {
                    $this->logout();
                    $this->loginRequired();
                }
            }
        }
        
        if (!$this->model) {
            $this->model = new Users;
            $this->model->role = UserRole::GUEST;
        }

        return $this->model;
    }

    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (CException $e) {
            $model = $this->getModel();
            if (!$model) throw $e;

            return $model->{$name};
        }
    }
 
    public function __set($name, $value)
    {
        try {
            return parent::__set($name, $value);
        } catch (CException $e) {
            $model = $this->getModel();
            if (!$model) throw $e;

            $model->{$name} = $value;
        }
    }

    public function __call($name, $parameters)
    {
        try {
            return parent::__call($name, $parameters);  
        } catch (CException $e) {
            $model = $this->getModel();
            if (!$model) throw $e;

            return call_user_func_array(array($model, $name), $parameters);
        }
    }

    public function login($identity, $duration = WEBUSER_SESSION_DURATION)
    {
        return parent::login($identity,$duration);
    }

}