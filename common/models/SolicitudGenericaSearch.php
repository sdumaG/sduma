<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SolicitudGenerica;

/**
 * SolicitudGenericaSearch represents the model behind the search form of `common\models\SolicitudGenerica`.
 */
class SolicitudGenericaSearch extends SolicitudGenerica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'statusSolicitud', 'isSolicitaPersonaFisica', 'superficieTotal', 'niveles', 'numeroTomaAgua', 'numeroReciboAgua', 'subeRecibo', 'numeroPredial', 'id_MetrosLinealesDRO', 'id_AlturaDRO', 'id_PersonaFisica', 'id_PersonaMoral', 'id_Contacto', 'id_DomicilioNotificaciones', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Escritura', 'id_ConstanciaEscritura', 'id_ConstanciaPosecionEjidal', 'id_TipoPredio', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DomicilioPredio', 'id_DirectorResponsableObra', 'id_Archivo_MemoriaCalculo', 'id_Archivo_MecanicaSuelos', 'id_Archivo_LicenciaConstruccionAreaPreexistenteFile', 'id_User_CreadoPor', 'id_User_ModificadoPor'], 'integer'],
            [['superficiePorConstruir', 'areaPreExistente', 'altura', 'metrosLineales'], 'number'],
            [['tipoTomaAgua', 'fechaPagoAguaOContrato', 'fechaPagoPredial', 'fechaCreacion', 'fechaModificacion'], 'safe'],
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
        $query = SolicitudGenerica::find();

        // add conditions that should always apply here

        $user = $params["userModel"];
        if($user->id_UserLevel == User::USER_LEVEL_ADMIN){
            //TODOS
        }else
        if($user->id_UserLevel == User::USER_LEVEL_INTERNO){
            //TODOS
        }else
        if($user->id_UserLevel == User::USER_LEVEL_EXTERNO){
            //FILTRADO
            $query = $query->where(["id_User_CreadoPor"=>$user->id]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query
        ->orderBy(['id'=>SORT_DESC, 'fechaCreacion'=>SORT_DESC, ])
        ->andFilterWhere([
            'id' => $this->id,
            'statusSolicitud' => $this->statusSolicitud,
            'isSolicitaPersonaFisica' => $this->isSolicitaPersonaFisica,
            'superficieTotal' => $this->superficieTotal,
            'niveles' => $this->niveles,
            'superficiePorConstruir' => $this->superficiePorConstruir,
            'areaPreExistente' => $this->areaPreExistente,
            'numeroTomaAgua' => $this->numeroTomaAgua,
            'fechaPagoAguaOContrato' => $this->fechaPagoAguaOContrato,
            'numeroReciboAgua' => $this->numeroReciboAgua,
            'subeRecibo' => $this->subeRecibo,
            'numeroPredial' => $this->numeroPredial,
            'fechaPagoPredial' => $this->fechaPagoPredial,
            'altura' => $this->altura,
            'metrosLineales' => $this->metrosLineales,
            'id_MetrosLinealesDRO' => $this->id_MetrosLinealesDRO,
            'id_AlturaDRO' => $this->id_AlturaDRO,
            'id_PersonaFisica' => $this->id_PersonaFisica,
            'id_PersonaMoral' => $this->id_PersonaMoral,
            'id_Contacto' => $this->id_Contacto,
            'id_DomicilioNotificaciones' => $this->id_DomicilioNotificaciones,
            'id_MotivoConstruccion' => $this->id_MotivoConstruccion,
            'id_SolicitudGenericaCuentaCon' => $this->id_SolicitudGenericaCuentaCon,
            'id_Escritura' => $this->id_Escritura,
            'id_ConstanciaEscritura' => $this->id_ConstanciaEscritura,
            'id_ConstanciaPosecionEjidal' => $this->id_ConstanciaPosecionEjidal,
            'id_TipoPredio' => $this->id_TipoPredio,
            'id_GeneroConstruccion' => $this->id_GeneroConstruccion,
            'id_SubGeneroConstruccion' => $this->id_SubGeneroConstruccion,
            'id_DomicilioPredio' => $this->id_DomicilioPredio,
            'id_DirectorResponsableObra' => $this->id_DirectorResponsableObra,
            'id_Archivo_MemoriaCalculo' => $this->id_Archivo_MemoriaCalculo,
            'id_Archivo_MecanicaSuelos' => $this->id_Archivo_MecanicaSuelos,
            'id_Archivo_LicenciaConstruccionAreaPreexistenteFile' => $this->id_Archivo_LicenciaConstruccionAreaPreexistenteFile,
            'id_User_CreadoPor' => $this->id_User_CreadoPor,
            'id_User_ModificadoPor' => $this->id_User_ModificadoPor,
            'fechaCreacion' => $this->fechaCreacion,
            'fechaModificacion' => $this->fechaModificacion,
        ]);

        $query->andFilterWhere(['like', 'tipoTomaAgua', $this->tipoTomaAgua]);

        return $dataProvider;
    }
}
