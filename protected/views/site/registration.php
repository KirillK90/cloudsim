<?php
/**
 * @var $this UController
 * @var $model LoginForm
 */

$this->pageTitle = 'Регистрация';

$this->widget('TbAlert');

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));
echo $form->textFieldControlGroup($model, 'name');
echo $form->textFieldControlGroup($model, 'email');
echo $form->passwordFieldControlGroup($model, 'password');
echo $form->passwordFieldControlGroup($model, 'password2');


echo TbHtml::formActions(array(
    TbHtml::submitButton('Регистрация', array('color' => TbHtml::BUTTON_COLOR_SUCCESS)),
));
$this->endWidget();
