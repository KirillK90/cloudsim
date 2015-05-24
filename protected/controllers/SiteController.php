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

    public function actionRegistration()
    {
        $model = new RegistrationForm;

        $this->performAjaxValidation($model);

        if ($model->getFormData()) {
            $model->attributes = $model->getFormData();
            if ($model->validate() && $model->registration()) {
                $this->setFlash('success', "Регистрация пройдена успешно" );
                $this->redirect(array('registrationSuccess'));
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
                HDev::log($model->errors);
            }
        }
        $this->render('registration', compact('model'));


    }

    public function actionRegistrationSuccess()
    {
        $this->render('registrationSuccess');
    }

    public function actionActivate($key)
    {
        /** @var Users $model */
        $model = Users::model()->findByAttributes(array('activation_key' => $key));
        if (!$model) {
            throw new CHttpException(404, 'Пользователь не найден');
        }

        $model->status = 1;
        if (!$model->save()) {
            HDev::logSaveError($model);
        }
        $this->render('activate');
    }


    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


}