<?php

class IndexController extends UController
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

	public function actionIndex()
	{
		$this->pageTitle = 'Домашняя страница';
		$this->breadcrumbs = array($this->pageTitle);

		$this->render('index');
	}
}