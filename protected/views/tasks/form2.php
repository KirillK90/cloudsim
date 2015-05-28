<?php
/**
 * @var $this TasksController
 * @var $model Task
 * @var TbActiveForm $form
 */

echo $form->textFieldControlGroup($model->data, 'nuclear_charge');
echo $form->textFieldControlGroup($model->data, 'valence_electrons');
echo $form->textFieldControlGroup($model->data, 's_orbital');
echo $form->textFieldControlGroup($model->data, 'p_orbital');
echo $form->textFieldControlGroup($model->data, 'd_orbital');
echo $form->textFieldControlGroup($model->data, 'f_orbital');
echo $form->textFieldControlGroup($model->data, 'g_orbital');

