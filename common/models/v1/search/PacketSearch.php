<?php

namespace common\models\v1\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\v1\Packet;

/**
 * PacketSearch represents the model behind the search form of `common\models\v1\Packet`.
 */
class PacketSearch extends Packet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total_price', 'discount_percent', 'discount_rupiah'], 'integer'],
            [['packet_name', 'description'], 'safe'],
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
        $query = Packet::find();

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
            'total_price' => $this->total_price,
            'discount_percent' => $this->discount_percent,
            'discount_rupiah' => $this->discount_rupiah,
        ]);

        $query->andFilterWhere(['like', 'packet_name', $this->packet_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
