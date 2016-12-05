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
    <?php
    $js = <<<JS
        var container = $("#gridview"); //容器
        container.on('pjax:beforeSend',function(args){
            layer.msg('数据全速加载中...', {
                icon: 16,
                shade: 0.01
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
    ?>
</div>