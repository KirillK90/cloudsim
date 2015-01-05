<?php

class UUserIdentity extends CUserIdentity
{

    private $_id;
    private $_forceId;


    /**
     * Override Constructor.
     * @param string $username username
     * @param string $password password
     * @param mixed $forceId - id of user or false
     */
    public function __construct($username,$password,$forceId = false)
    {
        $this->username=$username;
        $this->password=$password;
        $this->_forceId = $forceId;
    }

    /**
     * Authenticates a user.
     * @return integer $errorCode whether authentication succeeds.
     */
    public function authenticate()
    {
        if (!$this->_forceId) {
            /** @var Users $model */
            $model = Users::model()->findByAttributes(array('email' => $this->username));

            if(!$model) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } elseif($model->password !== UserHelper::hash($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $model->id;
                $this->errorCode = self::ERROR_NONE;
            }
        } else {
            $record = Users::model()->findByPk($this->_forceId);

            if($record===null) {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            } else {
                $this->_id=$record->id;
                $this->errorCode=self::ERROR_NONE;
            }
        }

        return !$this->errorCode;
    }

    public function setVirtualMode($ownerId)
    {
        $this->setState('virtualMode', true);
        $this->setState('virtualModeOwner', $ownerId);
    }

    public function getId()
    {
        return $this->_id;
    }
}