<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}'
];
?>
<div class="assignment-index">



    <?php Pjax::begin(); ?>
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
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => $index % 2 == 0 ? 'success' : 'warning'];
        },
        'options' => ['class' => 'box'],
        'headerRowOptions' => ['class' => 'warning'],
        'tableOptions' => ['class' => 'table table-hover table-condensed'],
        'layout' => $layout,
        'columns' => $columns,
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>
