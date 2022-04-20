<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Donasi;

/**
 * DonasiSearch represents the model behind the search form of `backend\models\Donasi`.
 */
class DonasiSearch extends Donasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_program', 'id_donatur', 'jumlah'], 'integer'],
            [['id_invoice', 'nama', 'email', 'transaction_status', 'pesan'], 'safe'],
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
        $query = Donasi::find();

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
            'id_program' => $this->id_program,
            'id_donatur' => $this->id_donatur,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'id_invoice', $this->id_invoice])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pesan', $this->pesan])
            ->andFilterWhere(['like', 'transaction_status', $this->transaction_status]);

        return $dataProvider;
    }
}
