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
                    array('label' => 'Пользователи', 'icon' => TbHtml::ICON_USER, 'url' => array('/admin/users')),
                    //array('label' => 'Задачи', 'icon' => TbHtml::ICON_PLUS, 'url' => array('/admin/task')),
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
                        array('label' => 'Профиль', 'url' => array('/admin/profile/update'), 'icon' => TbHtml::ICON_HOME),
                        array('label' => 'Выйти', 'url' => array('/admin/users/logout'), 'icon' => TbHtml::ICON_OFF),
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
                        array('label' => 'Профиль', 'url' => array('/admin/profile/update'), 'icon' => TbHtml::ICON_HOME),
                        array('label' => 'Выйти', 'url' => array('/admin/site/logout'), 'icon' => TbHtml::ICON_OFF),
                    )),
                ),
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
            );
        }


    }
}