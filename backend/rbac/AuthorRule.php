<?php
/**
 * Created by PhpStorm.
 * User: QiQi-04-PC
 * Date: 2016/11/17
 * Time: 9:28
 */
namespace backend\rbac;

use yii\rbac\Rule;

/**
 * 检查 authorID 是否和通过参数传进来的 user 参数相符
 */
class AuthorRule extends Rule
{
    public $name = 'Author';

    /**
     * @param string|integer $user 用户 ID.
     * @param Item $item 该规则相关的角色或者权限
     * @param array $params 传给 ManagerInterface::checkAccess() 的参数
     * @return boolean 代表该规则相关的角色或者权限是否被允许
     */
    public function execute($user, $item, $params)
    {
        return (isset($params['post']) && $params['post'] === 'post') ? true : false;
    }
}