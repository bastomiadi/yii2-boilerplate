<?php

namespace common\models\v1\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\v1\Profiles;

/**
 * ProfilesSearch represents the model behind the search form about `common\models\v1\Profiles`.
 */
class ProfilesSearch extends Profiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user', 'gender', 'marital', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['first_name', 'last_name', 'phone_number', 'address', 'profile_image', 'date_of_birth', 'isDeleted'], 'safe'],
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
        $query = Profiles::find();

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
            'user' => $this->user,
            'gender' => $this->gender,
            'marital' => $this->marital,
            'date_of_birth' => $this->date_of_birth,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'profile_image', $this->profile_image])
            ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }
}
