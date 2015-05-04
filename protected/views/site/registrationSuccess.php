<?php
/**
 * @var $this UController
 * @var $model LoginForm
 */

$this->pageTitle = 'Спасибо за регистрацию';

$this->setFlash('success', 'На Вашу почту отправлено письмо с дальнейшими инструкциями для активации Вашего аккаунта.');

$this->widget('TbAlert');