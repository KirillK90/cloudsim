<?php

class SectionsController extends UController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
		$model = new Sections('search');
		$model->unsetAttributes();
		if ($model->getQueryData()) {
			$model->attributes = $model->getQueryData();
		}

		$this->pageTitle='Разделы';
		$this->breadcrumbs= array($this->pageTitle);

		$this->render('index', compact('model'));
	}

	public function actionCreate()
	{
		$model = new Sections();

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

		$this->pageTitle='Добавление раздела';

		$this->breadcrumbs = array(
			'Разделы' => array('index'),
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
			}
		}

		$this->pageTitle='Изменение раздела';

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
		$model = Sections::model()->findByPk($id);
		if (!$model)
			throw new CHttpException(404, 'Раздел не найден');

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sections $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sections-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
