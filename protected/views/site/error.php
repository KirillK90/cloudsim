<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='Ошибка '.$code;
?>

<p>
<?php echo CHtml::encode($message); ?>
</p>