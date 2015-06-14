<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 12.06.15
 * Time: 18:57
 */
$this -> Widget('ext.highcharts.HighchartsWidget', array(
    'options'=> array(
        'title' =>array(
            'text'=> 'Average fruit consumption during one week',
            'margin' => 0
        ),
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
            'categories'=>array(
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ),
            'plotBands'=>array( // visualize the weekend
                'from'=> 4.5,
                'to'=>  6.5,
                'color'=> 'rgba(68, 170, 213, .2)'
            ),
        ),
        'yAxis:' => array(
            'title'=> array(
                'text' => 'Fruit units'
            )
        ),
        'tooltip' =>array(
            'shared'=> true,
            'valueSuffix' =>' units'
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
            'name'=> 'John',
            'data'=> array(3, 4, 3, 5, 4, 10, 12)
        ), array(
            'name' =>'Jane',
            'data'=> array(1, 3, 4, 3, 3, 5, 4)
        )
    )
));
