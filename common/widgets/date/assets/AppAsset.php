<?php

namespace common\widgets\Date\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/Date/daterangepicker';

    public $css = [
        'daterangepicker.css',
        'datepicker/datepicker3.css'
    ];

    public $js = [
        'moment.js',
        'daterangepicker.js',
        'datepicker/bootstrap-datepicker.js',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_END
    ];

    //建立资源包之间的依赖关系
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
