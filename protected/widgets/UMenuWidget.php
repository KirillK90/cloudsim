<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 12/29/14
 * Time: 3:06 PM
 */
class UMenuWidget extends CWidget
{
    public $items = array();

    public function init()
    {
        /** @var Users $user */
        $user = Yii::app()->user->getModel();

        switch ($user->role) {
            case UserRole::ADMIN:
                $this->setAdminItems();
                break;

        }
        if ($user->role != UserRole::GUEST) {
            $this->addUserMenuItems();
        }

    }

    public function run()
    {
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'brandUrl' => '/',
            'items' => $this->items
        ));
    }

    public function setAdminItems()
    {

        $this->items = array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array('label' => 'Пользователи', 'icon' => TbHtml::ICON_USER, 'url' => array('/users')),
                ),
                'htmlOptions' => array(
                    'class' => 'pull-left',
                ),
            ),

        );
    }

    private function addUserMenuItems()
    {
        /** @var Users $user */
        $user = Yii::app()->user->getModel();

        if (Yii::app()->user->getState('virtualMode',false)) {
            $this->items[] = array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array('label' => $user->getName(). ' (V)', 'icon' => TbHtml::ICON_USER, 'items' => array(
                        array('label' => 'Профиль', 'url' => array('/profile/update'), 'icon' => TbHtml::ICON_HOME),
                        array('label' => 'Выйти', 'url' => array('/users/logout'), 'icon' => TbHtml::ICON_OFF),
                    )),
                ),
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
            );
        } else {
            $this->items[] = array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
                    array('label' => $user->getName(), 'icon' => TbHtml::ICON_USER, 'items' => array(
                        array('label' => 'Профиль', 'url' => array('/profile/update'), 'icon' => TbHtml::ICON_HOME),
                        array('label' => 'Выйти', 'url' => array('/site/logout'), 'icon' => TbHtml::ICON_OFF),
                    )),
                ),
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
            );
        }


    }
}