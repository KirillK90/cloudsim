<?php

class ProfileController extends UController
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
			),
			array('deny'),
		);
	}

	public function actionUpdate()
	{
		$model = $this->getUser();

		if ($model->getFormData()) {
			$model->name = $model->getFormData('name');
			if ($model->save()) {
				$this->setFlash('success', ACTION_UPDATE_SUCCESS);
			} else {
				$this->setFlash('error', ACTION_VALIDATE_ERROR);
			}
		}


		$this->pageTitle = 'Профиль';
		$this->breadcrumbs = array($this->pageTitle);

		$this->render('update', compact('model'));
	}

	public function actionChangePassword()
	{
		$model = $this->getUser();
		$model->setScenario('changePassword');

		if ($model->getFormData()) {
			$model->attributes = $model->getFormData();
			if ($model->save()) {
				$this->setFlash('success', ACTION_UPDATE_SUCCESS);
			} else {
				$this->setFlash('error', ACTION_VALIDATE_ERROR);
			}
		}


		$this->pageTitle = 'Смена пароля';
		$this->breadcrumbs = array(
			'Профиль' => '/profile/update',
			$this->pageTitle
		);

		$this->render('changePassword', compact('model'));
	}
}