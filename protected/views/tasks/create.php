<?php
/**
 * @var $this TasksController
 * @var $model Task
 */

/** @var TbActiveForm $form */
$form = $this->beginWidget(BS_ActiveForm, array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
));

$this->widget('TbTabs', array(
    'tabs' => array(
        array(
            'label' => "Описание",
            'content' => $this->renderPartial('form', compact('form', 'model'), true),
            'active' => true
        ),
        array(
            'label' => "Вкладка 2",
            'content' => $this->renderPartial('form2', compact('form', 'model'), true),
        )
    )
));

echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('color' => TbHtml::ALERT_COLOR_SUCCESS)),
    TbHtml::resetButton('Отмена')
));
$this->endWidget();