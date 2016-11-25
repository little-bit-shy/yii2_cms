<?php
/**
 * Created by PhpStorm.
 * User: QiQi-04-PC
 * Date: 2016/11/17
 * Time: 14:47
 */
namespace backend\components;

use Yii;
use yii\helpers\Url;

class AdminLog
{
    //日志记录
    public static function write($event)
    {
        //过滤日志数据的添加事件
        if($event->sender->className() === 'common\models\Adminlog'){
            return;
        }
        switch($event->name) {
            case \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE;//数据修改日志记录
                if (!empty($event->changedAttributes)) {
                $desc = '';
                foreach ($event->changedAttributes as $name => $value) {
                    $desc .= $name . ' : ' . $value . '=>' . $event->sender->getAttribute($name) . ',';
                }
                $primaryKey = $event->sender->primaryKey()[0];
                $primaryKey_value = $event->sender->getAttribute($primaryKey);
                $desc = substr($desc, 0, -1);
                $description = Yii::$app->user->identity->username . '修改了' . $event->sender->className() . ' id:' . $primaryKey_value . '的' . $desc;
                $route = Url::to();
                $userId = Yii::$app->user->id;
                $data = [
                    'route' => $route,
                    'description' => $description,
                    'user_id' => $userId,
                    'created_at' => time(),
                ];
                $model = new \common\models\Adminlog();
                $model->setAttributes($data);
                $model->save();
                }
            break;
            case \yii\db\BaseActiveRecord::EVENT_AFTER_INSERT;//数据添加日志记录
                $data = $event->sender->getAttributes();
                if (!empty($data)) {
                    $desc = '';
                    foreach ($data as $name => $value) {
                        $desc .= $name . '=>' . $value . ',';
                    }
                    $primaryKey = $event->sender->primaryKey()[0];
                    $primaryKey_value = $data[$primaryKey];
                    $desc = substr($desc, 0, -1);
                    $description = Yii::$app->user->identity->username . '添加了' . $event->sender->className() . ' id:' . $primaryKey_value . '的' . $desc;
                    $route = Url::to();
                    $userId = Yii::$app->user->id;
                    $data = [
                        'route' => $route,
                        'description' => $description,
                        'user_id' => $userId,
                        'created_at' => time(),
                    ];
                    $model = new \common\models\Adminlog();
                    $model->setAttributes($data);
                    $model->save();
                }
            break;
            case \yii\db\BaseActiveRecord::EVENT_AFTER_DELETE;//数据添加日志记录
                $data = $event->sender->getAttributes();
                if (!empty($data)) {
                    $desc = '';
                    foreach ($data as $name => $value) {
                        $desc .= $name . '=>' . $value . ',';
                    }
                    $primaryKey = $event->sender->primaryKey()[0];
                    $primaryKey_value = $data[$primaryKey];
                    $desc = substr($desc, 0, -1);
                    $description = Yii::$app->user->identity->username . '删除了' . $event->sender->className() . ' id:' . $primaryKey_value . '的' . $desc;
                    $route = Url::to();
                    $userId = Yii::$app->user->id;
                    $data = [
                        'route' => $route,
                        'description' => $description,
                        'user_id' => $userId,
                        'created_at' => time(),
                    ];
                    $model = new \common\models\Adminlog();
                    $model->setAttributes($data);
                    $model->save();
                }
            break;
    }
    }

    //数据查询日志记录
    public function find($event){

    }

    //数据添加日志记录
    public function insert($event){

    }

    //数据删除日志记录
    public function delete($event){

    }
}
