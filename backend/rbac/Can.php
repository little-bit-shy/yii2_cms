<?php
/**
 * Created by PhpStorm.
 * User: QiQi-04-PC
 * Date: 2016/11/17
 * Time: 9:28
 */
namespace backend\rbac;

use Yii;
use yii\web\HttpException;

/**
 * 验证某用户是否有执行某模块的权限
 */
class Can
{
    /*当前操作为*/
    public $action;

    /**
     * 验证方法管理器
     * @param string $method 该参数的值为 __METHOD_
     * @param array $options 该参数的值为 判断权限的相关参数
     */
    public static function skip($method, $options = [])
    {
        $method = '_'.md5($method);
        self::$method($options);
    }

    /**
     * 权限判断
     */
    private static function can($permissionName){
        if(!Yii::$app->user->can($permissionName)){
            throw new HttpException(403,'你没有执行当前操作的权限...');
        }
    }

    /**
     * backend\controllers\AdminlogController::init 的权限判断
     */
    public static function _70ad8cfcdff66b0b1761101f4d98417b($options){
        $permissionName = 'root';
        self::can($permissionName);
    }
}