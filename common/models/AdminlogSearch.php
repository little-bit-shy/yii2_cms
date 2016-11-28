<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Adminlog;

/**
 * AdminLogSearch represents the model behind the search form about `\common\models\AdminLog`.
 */
class AdminlogSearch extends Adminlog
{
    public $start_time;
    public $end_time;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['route', 'username'], 'safe'],
            //时间区间判断
            [['created_at'], 'match', 'pattern' => '/\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}/'],
            [['created_at'], 'validate_created_at'],
            [['username'], 'validate_username']
        ];
    }

    //验证created_at参数的值
    public function validate_created_at($attribute)
    {
        if (!$this->hasErrors()) {
            list($this->start_time, $this->end_time) = explode(' - ', $this->$attribute);
            $this->start_time = strtotime($this->start_time);
            $this->end_time = strtotime($this->end_time) + (3600 * 24);
        }
    }

    //验证username,用户名转用户id
    public function validate_username($attribute)
    {
        if (!$this->hasErrors()) {
            $model = User::find();
            $model->select(['id']);
            $model->filterWhere(['username' => $this->$attribute]);
            $model->limit(1);
            if ($model->one()) {
                $this->user_id = $model->one()->attributes['id'];
            } else {
                $this->addError($attribute, '当前用户不存在...');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AdminLog::find()->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['attributes' => ['']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'route' => $this->route
        ])
            ->andFilterWhere(['between', 'created_at', $this->start_time, $this->end_time]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route' => '路由',
            'description' => '信息',
            'created_at' => '时间',
            'user_id' => '用户',
            'username' => '用户',
        ];
    }
}
