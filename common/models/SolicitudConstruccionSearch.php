<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SolicitudConstruccion;

/**
 * SolicitudConstruccionSearch represents the model behind the search form of `common\models\SolicitudConstruccion`.
 */
class SolicitudConstruccionSearch extends SolicitudConstruccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'id_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],
            [['COS', 'CUS', 'RPP', 'tomo', 'folioElec', 'cuentaCatastral', 'fechaCreacion', 'fechaModificacion'], 'safe'],
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
        $query = SolicitudConstruccion::find();

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
            'superficieTotal' => $this->superficieTotal,
            'superficiePorConstruir' => $this->superficiePorConstruir,
            'superficiePreexistente' => $this->superficiePreexistente,
            'niveles' => $this->niveles,
            'cajones' => $this->cajones,
            'fechaCreacion' => $this->fechaCreacion,
            'fechaModificacion' => $this->fechaModificacion,
            'isDeleted' => $this->isDeleted,
            'id_User_CreadoPor' => $this->id_User_CreadoPor,
            'id_User_ModificadoPor' => $this->id_User_ModificadoPor,
            'id_DomicilioNotificaciones' => $this->id_DomicilioNotificaciones,
            'id_DomicilioPredio' => $this->id_DomicilioPredio,
            'id_MotivoConstruccion' => $this->id_MotivoConstruccion,
            'id_Contacto' => $this->id_Contacto,
            'id_TipoPredio' => $this->id_TipoPredio,
            'id_TipoConstruccion' => $this->id_TipoConstruccion,
            'id_GeneroConstruccion' => $this->id_GeneroConstruccion,
            'id_SubGeneroConstruccion' => $this->id_SubGeneroConstruccion,
            'id_DirectorResponsableObra' => $this->id_DirectorResponsableObra,
            'id_CorrSeguridadEstruc' => $this->id_CorrSeguridadEstruc,
            'id_Expediente' => $this->id_Expediente,
        ]);

        $query->andFilterWhere(['like', 'COS', $this->COS])
            ->andFilterWhere(['like', 'CUS', $this->CUS])
            ->andFilterWhere(['like', 'RPP', $this->RPP])
            ->andFilterWhere(['like', 'tomo', $this->tomo])
            ->andFilterWhere(['like', 'folioElec', $this->folioElec])
            ->andFilterWhere(['like', 'cuentaCatastral', $this->cuentaCatastral]);

        return $dataProvider;
    }
}
