<?php /* @var $this UController */
Yii::app()->bootstrap->register();

if ($this->menu) {
    $this->buttons = array(
        array(
            'items' => $this->menu,
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        )
    );
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="<?php echo Yii::app()->language; ?>"/>

    <title><?php echo ($this->pageTitle ? CHtml::encode($this->pageTitle).' - ' : '').Yii::app()->name; ?></title>
</head>

<body>
    <div class="container" id="page">
        <?php $this->widget('UMenuWidget'); ?>

        <div class="container" style="margin-top:80px">
            <?php if ($this->breadcrumbs): ?>
                <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
                    'links'=>$this->breadcrumbs,
                )); ?>
            <?php endif; ?>

            <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true,
            )); ?>

            <?php if ($this->pageTitle): ?>
                <h1><?php echo $this->pageTitle; ?></h1>
            <?php endif; ?>
            <?php if ($this->pageDescription): ?>
                <p><?php echo $this->pageDescription ?></p>
            <?php endif; ?>

            <?php if ($this->pageTitle || $this->pageDescription): ?>
                <hr/>
            <?php endif; ?>

            <?php if ($this->buttons): ?>
                <?php echo TbHtml::buttonToolbar($this->buttons, array('id' => 'main-buttons')); ?>
            <?php endif; ?>

            <?php echo $content; ?>
            <hr/>

            <div id="footer">
                &copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>
                <?php if (!Yii::app()->user->isGuest): ?>
                    <span class="muted">(<?php echo 'r<b>'.REVISION.'</b>@<b>'.ENV.'</b>'; ?>)</span>
                <?php endif; ?>
            </div>
           
        </div>
    </div>
</body>
</html>