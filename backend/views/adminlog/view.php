<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminLog */

$this->title = $model->route;
$this->params['breadcrumbs'][] = ['label' => '操作日志', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-view">
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-hover table-condensed box'],
        'template' => '<tr><th style="min-width:60px;" class="text-center">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'route',
            'description:ntext',
            'created_at',
            'user_id',
        ],
    ]) ?>
</div>
