<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TipoTramiteHasDocumento;

/**
 * TipoTramiteHasDocumentoSearch represents the model behind the search form of `common\models\TipoTramiteHasDocumento`.
 */
class TipoTramiteHasDocumentoSearch extends TipoTramiteHasDocumento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_TipoTramite', 'id_Documento'], 'integer'],
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
        $query = TipoTramiteHasDocumento::find();

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

        //si el valor es 0, el valor se vuelve NULL,
        // así que en el filtrado real de SQL, ese parametro no existirá,
        // es el equivalente a borrar el parametro del filtro
        // grid filtering conditions
        $query->andFilterWhere([
            'id_TipoTramite' => $this->id_TipoTramite == 0? NULL : $this->id_TipoTramite,
            'id_Documento' => $this->id_Documento == 0? NULL : $this->id_Documento,
        ]);

        return $dataProvider;
    }
}
