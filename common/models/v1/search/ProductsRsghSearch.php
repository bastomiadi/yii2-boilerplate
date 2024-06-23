<?php

namespace common\models\v1\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\v1\ProductsRsgh;

/**
 * ProductsRsghSearch represents the model behind the search form about `common\models\v1\ProductsRsgh`.
 */
class ProductsRsghSearch extends ProductsRsgh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MST_PRODUK_MPRO_KODE', 'NAMA_PRODUK', 'MPRO_PARENT', 'NAMA_PARENT', 'MPRO_ISGENERAL', 'REF_KATEGORI_PLY_RKPL_KODE', 'RKPL_NAMA', 'MPRO_ISGROUP', 'TIPE_TINDAKAN', 'REF_FRM_TND_RFTIND_KD', 'RFTIND_NAMA', 'MPRO_ISAKTIF', 'MPRO_IS_ADJUST_JSRS', 'MPRO_IS_ADJUST_JSBHP', 'MPRO_IS_ADJUST_JSALAT', 'MPRO_IS_ADJUST_JPOPERATOR', 'MPRO_IS_ADJUST_JPANESTHESI', 'MPRO_IS_ADJUST_JPPARAMEDIK', 'REF_JNS_TENAGAKERJA_KD', 'RJKTK_NAMA', 'REF_WAKTU_TIND_RWTIND_KODE', 'RWTIND_WAKTU_MULAI', 'RWTIND_WAKTU_SELESAI', 'REF_KOMP_TRF_INA_RKTINA_KODE', 'KOMPONEN_TARIF', 'MPRO_NAMA_EN', 'REF_KELAS_RLKS_KODE', 'RKLS_NAMA', 'MT_TGL_AWAL', 'MT_TGL_AKHIR', 'MT_JSRS', 'MT_JSBHP', 'MT_JSALAT', 'MT_JPOPERATOR', 'MT_JPANESTHESI', 'MT_JPPARAMEDIK', 'TOTAL_TARIF', 'MT_CATATAN', 'isDeleted'], 'safe'],
            [['id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
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
        $query = ProductsRsgh::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'MST_PRODUK_MPRO_KODE', $this->MST_PRODUK_MPRO_KODE])
            ->andFilterWhere(['like', 'NAMA_PRODUK', $this->NAMA_PRODUK])
            ->andFilterWhere(['like', 'MPRO_PARENT', $this->MPRO_PARENT])
            ->andFilterWhere(['like', 'NAMA_PARENT', $this->NAMA_PARENT])
            ->andFilterWhere(['like', 'MPRO_ISGENERAL', $this->MPRO_ISGENERAL])
            ->andFilterWhere(['like', 'REF_KATEGORI_PLY_RKPL_KODE', $this->REF_KATEGORI_PLY_RKPL_KODE])
            ->andFilterWhere(['like', 'RKPL_NAMA', $this->RKPL_NAMA])
            ->andFilterWhere(['like', 'MPRO_ISGROUP', $this->MPRO_ISGROUP])
            ->andFilterWhere(['like', 'TIPE_TINDAKAN', $this->TIPE_TINDAKAN])
            ->andFilterWhere(['like', 'REF_FRM_TND_RFTIND_KD', $this->REF_FRM_TND_RFTIND_KD])
            ->andFilterWhere(['like', 'RFTIND_NAMA', $this->RFTIND_NAMA])
            ->andFilterWhere(['like', 'MPRO_ISAKTIF', $this->MPRO_ISAKTIF])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JSRS', $this->MPRO_IS_ADJUST_JSRS])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JSBHP', $this->MPRO_IS_ADJUST_JSBHP])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JSALAT', $this->MPRO_IS_ADJUST_JSALAT])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JPOPERATOR', $this->MPRO_IS_ADJUST_JPOPERATOR])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JPANESTHESI', $this->MPRO_IS_ADJUST_JPANESTHESI])
            ->andFilterWhere(['like', 'MPRO_IS_ADJUST_JPPARAMEDIK', $this->MPRO_IS_ADJUST_JPPARAMEDIK])
            ->andFilterWhere(['like', 'REF_JNS_TENAGAKERJA_KD', $this->REF_JNS_TENAGAKERJA_KD])
            ->andFilterWhere(['like', 'RJKTK_NAMA', $this->RJKTK_NAMA])
            ->andFilterWhere(['like', 'REF_WAKTU_TIND_RWTIND_KODE', $this->REF_WAKTU_TIND_RWTIND_KODE])
            ->andFilterWhere(['like', 'RWTIND_WAKTU_MULAI', $this->RWTIND_WAKTU_MULAI])
            ->andFilterWhere(['like', 'RWTIND_WAKTU_SELESAI', $this->RWTIND_WAKTU_SELESAI])
            ->andFilterWhere(['like', 'REF_KOMP_TRF_INA_RKTINA_KODE', $this->REF_KOMP_TRF_INA_RKTINA_KODE])
            ->andFilterWhere(['like', 'KOMPONEN_TARIF', $this->KOMPONEN_TARIF])
            ->andFilterWhere(['like', 'MPRO_NAMA_EN', $this->MPRO_NAMA_EN])
            ->andFilterWhere(['like', 'REF_KELAS_RLKS_KODE', $this->REF_KELAS_RLKS_KODE])
            ->andFilterWhere(['like', 'RKLS_NAMA', $this->RKLS_NAMA])
            ->andFilterWhere(['like', 'MT_TGL_AWAL', $this->MT_TGL_AWAL])
            ->andFilterWhere(['like', 'MT_TGL_AKHIR', $this->MT_TGL_AKHIR])
            ->andFilterWhere(['like', 'MT_JSRS', $this->MT_JSRS])
            ->andFilterWhere(['like', 'MT_JSBHP', $this->MT_JSBHP])
            ->andFilterWhere(['like', 'MT_JSALAT', $this->MT_JSALAT])
            ->andFilterWhere(['like', 'MT_JPOPERATOR', $this->MT_JPOPERATOR])
            ->andFilterWhere(['like', 'MT_JPANESTHESI', $this->MT_JPANESTHESI])
            ->andFilterWhere(['like', 'MT_JPPARAMEDIK', $this->MT_JPPARAMEDIK])
            ->andFilterWhere(['like', 'TOTAL_TARIF', $this->TOTAL_TARIF])
            ->andFilterWhere(['like', 'MT_CATATAN', $this->MT_CATATAN])
            ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }
}
