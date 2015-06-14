<?php
/* @var $this TasksController */
/* @var $model Task */

$filePath = DATA_PATH.'tasks/'.$model->id.'.json';

$json = file_get_contents($filePath);
$data = json_decode($json, true);
HDev::log($data);

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
            'categories'=> array()
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
                'name' => 'l=0',
                'data' => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6)
            ),array(
                'name' => 'l=0',
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