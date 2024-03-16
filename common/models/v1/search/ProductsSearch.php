<?php

namespace common\models\v1\Search;

use common\models\v1\Products;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductsSearch represents the model behind the search form about `common\models\v1\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'restored_by', 'restored_at'], 'integer'],
            [['product_name', 'isDeleted'], 'safe'],
        ];
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
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'restored_by' => $this->restored_by,
            'restored_at' => $this->restored_at,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }
}
