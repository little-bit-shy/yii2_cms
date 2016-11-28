<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-index">
    <?=
    $this->render('_search',['model'=>$searchModel]);
    ?>

    <?php
    $layout = <<<LAYOUT
            <div class='box-body'>
                <div class='col-sm-4 text-left'>
                {summary}
                </div>
                <div class='col-sm-8 text-right'>
                {pager}
                </div>
                {items}
            </div>
LAYOUT;
    ?>

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
                        return Html::a(Html::style('',['class'=>'glyphicon glyphicon-eye-open']), $url);
                    },
                ],
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'route',
                'value' => function($model){
                    return  Html::tag('p', Helper::truncate_utf8_string($model->route,30), ['title'=>$model->route]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return  Html::tag('p', Helper::truncate_utf8_string($model->description,30), ['title'=>$model->description]);
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>
</div>