<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Prospect;

/**
 * ProspectSearch represents the model behind the search form of `backend\models\Prospect`.
 */
class ProspectSearch extends Prospect
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'contact_name', 'mobile', 'phone', 'line', 'facebook', 'seeme', 'delivery_type', 'delivery_place'], 'safe'],
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
        $query = Prospect::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'line', $this->line])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'seeme', $this->seeme])
            ->andFilterWhere(['like', 'delivery_type', $this->delivery_type])
            ->andFilterWhere(['like', 'delivery_place', $this->delivery_place]);

        return $dataProvider;
    }
}
