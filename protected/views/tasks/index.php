<?php
/* @var $this TasksController */
/* @var $model Task */

$this->buttons = array(
    array(
        'items' => array(
            array('url' => array('/tasks/create'), 'label' => 'Создать задачу', 'icon' => 'plus white'),
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
            'value' => function(Task $data) {
                    return HDates::ui($data->created);
                }
        ),
        array(
            'name' => 'status',
            'filter' => TaskStatus::getList(),
            'value' => function(Task $data) {
                    return TaskStatus::getName($data->status);
                }
        ),
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'type',
            'filter' => TaskType::getList(),
            'value' => function(Task $data) {
                    return TaskType::getName($data->type);
                }

        ),

    ),
));
