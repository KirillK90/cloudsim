<?php

class UsersController extends UController
{

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{

		return array(
			array(
				'allow',
				'users' => array(UserAccessTypes::AUTH),
				'expression' => function(UWebUser $user) {
					// Если у пользователя нет нужного уровня - блочим (админка)
					return $user->getModel()->isAdmin();
				}
			),
			array('deny'),
		);
	}


	public function actionIndex()
	{
		$model = new Users('search');
		$model->unsetAttributes();
		if ($model->getQueryData()) {
			$model->attributes = $model->getQueryData();
		}

		$this->pageTitle='Пользователи';
		$this->breadcrumbs= array($this->pageTitle);

		$this->render('index', compact('model'));
	}

	public function actionCreate()
	{
		$model = new Users();

        $this->performAjaxValidation($model);

		if ($model->getFormData()) {
			$model->attributes = $model->getFormData();

			if($model->save()) {
				$this->setFlash('success', ACTION_CREATE_SUCCESS);
				$this->redirect(array('index'));
			} else {
				$this->setFlash('error', ACTION_VALIDATE_ERROR);
				HDev::log($model->getErrors());
			}
		}

		$this->pageTitle='Создание пользователя';

		$this->breadcrumbs = array(
			'Пользователи' => array('index'),
			$this->pageTitle
		);

		$this->render('form', compact('model'));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model);

		if ($model->getFormData()) {
			$model->attributes = $model->getFormData();

			if($model->save()) {
				$this->setFlash('success', ACTION_CREATE_SUCCESS);
				$this->redirect(array('index'));
			} else {
				$this->setFlash('error', ACTION_VALIDATE_ERROR);
				HDev::log($model->getErrors());
			}
		}

		$this->pageTitle='Изменение пользователя';

		$this->breadcrumbs = array(
			'Пользователи' => array('index'),
			$this->pageTitle
		);

		$this->render('form', compact('model'));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		if (Yii::app()->user->id == $model->id)
			throw new CHttpException(403, 'Суицид - это не выход.');

		$model->delete();
	}

	/**
	 * @param $id
	 * @return Users
	 * @throws CHttpException
	 */
	protected function loadModel($id)
	{
		$model = Users::model()->findByPk($id);
		if (!$model)
			throw new CHttpException(404, 'Пользователь не найден');

		return $model;
	}

	public function actionLogin($id)
	{
		$virtualModeOwner = Yii::app()->user->id;

		$this->virtualMode($id, $virtualModeOwner);

		Yii::app()->controller->redirect(Yii::app()->homeUrl);
	}

	public function actionLogout()
	{
		$id = Yii::app()->user->getState('virtualModeOwner');

		$this->virtualMode($id, false);

		Yii::app()->controller->redirect(Yii::app()->homeUrl);
	}


	/**
	 * @param integer $loginUserId
	 * @param mixed $virtualModeOwner - id of owner or false
	 * @return bool
	 */
	private function virtualMode($loginUserId, $virtualModeOwner)
	{
		$identity=new UUserIdentity("","",$loginUserId);
		$identity->authenticate();

		if($identity->errorCode===UUserIdentity::ERROR_NONE)
		{
			if ($virtualModeOwner) {
				$identity->setVirtualMode($virtualModeOwner);
			}

			Yii::app()->user->logout();

			$result = Yii::app()->user->login($identity);

			return $result;
		}

		return false;

	}
}