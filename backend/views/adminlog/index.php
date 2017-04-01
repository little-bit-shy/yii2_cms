<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\Helper;
use Highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="admin-log-index">

        <div class="row">
            <div class="col-sm-4">
                <?=
                Highcharts::widget([
                    'config' => "{
                    chart: {
                type: 'bar'
            },
            title: {
                text: 'Population pyramid for Germany, 2015'
            },
            subtitle: {
                text: 'Source: <a href=\"http://populationpyramid.net/germany/2015/\">Population Pyramids of the World from 1950 to 2100</a>'
            },
            xAxis: [{
                categories: ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 + '],
                reversed: false,
                labels: {
                    step: 1
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 + '],
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function () {
                        return Math.abs(this.value) + '%';
                    }
                }
            },

            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                        'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },

            series: [{
                name: 'Male',
                data: [-2.2, -2.2, -2.3, -2.5, -2.7, -3.1, -3.2,
                    -3.0, -3.2, -4.3, -4.4, -3.6, -3.1, -2.4,
                    -2.5, -2.3, -1.2, -0.6, -0.2, -0.0, -0.0]
            }, {
                name: 'Female',
                data: [2.1, 2.0, 2.2, 2.4, 2.6, 3.0, 3.1, 2.9,
                    3.1, 4.1, 4.3, 3.6, 3.4, 2.6, 2.9, 2.9,
                    1.8, 1.2, 0.6, 0.1, 0.0]
            }]
                }"
                ]);
                ?>
            </div>
            <div class="col-sm-4">
                <?=
                Highcharts::widget([
                    'config' => "{
                    chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox', 45.0],
                ['IE', 26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari', 8.5],
                ['Opera', 6.2],
                ['Others', 0.7]
            ]
        }]
                }"
                ]);
                ?>
            </div>
            <div class="col-sm-4">
                <?=
                Highcharts::widget([
                    'config' => "{
                    chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                y = Math.random();
                            series.addPoint([x, y], true, true);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Live random data'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }]
                }"
                ]);
                ?>
            </div>
        </div>

        <?php
        $data = "[
            [Date.UTC(2013,5,3)," . rand(1, 100) . "],
            [Date.UTC(2013,5,4)," . rand(1, 100) . "],
            [Date.UTC(2013,5,5)," . rand(1, 100) . "],
            [Date.UTC(2013,5,6)," . rand(1, 100) . "],
            [Date.UTC(2013,5,7)," . rand(1, 100) . "],
            [Date.UTC(2013,5,8)," . rand(1, 100) . "],
            [Date.UTC(2013,5,9)," . rand(1, 100) . "],
            [Date.UTC(2013,5,10)," . rand(1, 100) . "],
            [Date.UTC(2013,5,11)," . rand(1, 100) . "],
            [Date.UTC(2013,5,12)," . rand(1, 100) . "],
            [Date.UTC(2013,5,13)," . rand(1, 100) . "],
            [Date.UTC(2013,5,14)," . rand(1, 100) . "],
            [Date.UTC(2013,5,15)," . rand(1, 100) . "],
            [Date.UTC(2013,5,16)," . rand(1, 100) . "],
            [Date.UTC(2013,5,17)," . rand(1, 100) . "],
            [Date.UTC(2013,5,18)," . rand(1, 100) . "],
            [Date.UTC(2013,5,19)," . rand(1, 100) . "],
            [Date.UTC(2013,5,20)," . rand(1, 100) . "],
            [Date.UTC(2013,5,21)," . rand(1, 100) . "],
            [Date.UTC(2013,5,22)," . rand(1, 100) . "],
            [Date.UTC(2013,5,23)," . rand(1, 100) . "],
            [Date.UTC(2013,5,24)," . rand(1, 100) . "],
            [Date.UTC(2013,5,25)," . rand(1, 100) . "],
            [Date.UTC(2013,5,26)," . rand(1, 100) . "],
            [Date.UTC(2013,5,27)," . rand(1, 100) . "],
            [Date.UTC(2013,5,28)," . rand(1, 100) . "],
            [Date.UTC(2013,5,29)," . rand(1, 100) . "],
            [Date.UTC(2013,5,30)," . rand(1, 100) . "],
        ]";
        ?>
        <?=
        Highcharts::widget([
            'config' => "{
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
                data: $data
            }]
        }"
        ]);
        ?>

        <?=
        $this->render('_search', ['model' => $searchModel]);
        ?>

        <?php
        $layout = <<<LAYOUT
            <div class='box-body'>
                <div class='col-sm-4 text-left' style='margin-bottom:10px;'>
                {summary}
                </div>
                <div class='col-sm-8 text-right'>
                {pager}
                </div>
                {items}
            </div>
LAYOUT;
        ?>

        <?php \yii\widgets\Pjax::begin(['timeout' => 0, 'id' => 'gridview']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['class' => $index % 2 == 0 ? 'success' : 'warning'];
            },
            'options' => ['class' => 'box'],
            'headerRowOptions' => ['class' => 'warning'],
            'tableOptions' => ['class' => 'table table-hover table-condensed'],
            'layout' => $layout,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'header' => '详情',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a(Html::style('', ['class' => 'glyphicon glyphicon-eye-open']), $url);
                        },
                    ],
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                ],
                [
                    'attribute' => 'route',
                    'value' => function ($model) {
                        return Html::tag('p', Helper::truncate_utf8_string($model->route, 30), ['title' => $model->route]);
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'description',
                    'value' => function ($model) {
                        return Html::tag('p', Helper::truncate_utf8_string($model->description, 30), ['title' => $model->description]);
                    },
                    'format' => 'raw'
                ],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>

<?php
$js = <<<JS
        var container = $("#gridview"); //容器
        container.on('pjax:beforeSend',function(args){
            var msg = layer.msg('数据全速加载中...', {
                icon: 16,
                shade: 0.01,
                time: 0
            });
        })
        container.on('pjax:error',function(args){
            layer.closeAll('loading');
            layer.msg('数据加载失败...', {
                icon: 5,
                time: 1000
            });
        })
        container.on('pjax:success',function(args){
            layer.closeAll('loading');
            layer.msg('数据加载成功...', {
                icon: 6,
                time: 1000
            });
        })
JS;

$this->registerJs($js);

$css = <<<CSS

CSS;

$this->registerCss($css);
?>