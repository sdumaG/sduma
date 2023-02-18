<?php

use common\models\SolicitudGenerica;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenericaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Solicitudes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-generica-index">

    <h1><?= Html::encode($this->title) ?></h1>
   

<div class="modal fade  " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Label">Filtrar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>       
    </div>
  </div>
</div>

<p>
    <?= Html::a('Crear Solicitud', ["site/segunda"/* 'create' */], ['class' => 'btn btn-success']) ?>
</p>

<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Filtrar</button>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       /*  'filterModel' => $searchModel, */
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => "No. Solicitud",
                'attribute' => 'id',
            ],
            ['label'=>'Fecha creación',
                'value' => function($currSolicitud){                    
                   return date("d/M/Y h:i a",  strtotime( $currSolicitud->fechaCreacion)   );  
                }  
            ],
            ['label'=>'Solicita',
                'value' => function($currSolicitud){     
                    if($currSolicitud->id_PersonaFisica)               {
                        return $currSolicitud->personaFisica->nombre . " " .
                        $currSolicitud->personaFisica->apellidoP . " ".
                        $currSolicitud->personaFisica->apellidoM . " ";
                    }else if($currSolicitud->id_PersonaMoral){
                        
                        return $currSolicitud->personaMoral->denominacion." - ".
                        $currSolicitud->personaMoral->rfc;
                    }else{
                        return "Error al calcular.";
                    }
                   
                }  
            ],        
            
            [
                'label' => "Estado Solicitud",
                /* 'attribute' => 'statusSolicitud', */
                'value' => function($currSolicitud){                    
                    return 
                    SolicitudGenerica::STATUS_SOLICITUD[$currSolicitud->statusSolicitud];
                 }  
            ],
            //'superficiePorConstruir',
            //'areaPreExistente',
            //'tipoTomaAgua',
            //'numeroTomaAgua',
            //'fechaPagoAguaOContrato',
            //'numeroReciboAgua',
            //'subeRecibo',
            //'numeroPredial',
            //'fechaPagoPredial',
            //'altura',
            //'metrosLineales',
            //'id_MetrosLinealesDRO',
            //'id_AlturaDRO',
            //'id_PersonaFisica',
            //'id_PersonaMoral',
            //'id_Contacto',
            //'id_DomicilioNotificaciones',
            //'id_MotivoConstruccion',
            //'id_SolicitudGenericaCuentaCon',
            //'id_Escritura',
            //'id_ConstanciaEscritura',
            //'id_ConstanciaPosecionEjidal',
            //'id_TipoPredio',
            //'id_GeneroConstruccion',
            //'id_SubGeneroConstruccion',
            //'id_DomicilioPredio',
            //'id_DirectorResponsableObra',
            //'id_Archivo_MemoriaCalculo',
            //'id_Archivo_MecanicaSuelos',
            //'id_Archivo_LicenciaConstruccionAreaPreexistenteFile',
            //'id_User_CreadoPor',
            //'id_User_ModificadoPor',
            //'fechaCreacion',
            //'fechaModificacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SolicitudGenerica $model, $key, $index, $column) {

                return Url::toRoute([$action, 'id' => $model->id]);
                },
                'visibleButtons'=>[                    
                    'view' => true,
                    'delete' => false,
                    'update' => false,

                ]

            ],
        ],
    ]); ?>


</div>
