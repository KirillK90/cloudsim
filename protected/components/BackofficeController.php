<?php

/**
 * Базовый класс для контроллера бэкофиса.
 * Доступ к контроллерам, наследующим этот класс, возможен только для админов.
 */
class BackofficeController extends UController {

    public $layout = '//layouts/backoffice';
    
    public $buttons = array();

    public function filters() {
        return array(
            'accessControl',
        );
    }

    protected function beforeRender($view)
    {
        Yii::app()->clientScript->registerPackage('admin');
        return parent::beforeRender($view);
    }


    public function accessRules(){
        return array(
            array('allow',
                'expression' => function(UWebUser $user) {
                    // Если у пользователя нет нужного уровня - блочим (админка)
                    return $user->getModel()->isAdmin();
                },
            ),
            array('deny'),
        );
    }
}