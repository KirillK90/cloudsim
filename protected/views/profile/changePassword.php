<?php
/**
 * @var $this ProfileController
 * @var $model Users
 */

$this->widget('TbAlert');

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));

echo $form->passwordFieldControlGroup($model, 'oldPassword');
echo $form->passwordFieldControlGroup($model, 'newPassword');
echo $form->passwordFieldControlGroup($model, 'verifyPassword');

echo TbHtml::formActions(array(
    TbHtml::submitButton('Сохранить', array('color' => TbHtml::ALERT_COLOR_SUCCESS)),
    TbHtml::resetButton('Отмена')
));
$this->endWidget();
