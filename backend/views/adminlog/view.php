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
        'attributes' => [
            'id',
            'route',
            'description:ntext',
            'created_at',
            'user_id',
        ],
    ]) ?>

</div>
