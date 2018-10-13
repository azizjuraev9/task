<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserGifts;

/**
 * UserGiftsSearch represents the model behind the search form of `common\models\UserGifts`.
 */
class UserGiftsSearch extends UserGifts
{


    public $username;
    public $giftname;
    public $status;
    public $money;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'money', 'user_id'], 'integer'],
            [['username','giftname'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UserGifts::find()
            ->from(UserGifts::tableName().' t')
            ->leftJoin(Gifts::tableName().' AS g','t.gift_id = g.id')
            ->leftJoin(User::tableName().' AS u','t.user_id = u.id');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            't.status' => $this->status,
            't.user_id' => $this->user_id,
            't.money' => $this->money,
        ]);

        $query->andFilterWhere(['ilike','u.username',$this->username]);
        $query->andFilterWhere(['ilike','g.giftname',$this->giftname]);

//        var_dump($query->createCommand()->rawSql);die;

        return $dataProvider;
    }
}
