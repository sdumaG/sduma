<?php

namespace common;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ConfigTramiteMotivoCuentaconDoc;

/**
 * ConfigTramiteMotivoCuentaconDocSearch represents the model behind the search form of `common\models\ConfigTramiteMotivoCuentaconDoc`.
 */
class ConfigTramiteMotivoCuentaconDocSearch extends ConfigTramiteMotivoCuentaconDoc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_TipoTramite', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Documento'], 'integer'],
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
        $query = ConfigTramiteMotivoCuentaconDoc::find();

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
            'id_TipoTramite' => $this->id_TipoTramite,
            'id_MotivoConstruccion' => $this->id_MotivoConstruccion,
            'id_SolicitudGenericaCuentaCon' => $this->id_SolicitudGenericaCuentaCon,
            'id_Documento' => $this->id_Documento,
        ]);

        return $dataProvider;
    }
}
