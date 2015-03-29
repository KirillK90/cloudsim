<?php

class SiteController extends UController
{
    public function actionIndex()
    {
        if ($this->getUser()->isGuest()) {
            $this->redirect(array('login'));
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin()
    {
    	$model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}