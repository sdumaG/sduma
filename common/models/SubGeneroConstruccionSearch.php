<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubGeneroConstruccion;

/**
 * SubGeneroConstruccionSearch represents the model behind the search form of `common\models\SubGeneroConstruccion`.
 */
class SubGeneroConstruccionSearch extends SubGeneroConstruccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isActivo', 'id_GeneroConstruccion'], 'integer'],
            [['nombre', 'udm', 'nombreTarifa', 'fechaCreacion', 'anioVigencia'], 'safe'],
            [['tamanioLimiteInferior', 'tamanioLimiteSuperior', 'tarifa'], 'number'],
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
        $query = SubGeneroConstruccion::find();

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
            'tamanioLimiteInferior' => $this->tamanioLimiteInferior,
            'tamanioLimiteSuperior' => $this->tamanioLimiteSuperior,
            'tarifa' => $this->tarifa,
            'fechaCreacion' => $this->fechaCreacion,
            'isActivo' => $this->isActivo,
            'id_GeneroConstruccion' => $this->id_GeneroConstruccion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'udm', $this->udm])
            ->andFilterWhere(['like', 'nombreTarifa', $this->nombreTarifa])
            ->andFilterWhere(['like', 'anioVigencia', $this->anioVigencia]);

        return $dataProvider;
    }
}
