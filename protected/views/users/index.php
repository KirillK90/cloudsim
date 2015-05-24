<?php
/**
 * @var $this UsersController
 * @var $model Users
 */

$this->buttons = array(
    array(
        'items' => array(
            array('url' => array('/users/create'), 'label' => 'Добавить', 'icon' => 'plus white'),
        ),
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    ),
);

$this->widget('TbGridView', array(
    'id' => 'user-list',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => '{summary} {items} {pager}',
    'enableHistory' => false,
    'columns' => array(
        array(
            'name' => 'id',
            'htmlOptions' => array(
                'class' => 'centred',
                'style' => 'width: 20px'
            )
        ),
        array(
            'name' => 'created',
            'value' => function(Users $data) {
                return HDates::ui($data->created);
            }
        ),
        array(
            'name' => 'role',
            'filter' => UserRole::getList(),
            'value' => function(Users $data) {
                return UserRole::getName($data->role);
            }
        ),
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'email',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete} {login}',
            'buttons' => array(
                'login' => array(
                    'label'=>'Авторизоваться',     // text label of the button
                    'buttonType'=>'ajaxLink',
                    'type'=>'primary',
                    'icon'=>'user',
                    'url'=> function(Users $data) {
                        return array('/users/login/'.$data->id);
                    }

                )
            )
        ),
    ),
));
?>