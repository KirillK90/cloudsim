<?php
$this->pageTitle = 'Вход';
?>

<?php echo new TbForm(array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'elements' => array(
        'email' => array('type' => TbHtml::INPUT_TYPE_TEXT),
        'password' => array('type' => TbHtml::INPUT_TYPE_PASSWORD),
       // 'rememberMe' => array('type' => TbHtml::INPUT_TYPE_CHECKBOX),
    ),
    'buttons' => array(
        'submit' => array(
            'type' => TbHtml::BUTTON_TYPE_SUBMIT,
            'label' => Yii::t('app', 'Войти'),
            'attributes' => array('color' => TbHtml::BUTTON_COLOR_PRIMARY),
        ),
    ),
), $model); ?>
