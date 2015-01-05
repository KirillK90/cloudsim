<?php
/**
 * @var $this UsersController
 * @var $model Users
 */

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));

echo $form->dropDownListControlGroup($model, 'role', UserRole::getList());
echo $form->textFieldControlGroup($model, 'name');
echo $form->textFieldControlGroup($model, 'email');
if ($model->isNewRecord) {
    echo $form->passwordFieldControlGroup($model, 'password', array(
        'autocomplete' => 'off',
    ));
} else {
    echo $form->passwordFieldControlGroup($model, 'newPassword', array(
        'autocomplete' => 'off',
    ));
    echo $form->passwordFieldControlGroup($model, 'verifyPassword', array(
        'autocomplete' => 'off',
    ));
}


echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('color' => TbHtml::ALERT_COLOR_SUCCESS)),
    TbHtml::resetButton('Отмена')
));
$this->endWidget();