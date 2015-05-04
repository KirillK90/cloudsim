<?php
/**
 * @var $this UController
 * @var $model Users
 */

$this->pageTitle = 'Ваш аккаунт успешно активирован';

$this->setFlash('success', 'Теперь Вы можете войти в систему ипользую свой email и пароль.');

$this->widget('TbAlert');