<?php
/**
 * @var $this TasksController
 * @var $model Task
 * @var TbActiveForm $form
 */

echo $form->textFieldControlGroup($model, 'name');
echo $form->textFieldControlGroup($model->data, 'description');
echo $form->textFieldControlGroup($model->data, 'index_nano_n');
echo $form->textFieldControlGroup($model->data, 'index_nano_m');
echo $form->textFieldControlGroup($model->data, 'length_link');
echo $form->textFieldControlGroup($model->data, 'indent_radius_inside');
echo $form->textFieldControlGroup($model->data, 'indent_radius_outwards');
