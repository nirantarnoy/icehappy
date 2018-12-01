<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Saleorder;

/**
 * SaleorderSearch represents the model behind the search form of `backend\models\Saleorder`.
 */
class SaleorderSearch extends Saleorder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sale_zone', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'approve_by'], 'integer'],
            [['sale_no', 'sale_date'], 'safe'],
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
        $query = Saleorder::find();

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
            'sale_date' => $this->sale_date,
            'sale_zone' => $this->sale_zone,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'approve_by' => $this->approve_by,
        ]);

        $query->andFilterWhere(['like', 'sale_no', $this->sale_no]);

        return $dataProvider;
    }
}
