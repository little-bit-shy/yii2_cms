<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Admin Log', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
//            'rowOptions' => function($model, $key, $index, $grid) {
//                return ['class' => $index % 2 ==0 ? 'label-red' : 'label-green'];
//            },
            'tableOptions' => ['class' => 'table table-bordered'],
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'headerOptions' => [
                        'style' => 'width:30px'
                    ]
                ],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'headerOptions' => [
                        'style' => 'width:30px'
                    ]
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'headerOptions' => [
                        'style' => 'width:160px'
                    ]
                ],
//                'id',
                [
                    'attribute' => 'description',
                    'content' => function ($model) {
                        return \backend\components\Helper::truncate_utf8_string($model->description, 50);
                    }
                ],
//                'user_id',
                [
                    'attribute' => 'route',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => [
                        'style' => 'width:80px'
                    ]
                ],
            ],
        ]); ?>
</div>