<?php

namespace common\models;
use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Expediente;

/**
 * ExpedienteSearch represents the model behind the search form of `common\models\Expediente`.
 */
class ExpedienteSearch extends Expediente
{
      /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idAnual', 'anio', 'estado', 'id_SolicitudGenerica', 'id_User_CreadoPor', 'id_User_modificadoPor', 'id_TipoTramite'], 'integer'],
            [['fechaCreacion', 'fechaModificacion'], 'safe'],
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
    public $nombre = "";
    public $apellidoP = "";
    public $apellidoM = "";
    public function search($params)
    {
        $query = Expediente::find()
            ->join("LEFT JOIN","SolicitudGenerica",'Expediente.id_SolicitudGenerica = SolicitudGenerica.id') //ahora los datos del solicitante se obtienen por medio del relation
            //->select("Persona.*"/* ,"Persona.*" */) //delegar           
           ;
        $user = $params["userModel"];
        if($user->id_UserLevel == User::USER_LEVEL_ADMIN){
            //TODOS
        }else
        if($user->id_UserLevel == User::USER_LEVEL_INTERNO){
            //TODOS
        }else
        if($user->id_UserLevel == User::USER_LEVEL_EXTERNO){
            //FILTRADO
            //$query = $query->where(["id_User_CreadoPor"=>$user->id]);
            $query = $query->where(["SolicitudGenerica.id_User_CreadoPor"=>$user->id]);
        }
           
        
           
        /* ob_start();
        var_dump($params);
        Yii::debug(ob_get_clean(), __METHOD__); */

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        //el actual modelo se carga en THIS, pero si el formulario de busqueda incluye parametros que no son propiedades
        //del modelo, entonces no se pasan, para accederlo seria desde params., esto lo puedo aplicar al filtro final        
        $this->load($params);
/*         $this->nombre = isset( $params["nombre"]) ? $params["nombre"]:"" ;
        $this->apellidoP = isset( $params["apellidoP"]) ? $params["apellidoP"]:"" ;
        $this->apellidoM = isset( $params["apellidoM"]) ? $params["apellidoM"]:"" ; */

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query
        ->orderBy(['id'=>SORT_DESC, 'anio'=>SORT_DESC, 'idAnual'=>SORT_DESC, ])
        ->andFilterWhere([
            'id' => $this->id,
            'idAnual' => $this->idAnual,
            'anio' => $this->anio,
            'fechaCreacion' => $this->fechaCreacion,
            'fechaModificacion' => $this->fechaModificacion,
            'estado' => $this->estado,
            'id_SolicitudGenerica' => $this->id_SolicitudGenerica,
            'id_User_CreadoPor' => $this->id_User_CreadoPor,
            'id_User_modificadoPor' => $this->id_User_modificadoPor,
            'id_TipoTramite' => $this->id_TipoTramite,
            'nombre' => $this->nombre ,
            'apellidoP' => $this->apellidoP ,
            'apellidoM' => $this->apellidoM ,
           /*  'apellidoP' => $params["apellidoP"],
            'apellidoM' => $params["apellidoM"], */
 
        ]) 
         ;

        
        return $dataProvider;
    }
}
