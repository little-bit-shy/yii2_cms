<?php
/**
 * Created by PhpStorm.
 * User: QiQi-04-PC
 * Date: 2016/11/17
 * Time: 9:28
 */
namespace backend\rbac;

/**
 * 验证某用户是否有执行某模块的权限
 */
class Can
{
    /*当前操作为*/
    public $Action;

    public function __construct($Action)
    {
        if(!empty($Action)){
            
        }
    }
}