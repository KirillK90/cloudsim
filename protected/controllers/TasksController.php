<?php

class TasksController extends UController
{
	public function actionIndex()
	{
        $model = new Task('search');

        $model->unsetAttributes();
        if ($model->getQueryData()) {
            $model->attributes = $model->getQueryData();
        }
        if (!$this->getUser()->isAdmin()) {
            $model->users_id = $this->getUser()->id;
        }

        $this->pageTitle='Задачи';
        $this->breadcrumbs = array($this->pageTitle);

		$this->render('index', compact('model'));
	}

    public function actionCreate()
    {
        $model = new Task();
        $model->data = new TaskData();

        $this->performAjaxValidation($model);



        if ($model->getFormData() || $model->data->getFormData()) {
            $model->attributes = $model->getFormData();
            $model->data->attributes = $model->data->getFormData();

            $model->type = TaskType::LENYA_TASK;
            $model->status = TaskStatus::NEW_ONE;
            $model->users_id = $this->getUser()->id;

            if($model->data->validate() && $model->save()) {
                $this->setFlash('success', ACTION_CREATE_SUCCESS);
                $this->redirect(array('index'));
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
                HDev::log($model->getErrors());
                HDev::log($model->data->getErrors());
            }
        }

        $this->pageTitle='Создание задачи';

        $this->breadcrumbs = array(
            'Задачи' => array('index'),
            $this->pageTitle
        );

        $this->render('create', compact('model'));
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

        $this->pageTitle='Изменение задачи';

        $this->breadcrumbs = array(
            'Задачи' => array('index'),
            $this->pageTitle
        );

        $this->render('form', compact('model'));
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}