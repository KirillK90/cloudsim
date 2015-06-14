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
                $this->redirect(array('update', 'id' => $model->id));
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

        $this->render('tabs', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if ($model->getFormData() || $model->data->getFormData()) {
            $model->attributes = $model->getFormData();
            $model->data->attributes = $model->data->getFormData();

            $model->type = TaskType::LENYA_TASK;
            $model->status = TaskStatus::NEW_ONE;
            $model->users_id = $this->getUser()->id;

            if($model->data->validate() && $model->save()) {
                $this->setFlash('success', ACTION_CREATE_SUCCESS);
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
                HDev::log($model->getErrors());
                HDev::log($model->data->getErrors());
            }
        }

        $this->pageTitle='Изменение задачи';

        $this->breadcrumbs = array(
            'Задачи' => array('index'),
            $this->pageTitle
        );

        $this->render('tabs', compact('model'));
    }
    public function actionResult($id){

        $model = $this->loadModel($id);

        $this->pageTitle='График квантово-механического рассчета зонной структуры углеродной нанотрубки';
        $this->breadcrumbs = array($this->pageTitle);

        $this->render('result', compact('model'));
    }

    /**
     * @param $id
     * @return Task
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Task::model()->findByPk($id);
        if (!$model)
            throw new CHttpException(404, 'Задача не найдена');

        return $model;
    }
}

