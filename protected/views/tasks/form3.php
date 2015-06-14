<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 26.05.15
 * Time: 10:14
 */
/**
 * @var $this TasksController
 * @var $model Task
 * @var TbActiveForm $form
 */
//echo $form ->label($model->data, 'auto_calculate' );
echo $form->textFieldControlGroup($model->data, 'max_energy');
echo $form->textFieldControlGroup($model->data, 'accuracy_calculation');
echo $form->textFieldControlGroup($model->data, 'number_points');
echo $form->textFieldControlGroup($model->data, 'max_energy_graph');
echo $form->textFieldControlGroup($model->data, 'min_energy_graph');
echo $form->textFieldControlGroup($model->data, 'time_calculation');
echo $form->checkBoxControlGroup($model->data, 'auto_calculate');
echo $form->checkBoxControlGroup($model->data, 'calculation_zone');
