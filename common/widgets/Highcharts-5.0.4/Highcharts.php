<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Highcharts;

use Highcharts\assets\AppAsset;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class Highcharts extends \yii\bootstrap\Widget
{
    public $options;

    public function init()
    {
        parent::init();

        AppAsset::register($this->view);
        $this->view->registerJs("$(function () {
    $.getJSON('http://datas.org.cn/jsonp?filename=json/usdeur.json&callback=?', function (data) {
        Highcharts.chart('container', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'USD to EUR exchange rate over time'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Exchange rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'USD to EUR',
                data: data
            }]
        });
    });
});");
        $options = ArrayHelper::merge($this->options,['id' => 'container','style' => 'min-width: 310px; height: 400px; margin: 0 auto']);
        echo Html::tag('div','',$options);
    }
}
