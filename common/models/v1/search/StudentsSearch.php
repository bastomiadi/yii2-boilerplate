<?php

namespace common\models\v1\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\v1\Students;

/**
 * StudentsSearch represents the model behind the search form about `common\models\v1\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sections', 'classes', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'restored_by', 'restored_at'], 'integer'],
            [['name', 'email', 'address', 'phone_number', 'isDeleted'], 'safe'],
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
        $query = Students::find();

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
            'sections' => $this->sections,
            'classes' => $this->classes,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'restored_by' => $this->restored_by,
            'restored_at' => $this->restored_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }
}
