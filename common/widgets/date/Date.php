<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\Date;

use common\widgets\Date\assets\AppAsset;
use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

/**
 * //Date range picker
 * $('#reservation').daterangepicker();
 * //Date range picker with time picker
 * $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
 * //Date range as a button
 * $('#daterange-btn').daterangepicker(
 * {
 * ranges: {
 * 'Today': [moment(), moment()],
 * 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
 * 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
 * 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
 * 'This Month': [moment().startOf('month'), moment().endOf('month')],
 * 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
 * },
 * startDate: moment().subtract(29, 'days'),
 * endDate: moment()
 * },
 * function (start, end) {
 * $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
 * }
 * );
 *
 * //Date picker
 * $('#datepicker').datepicker({
 * autoclose: true
 * });
 */
class Date extends \yii\bootstrap\Widget
{
    public $form;
    public $type = 1;
    public $model;
    public $attribute;
    public $file_options;
    public $config = <<<JSON
        {
          ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7天前': [moment().subtract(6, 'days'), moment()],
            '30天前': [moment().subtract(29, 'days'), moment()],
            '这个月': [moment().startOf('month'), moment().endOf('month')],
            '上个月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
//          startDate: moment().subtract(29, 'days'),
//          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
JSON;


    public function init()
    {
        parent::init();
        $model = $this->model;
        $attribute = $this->attribute;
        $config = $this->config;
        $form = $this->form;
        $type = $this->type;
        $file_options = $this->file_options;
        AppAsset::register($this->view);
        if ($form) {
            echo $form->field($model, $attribute, $file_options)->textInput(['id' => "reservationtime"]);
        }
        if ($type === 1) {
            $js = <<<JS
        $('#reservationtime').datepicker($config);
JS;
        } else if ($type === 2) {
            $js = <<<JS
        $('#reservationtime').daterangepicker($config);
JS;
        }

        $this->view->registerJs($js);
    }
}
