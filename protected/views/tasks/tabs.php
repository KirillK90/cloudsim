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
            'label' => "Общие",
            'content' => $this->renderPartial('form', compact('form', 'model'), true),
            'active' => true
        ),
        array(
            'label' => "Свойства атомов",
            'content' => $this->renderPartial('form2', compact('form', 'model'), true),

        ),
        array(
            'label' => "Cвойства рассчета",
            'content' => $this->renderPartial('form3', compact('form', 'model'), true),
        )
    )
));


echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('color' => TbHtml::ALERT_COLOR_SUCCESS)),
    TbHtml::resetButton('Отмена')
));
$this->endWidget();


