<?php

class UHtml {
    
    public static function infoRow(CActiveRecord $model, $attribute, $value = null, $htmlOptions = array())
    {
        $label = CHtml::label($model->getAttributeLabel($attribute), '', array('class' => 'control-label'));
        $str = CHtml::tag('span', array('class' => 'info-row'), $value ? $value : $model->getAttribute($attribute));
        $str = CHtml::tag('div', array('class' => 'controls'), $str);
        $str = CHtml::tag('div', array('class' => 'control-group'), $label.' '.$str);
        return $str;
    }

}