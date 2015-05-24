<?php
/**
 * @var $this UController
 * @var $model LoginForm
 */

$this->pageTitle = 'Вход';

$this->widget('TbAlert');

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));

echo $form->textFieldControlGroup($model, 'email');
echo $form->passwordFieldControlGroup($model, 'password');

echo TbHtml::formActions(array(
    TbHtml::submitButton('Войти', array('color' => TbHtml::BUTTON_COLOR_SUCCESS)),
    TbHtml::linkButton('Регистрация', array('url' => '/site/registration', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
));
$this->endWidget();





