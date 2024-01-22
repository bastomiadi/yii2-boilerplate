<?php

namespace common\models\v1\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\v1\AuditEntry;

/**
 * AuditEntrySearch represents the model behind the search form about `common\models\v1\AuditEntry`.
 */
class AuditEntrySearch extends AuditEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audit_entry_id'], 'integer'],
            [['audit_entry_timestamp', 'audit_entry_model_name', 'audit_entry_operation', 'audit_entry_field_name', 'audit_entry_old_value', 'audit_entry_new_value', 'audit_entry_user_id', 'audit_entry_ip'], 'safe'],
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
        $query = AuditEntry::find();

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
            'audit_entry_id' => $this->audit_entry_id,
        ]);

        $query->andFilterWhere(['like', 'audit_entry_timestamp', $this->audit_entry_timestamp])
            ->andFilterWhere(['like', 'audit_entry_model_name', $this->audit_entry_model_name])
            ->andFilterWhere(['like', 'audit_entry_operation', $this->audit_entry_operation])
            ->andFilterWhere(['like', 'audit_entry_field_name', $this->audit_entry_field_name])
            ->andFilterWhere(['like', 'audit_entry_old_value', $this->audit_entry_old_value])
            ->andFilterWhere(['like', 'audit_entry_new_value', $this->audit_entry_new_value])
            ->andFilterWhere(['like', 'audit_entry_user_id', $this->audit_entry_user_id])
            ->andFilterWhere(['like', 'audit_entry_ip', $this->audit_entry_ip]);

        return $dataProvider;
    }
}
