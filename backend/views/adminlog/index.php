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
            'layout' => "{summary}\n{items}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],
                'id',
                'route',
                [
                    'attribute' => 'description',
                    'content' => function ($model) {
                        return \backend\components\Helper::truncate_utf8_string($model->description, 100);
                    },
                    'contentOptions' => [
                        'style' => 'width:100px;overflow:auto'
                    ]
                ],
                'created_at:datetime',
                'user_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
</div>