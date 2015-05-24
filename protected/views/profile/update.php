<?php
/**
 * @var $this UController
 * @var $model Users
 */

$this->widget('TbAlert');

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));

echo UHtml::infoRow($model, 'email');
echo UHtml::infoRow($model, 'role', UserRole::getName($model->role));
echo $form->textFieldControlGroup($model, 'name');

echo TbHtml::formActions(array(
    TbHtml::submitButton('Сохранить', array('color' => TbHtml::ALERT_COLOR_SUCCESS)),
    TbHtml::linkButton('Изменить Пароль', array('url' => '/profile/changePassword', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Отмена')
));
$this->endWidget();
