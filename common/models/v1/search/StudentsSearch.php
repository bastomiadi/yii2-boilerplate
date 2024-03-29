<?php

namespace common\models\v1\search;

use common\models\v1\Students;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StudentsSearch represents the model behind the search form of `common\models\v1\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sections', 'classes', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'isDeleted', 'restored_by', 'restored_at'], 'integer'],
            [['name', 'email', 'address', 'phone_number'], 'safe'],
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
        $query = Students::find();

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
            'sections' => $this->sections,
            'classes' => $this->classes,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'isDeleted' => $this->isDeleted,
            'restored_by' => $this->restored_by,
            'restored_at' => $this->restored_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }
}
