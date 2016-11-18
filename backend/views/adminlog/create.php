<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AdminLog */

$this->title = 'Create Admin Log';
$this->params['breadcrumbs'][] = ['label' => 'Admin Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
