<?php

namespace Highcharts\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/Highcharts-5.0.4/code';

    public $css = [
    ];

    public $js = [
        'highcharts.js',
        'modules/exporting.js'
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
