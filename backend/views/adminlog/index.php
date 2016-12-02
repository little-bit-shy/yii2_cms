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
    $data = '[
            [Date.UTC(2013,5,3),0.7648],
            [Date.UTC(2013,5,4),0.7645]
        ]';
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
        var container = $("#gridview");//容器
        container.on('pjax:beforeSend',function(args){
            layer.load(1);
        })
        container.on('pjax:error',function(args){
            layer.closeAll('loading');
            layer.msg('数据加载失败...');
        })
        container.on('pjax:success',function(args){
            layer.closeAll('loading');
            layer.msg('数据加载成功...');
        })
JS;

    $this->registerJs($js);
    ?>
</div>