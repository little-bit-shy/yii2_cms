<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Date\Date;

/* @var $this yii\web\View */
/* @var $model common\models\AdminLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="admin-log-search box">
    <div class="box-body">

        <?= Html::tag('div', Html::tag('div', '条件查询', ['class' => 'box-title']), ['class' => 'box-header']); ?>

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'class' => 'col-12',
            ]
        ]); ?>

        <?= $form->field($model, 'route', ['options' => ['class' => 'col-sm-4']])->textInput(['placeholder' => '请输入路由...']) ?>

        <?= Date::widget([
            'type' => 2,
            'form' => $form,
            'model' => $model,
            'attribute' => 'created_at',
//            'config' => "
//                {
//                    autoclose: false
//                }
//                ",
            'file_options' => [
                'options' => [
                    'class' => 'col-sm-4'
                ]
            ]
        ]) ?>

        <?= $form->field($model, 'username', ['options' => ['class' => 'col-sm-4']])?>

        <div class="col-sm-5 pull-right text-right">
            <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
