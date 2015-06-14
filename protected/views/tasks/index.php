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
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
            'buttons' => array(
                'login' => array(
                    //'label'=>'Авторизоваться',     // text label of the button
                    'buttonType'=>'ajaxLink',
                    'type'=>'primary',
                    //'icon'=>'user',
                    'url'=> function(Task $data) {
                           // return array('/users/login/'.$data->id); //???
                        }

                )
            )
        ),
    ),
));


$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
        'title' => array('text' => 'Fruit Consumption'),
        'xAxis' => array(
            'categories' => array('Apples', 'Bananas', 'Oranges')
        ),
        'yAxis' => array(
            'title' => array('text' => 'Fruit eaten')
        ),
        'series' => array(
            array('name' => 'Jane', 'data' => array(1, 0, 4)),
            array('name' => 'John', 'data' => array(5, 7, 3))
        )
    )
));

$this ->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => 'Average fruit consumption during one week'),

        'legend'=> array(
            'layout'=> 'vertical',
            'align' => 'left',
            'verticalAlign' => 'top',
            'x' => 150,
            'y' => 100,
            'floating' => true,
            'borderWidth' => 1,
            //  'backgroundColor' => array(Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        ),
        'xAxis' => array(
            'categories' => array(
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ),
            'plotBands' => array( // visualize the weekend
                'from' => 4.5,
                'to' =>  6.5,
                'color' => 'rgba(68, 170, 213, .2)'
            ),
        ),
        'yAxis:' => array(
            'title'=> array('text' => 'Fruit units')
        ),
        'tooltip' => array(
            'shared' => true,
            'valueSuffix' => 'units'
        ),
        'credits' => array(
            'enabled' =>false
        ),
        'plotOptions'=>array(
            'areaspline'=>array(
                'fillOpacity'=> 0.5
            )
        ),
        'series'=> array(
           array('name'=> 'John','data'=> array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5)),
           array('name' =>'Jane','data'=> array(-0.2, 0.8, 5.7, 11.3, 17.0, 22.0))
        )
    )
));

$this ->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title'=> array(
            'text' => 'Monthly Average Temperature',
            'x'=> -20
        ),
        'subtitle'=> array(
            'text'=> 'Source: WorldClimate.com',
            'x' => -20
        ),
        'xAxis' => array(
            'categories'=> array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')
        ),
        'yAxis' => array(
            'title' => array(
                'text'=> 'Temperature (°C)'
            ),
        ),
        'tooltip' => array(
            'valueSuffix'=> '°C'
        ),
        'legend' => array(
            'layout'=> 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle',
                'borderWidth' => 0
        ),


        'series' => array(
            array(
                'name' => 'Tokyo',
                'data' => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6)
            ),array(
                'name' => 'New York',
                'data' => array(-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5)
            ),array(
                'name' => 'Berlin',
                'data' => array(-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0)
            ),array('name' => 'London',
                'data' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8)
            )
        )

    )
));

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
        'chart'=>array(
            'type'=> 'line'
        ),
        'title'=>array(
            'text'=> 'TITLE: Monthly Average Temperature'
        ),
        'subtitle'=>array(
            'text'=> 'SUB TITLE'
        ),
        'xAxis'=>array(
            'categories'=>array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')
        ),
        'yAxis'=>array(
            'title'=>array(
                'text'=> 'Temperature (C)'
            )
        ),
        'plotOptions'=>array(
            'line'=>array(
                'dataLabels'=>array(
                    'enabled'=> true
                ),
                'enableMouseTracking'=> false
            )
        ),
        'series'=>array(
            array(
                'name'=> 'Tokyo',
                'data'=> array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6)
            ), array(
                'name'=> 'London',
                'data'=>array(-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5)
            ),array(
                'name' => 'Berlin',
                'data' => array(-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0)
            ),array('name' => 'London',
                'data' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8)
            )
        )
    )
));

//$this->Widget('ext.highcharts.HighchartsWidget', array(
//    'options' => array(
//        'chart' => array(
//            'type' => 'arearange',
//                'zoomType' => 'x'
//        ),
//        'title'=> array(
//            'text' => 'Temperature variation by day'
//        ),
//        'xAsis'=> array(
//            'type'=> 'datetime'
//        ),
//        'yAxis'=> array(
//            'title'=> array(
//                'text'=> null
//            )
//        ),
//        'tooltip'=> array(
//            'crosshairs' => true,
//                'shared' => true,
//                'valueSuffix' => '°C'
//        ),
//        'legend'=> array(
//            'enabled'=>false
//        ),
//        'series'=> array(
//            array('name'=>'Temperatures','data'=> data())
//        )
//    )
//));

//$this->Widget('ext.highcharts.HighchartsWidget', array(
//    'options'=>array(
//        'theme'=>'July temperatures',
//        'rangeSelector'=>array('selected'=>1),
//        'title'=>array('text'=>'amount'),
//        'xAxis'=>array('type'=>'datetime'),
//        'yAxis'=>array('title'=>array('text'=> null)),
//        'tooltip'=> array(
//            'crosshairs'=> true,
//            'shared' => true,
//            'valueSuffix'=> '°C'
//        ),
//        'series'=> array(
//            array('name'=>'Temperature',
//                'data'=> 'averages',
//                'zIndex'=> 1,
//                'marker' => array(
//                    'fillColor'=> 'white',
//                    'lineWidth'=>2,
//                    'lineColor'=> 'Highcharts.getOptions().colors[0]'
//                )
//            ),
//            array( 'name' => 'Range',
//                'data'=> 'ranges',
//                'type' => 'arearange',
//                'lineWidth'=> 0,
//                'linkedTo'=>'previous',
//                'color'=> 'Highcharts.getOptions().colors[0]',
//                'fillOpacity' => 0.3,
//                'zIndex'=> 0
//            )
//      //  'series'=>array(array('name'=>'first line','data'=>'js:imps','color'=>'#9226a1'))
//    ))));
//Yii::app()->clientscript->registerScript('highstock',"
// var ranges = [
//            [1246406400000, 14.3, 27.7],
//            [1246492800000, 14.5, 27.8],
//            [1246579200000, 15.5, 29.6],
//            [1246665600000, 16.7, 30.7],
//            [1246752000000, 16.5, 25.0],
//            [1246838400000, 17.8, 25.7],
//            [1246924800000, 13.5, 24.8],
//            [1247011200000, 10.5, 21.4],
//            [1247097600000, 9.2, 23.8],
//            [1247184000000, 11.6, 21.8],
//            [1247270400000, 10.7, 23.7],
//            [1247356800000, 11.0, 23.3],
//            [1247443200000, 11.6, 23.7],
//            [1247529600000, 11.8, 20.7],
//            [1247616000000, 12.6, 22.4],
//            [1247702400000, 13.6, 19.6],
//            [1247788800000, 11.4, 22.6],
//            [1247875200000, 13.2, 25.0],
//            [1247961600000, 14.2, 21.6],
//            [1248048000000, 13.1, 17.1],
//            [1248134400000, 12.2, 15.5],
//            [1248220800000, 12.0, 20.8],
//            [1248307200000, 12.0, 17.1],
//            [1248393600000, 12.7, 18.3],
//            [1248480000000, 12.4, 19.4],
//            [1248566400000, 12.6, 19.9],
//            [1248652800000, 11.9, 20.2],
//            [1248739200000, 11.0, 19.3],
//            [1248825600000, 10.8, 17.8],
//            [1248912000000, 11.8, 18.5],
//            [1248998400000, 10.8, 16.1]
//        ],
//        averages = [
//            [1246406400000, 21.5],
//            [1246492800000, 22.1],
//            [1246579200000, 23],
//            [1246665600000, 23.8],
//            [1246752000000, 21.4],
//            [1246838400000, 21.3],
//            [1246924800000, 18.3],
//            [1247011200000, 15.4],
//            [1247097600000, 16.4],
//            [1247184000000, 17.7],
//            [1247270400000, 17.5],
//            [1247356800000, 17.6],
//            [1247443200000, 17.7],
//            [1247529600000, 16.8],
//            [1247616000000, 17.7],
//            [1247702400000, 16.3],
//            [1247788800000, 17.8],
//            [1247875200000, 18.1],
//            [1247961600000, 17.2],
//            [1248048000000, 14.4],
//            [1248134400000, 13.7],
//            [1248220800000, 15.7],
//            [1248307200000, 14.6],
//            [1248393600000, 15.3],
//            [1248480000000, 15.3],
//            [1248566400000, 15.8],
//            [1248652800000, 15.2],
//            [1248739200000, 14.8],
//            [1248825600000, 14.4],
//            [1248912000000, 15],
//            [1248998400000, 13.6]
//        ];
//",CClientScript::POS_HEAD);

$this->Widget('ext.highcharts.HighchartsWidget', array(
        'options' => array(
            'scripts' => array(
                'highcharts-more'
            ),
            'chart' => array(
                'plotBackgroundColor' => null,
                'plotBorderWidth' => 0,
                'plotShadow' => false
            ),
            'title' => array(
                'text' => 'Répartition des modes de paiement',
            ),
            'plotOptions' => array(
                'pie' => array(
                    'dataLabels' => array(
                        'enabled' => true,
                        'distance' => -50,
                        'style' => array(
                            'fontWeight' => 'bold',
                            'color' => 'white',
                            'textShadow' => '0px 1px 2px black',
                        ),
                    ),
                    'startAngle' => "-90",
                    'endAngle' => "90",
                    'center' => array('50%', '50%')
                ),
            ),
            'series' => array(
                array(
                    'type' => 'pie',
                    'innerSize' => '50%',
                    'data' => array(
                        array('Jane', 12),
                        array('John', 13),
                    )
                )
            ),
            'credits' => array('enabled' => false),
        )
    )
);


$level1 = array();
$level1[] = array('name' => 'GroupOne', 'y' => 11, 'drilldown' => 'dd1');
$level1[] = array('name' => 'GroupTwo', 'y' => 22, 'drilldown' => 'dd2');
$level1[] = array('name' => 'GroupThree', 'y' => 33, 'drilldown' => 'dd3');

$level2 = array();
$level2[] = array('id' => 'dd1', 'data' => array(array('Detail1', 1), array('Detail2', 2), array('Detail3', 4)));
$level2[] = array('id' => 'dd2', 'data' => array(array('Detaila', 8), array('Detailb', 9), array('Detailc', 3)));
$level2[] = array('id' => 'dd3', 'data' => array(array('DetailX', 7), array('DetailY', 5), array('DetailZ', 6)));

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'scripts' => array(
        'modules/drilldown', // in fact, this is mandatory :)
    ),
    'options'=>array(
        'chart' => array('type' => 'column'),
        'title' => array('text' => Yii::t('app','Levels 1 and 2')),
        'subtitle' => array('text' => Yii::t('app','Click the columns to view details.')),
        'xAxis' => array('type' => 'category'),
        'yAxis' => array('title' => array('text' => Yii::t('app','Vertical legend')),),
        'legend' => array('enabled' => false),
        'plotOptions' => array (
            'series' => array (
                'borderWidth' => 0,
                'dataLabels' => array(
                    'enabled' => true,
                ),
            ),
        ),
        'series' => array (array(
            'name' => 'MyData',
            'colorByPoint' => true,
            'data' => $level1,
        )),
        'drilldown' => array(
            'series' => $level2,
        ),
    ),
));

