<?php
/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
 
/** @var common\models\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $nombre */
/** @var string $apellidoP */
/** @var string $apellidoM */
use common\models\Expediente;
use common\models\UtilVic;
use common\models\WidgetStyleVic;
use LDAP\Result;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample">Filtrar</button>

    <div class="collapse" id="collapseExample">
      <div class="card card-body">

        <?php echo $this->render('_search', ['model' => $searchModel,/* 'nombre'=> $nombre, 'apellidoP'=>$apellidoP,'apellidoM'=>$apellidoM */]); ?>

      </div>
    </div>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Nuevo Expediente
    </button> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       /*  'filterModel' => $searchModel, */
        'pager' => WidgetStyleVic::PagerStyle(),                
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'label' => "Expediente #",
              'attribute' => 'tipoTramite.nombre',
              'value' => function($currExpediente){
                return $currExpediente->idAnual . "/".$currExpediente->anio;
              }
            ],
            ['label'=>'Fecha creación',
                'value' => function($currExpediente){                    
                   return date("d/M/Y h:i a",  strtotime( $currExpediente->fechaCreacion)   );  
                }  
            ],
            [
              'label' => "Tipo de trámite",               
              'value' => function($currExpediente){
                return $currExpediente->tipoTramite->nombre;
              }
            ],
            [
              'label' => "Solicita",
              'value' => function($currExpediente){
                $solicitaPersonaMoral =  $currExpediente->solicitudGenerica->personaMoral;
                $solicitaPersonaFisica =  $currExpediente->solicitudGenerica->personaFisica;
                $result = "ERROR OBTENIENDO";

                $result = $solicitaPersonaFisica? 
                    $solicitaPersonaFisica->nombre. " ". $solicitaPersonaFisica->apellidoP . " ". $solicitaPersonaFisica->apellidoM
                    :
                    $solicitaPersonaMoral->denominacion. " - ". $solicitaPersonaMoral->rfc 
                    ;

                return  $result;
              }              
            ],

            [
              'label' => "Estado",
              'value' => function($currExpediente){
                
                return Expediente::STATUS_EXPEDIENTE[$currExpediente->estado];
              }
            ],
            [
              'header' => 'Cambiar Estado',
              'class' => ActionColumn::class,
              'template' => '{made}',
              'buttons'=> [                
                'made' => function ($url, $model) {
                  if(!UtilVic::isEmployee()){
                    return Html::encode( Expediente::STATUS_EXPEDIENTE[$model->estado] );
                  }
                  else{

                      switch(Expediente::STATUS_EXPEDIENTE[$model->estado]){
                        case Expediente::STATUS_EXPEDIENTE[0]:
                          return Html::a( Expediente::STATUS_EXPEDIENTE[1], '/expedientes/changestate?id='.$model->id."&newState=1", ['class' => 'btn btn-success']);
                          break;
                        case Expediente::STATUS_EXPEDIENTE[1]:
                          return Html::tag("div", 
                            Html::a( Expediente::STATUS_EXPEDIENTE[2], '/expedientes/changestate?id='.$model->id."&newState=2", ['class' => 'btn btn-danger'])
                            .
                            Html::a( Expediente::STATUS_EXPEDIENTE[3], '/expedientes/changestate?id='.$model->id."&newState=3", ['class' => 'btn btn-success'])
                          
                          );
                        break;
                        
                        default: 
                          return "COMPLETADA";
                      }                    

                  }
                  
                }
              ],
            ],
            [
              'header' => 'Acciones',
              'class' => ActionColumn::class,
              'template' => '{view} {update} {delete} {print} ',   
              'buttons'=> [                
                'print' => function ($url, $model) {
                  if(UtilVic::isEmployee()){
                    if($model->estado == 3){
                      return Html::a(
                        '
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                          </svg>
                        '
                        ,$url
                        ,["target" => "_blank"]

                      );
                    }
                    return "";
                  }
                  else{
                    return "";
                  }
                 
                }
              ],         
              'urlCreator' => function ($action, Expediente $model, $key, $index, $column) {

                  if ($action == "view") {
                    return Url::to(['solicitud-generica/view', 'id' => $model->solicitudGenerica->id]);
                  }
                  if ($action == "print") {
                    return Url::to(['expedientes/print', 'id' => $model->id]);
                  }

                  return Url::to([$action, 'id' => $key]);

                },
                'visibleButtons'=>[
                  /* 'view'=> function($model){
                      return $model->status!=1; //puede aparecer o no, segun el estado del modelo :0 awesome xd
                  }, */
                  'view' => true,
                  'update' => UtilVic::isEmployee(),
                  'delete' => UtilVic::isEmployee(),
                  'print' =>  UtilVic::isEmployee()
              ]   
            ],
        ],
    ]); ?>


</div>