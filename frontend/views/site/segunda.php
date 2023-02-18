<?php
/** @var yii\web\View $this */
/** @var common\models\Domicilio2 $domicilioNotif */
/** @var common\models\Domicilio2 $domicilioPredio */
/** @var common\models\Persona $personaSolicita */
/** @var common\models\PersonaMoral $personaMoralSolicita */
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $modelTramiteMotivoCuentaConDoc[] */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $modelTramiteMotivoCuentaConDoc[] */
/** @var common\models\SolicitudGenericaCuentaCon $modelSolicitudGenericaCuentaConAvailables[] */

/** @var common\models\UploadFileVic $modelFilesRef_TramiteMotivoCuentaConDoc[] */
/** @var file $licenciaConstruccionAreaPreexistenteFile */
/** @var common\models\Contacto $modelContacto */
/** @var common\models\Persona $modelPropietarios[] */
/** @var common\models\DirectorResponsableObra $modelDROList[] */ //Existentes DROs activos

/** @var yii\web\View $this */
/** @var yii\web\View $this */

use common\models\DirectorResponsableObra;
use common\models\GeneroConstruccion;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MotivoConstruccion;
use common\models\SolicitudGenericaCuentaCon;
use common\models\SubGeneroConstruccion;
use common\models\TipoPredio;
use yii\web\JsExpression;
 ?>
<h1>Solicitud Construcción</h1>



<?php $form = ActiveForm::begin( [        
        'action' => ['site/segunda'],

        /*'id' => 'solicitudConstruccionForm',
        'method' => 'post',
        */'options' => [
          'enctype' => 'multipart/form-data'
            //'class' => 'row g-3',
        ],
    ]); ?>

  <section class="tipoPersona">
     
    <?=  $form->field($modelSolicitudGenerica, 'isSolicitaPersonaFisica')
        ->radioList( [0=>'Moral', 1 => 'Física'],[ "onchange"=>"solicitaTipoPersonaChange(event)"] )
        ->label("Tipo de persona");
    ?>    
  
  </section>

  <br>
  <section id="tipoPersonaParent">
    
    <?= $this->render("_persona",["persona"=>$personaSolicita,"form"=>$form,"idContainer"=>"contTramitaPersonaF"]) ?>
   
    <?= $this->render("_persona_moral",["personaMoral"=>$personaMoralSolicita,"form"=>$form,"idContainer"=>"contTramitaPersonaM"]) ?>
  
  </section>
  <br>
 
  <?= $this->render("_contacto",["form"=>$form,"modelContacto"=> $modelContacto])  ?>
  <br>
  
  <script>
    
    const contTramitaPersonaF = document.getElementById("contTramitaPersonaF");
    const contTramitaPersonaM = document.getElementById("contTramitaPersonaM");
    const tipoPersonaParent = document.getElementById("tipoPersonaParent");
    
    tipoPersonaParent.innerHTML = "";

    const solicitaTipoPersonaChange = function (event){
      let source = event.target || event.srcElement;
      let whatRender = source.value;
      showHideTipoPersona(whatRender);
      
    }

    const showHideTipoPersona = function (tipoPersona){
        if(tipoPersona==0){ //Moral
          //hide Fisica
          //Show moral
          tipoPersonaParent.innerHTML = "";
          tipoPersonaParent.appendChild(contTramitaPersonaM);
        }
        else if(tipoPersona==1){ //fisica
          //show Fisica
          //hide moral
          tipoPersonaParent.innerHTML = "";
          tipoPersonaParent.appendChild(contTramitaPersonaF);

        }else{//initial
          tipoPersonaParent.innerHTML = "";
        }
    }

    showHideTipoPersona('<?= $modelSolicitudGenerica->isSolicitaPersonaFisica ?>');
  </script>
  
  <?php  
    echo $this->render('_domicilio_fields', [
            'domicilio' => $domicilioNotif,
            'form' => $form,
            'id' => '0',//index del objeto domicilio
            'tipoDomicilio'=> "Domicilio para notificaciones",
            'showCallesColindantes' => false,
        ]) ?>  

  <br>

    <h5><?= Html::encode('Motivo de Solicitud') ?></h5>       
    <div  class="row">

      <?= $form
        ->field($modelSolicitudGenerica, 'id_MotivoConstruccion',['options' => ['class' => 'col-md-4']])
        ->dropDownList(
            $items =                    
              ArrayHelper::map(
                  MotivoConstruccion::findAll(['isActivo' => 1]),
                  'id',
                  function ($currentTipoTramite) {
                      return $currentTipoTramite[
                          'nombre'
                      ]; 
                  }
              )
              ,['onchange'=> new JsExpression("this.form.submit(); ")  ]

        )
        ->label('Motivo de solicitud') 
        ?>

        <?= $form
              ->field($modelSolicitudGenerica, 'id_SolicitudGenericaCuentaCon',['options' => ['class' => 'col-md-4']])
              ->dropDownList(
                  $items =                  
                      ArrayHelper::map(
                          $modelSolicitudGenericaCuentaConAvailables,
                          'id',
                          function ($curr) {
                            return $curr[
                                'nombre'
                            ]; 
                          }
                      )
                    ,
                    ['onchange'=> 'this.form.submit()' ]
              )
              ->label('Cuenta con') 
              ?>          

    </div>
  
  <br>
  <?php if($modelSolicitudGenerica-> id_SolicitudGenericaCuentaCon =="1"){   ?> 
  
    <?= $this->render("_escritura",['modelEscritura'=>$modelEscritura,'form'=>$form, 'idContainer'=>"contEscrituraFields"])  ?>

  <?php }else if($modelSolicitudGenerica-> id_SolicitudGenericaCuentaCon =="2"){ ?> 
    
    <?= $this->render("_constanciaEscritura",['modelConstanciaEscritura'=>$modelConstanciaEscritura,'form'=>$form, 'idContainer'=>"contConstanciaEscrituraFields"])  ?>
  
  <?php }else if($modelSolicitudGenerica-> id_SolicitudGenericaCuentaCon =="3"){ ?> 

    <?= $this->render("_constanciaPosecionEjidal",['modelConstanciaPosecionEjidal'=>$modelConstanciaPosecionEjidal,'form'=>$form, 'idContainer'=>"contConstanciaPosecionEjidalFields"])  ?>
  <?php }  ?> 
  <br>


  <?= $this->render("_agua",["form"=>$form,"modelSolicitudGenerica"=>$modelSolicitudGenerica])  ?>
  <br>
  <?php if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon != 3): /* CUANDO ES EJIDAL, no necesita predio */?> 
    <?= $this->render("_predial",["form"=>$form,"modelSolicitudGenerica"=>$modelSolicitudGenerica])  ?>
  <?php endif;  ?> 
  
  <script  type="text/javascript">


    /* document.addEventListener("DOMContentLoaded", function(event) {
      motivoSolicitudChange()
    }); */
    const motivoSolicitudChange = function (event){
      let source = event.target || event.srcElement;
      let whatRender = source.value;
      if(whatRender=='1'){
        //hide Fisica
        //Show moral
        document.getElementById("contTramitaPersonaF").style.display = "none";
        document.getElementById("contTramitaPersonaM").style.display = "flex";
      }
      else if(whatRender=='2'){
        //show Fisica
        //hide moral
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }else{//initial
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }
    }
    
    /* const contEscrituraFields = document.getElementById("contEscrituraFields");
    const contConstanciaEscrituraFields = document.getElementById("contConstanciaEscrituraFields");
    const contConstanciaPosecionEjidalFields = document.getElementById("contConstanciaPosecionEjidalFields");


    const cuentaConChange = function (event) {
      

      contEscrituraFields.style.display = "none";
      contConstanciaEscrituraFields.style.display = "none";
      contConstanciaPosecionEjidalFields.style.display = "none";

      let source = event.target || event.srcElement;
      let whatRender = source.value;
      
      switch (whatRender) {
        case "1"://Escritura
          contEscrituraFields.style.display = "flex";

          break;
          case "2": //Constancia Escritura
            contConstanciaEscrituraFields.style.display = "flex";
          break;
          case "3": //Constancia Poseción Ejidal
            contConstanciaPosecionEjidalFields.style.display = "flex";
          break;
        default:
          break;
      }
      
    }
     */

  </script>

 
  
  <br>
  <div class="row g3 border rounded-3  p-3">
    <h4>Información del predio </h4>
    <?= $form
        ->field($modelSolicitudGenerica, 'id_TipoPredio', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->dropDownList(
            $items = ArrayHelper::map(
                TipoPredio::findAll(['isActivo' => 1]),
                'id' /* closure too */,
                function ($currentTipoTramite) {
                    return $currentTipoTramite[
                        'nombre'
                    ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )
        )
        ->label('Tipo de predio') ?>

    <?= $form->field(
          $model = $modelSolicitudGenerica,
          $attribute = 'superficieTotal',
          ['options' => ['class' => 'col-md-3']]
      ) ?>
  </div>
<br>
  <div class="row g3 border rounded-3  p-3">
    
    <h4>Información de la construcción</h4>
    
    <?= $form
        ->field($modelSolicitudGenerica, 'id_GeneroConstruccion', [
            'options' => ['class' => 'col-md-4'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione género'],
                ArrayHelper::map(
                    GeneroConstruccion::findAll(['isActivo' => 1]),
                    'id',
                    'nombre'
                )
            ),
            ['onchange' => 'this.form.submit()'] //options
        )
        ->label('Genero de Construcción') ?>

    <!--  $form
        ->field($modelSolicitudGenerica, 'id_SubGeneroConstruccion', [
            'options' => ['class' => 'col-md-5'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione subgenero'],
                ArrayHelper::map(
                    SubGeneroConstruccion::findAll([
                        'isActivo' => 1,
                        'id_GeneroConstruccion' =>
                            $modelSolicitudGenerica->id_GeneroConstruccion,
                    ]),
                    'id',
                    function($currSubGenero){
                        return $currSubGenero->nombre." - ".$currSubGenero->nombreTarifa;
                    }
                    
                )
            )
        )
        ->label('Subgenero de Construcción')  -->


      <?= $this->render("_niveles",["form"=>$form,"mecanicaSuelosFile"=>$mecanicaSuelosFile,"modelSolicitudGenerica"=>$modelSolicitudGenerica])  ?>
        
      <?php if($modelSolicitudGenerica->id_GeneroConstruccion == GeneroConstruccion::findOne(["nombre"=>"Muros"])->id):  ?> 
        <?= $this->render("_motivo_muros",['form'=>$form, 'modelSolicitudGenerica'=> $modelSolicitudGenerica,"modelDROList"=>$modelDROList,])  ?>
      <?php else:  ?> 
        <?= $this->render("_motivo_todos",['form'=>$form,'memoriaCalculoFile'=>$memoriaCalculoFile ,'modelSolicitudGenerica'=> $modelSolicitudGenerica,'licenciaConstruccionAreaPreexistenteFile'=>$licenciaConstruccionAreaPreexistenteFile])  ?>
      <?php endif;  ?> 

    </div>
    
    <br>
      <?= $this->render('_domicilio_fields', [
            'domicilio' => $domicilioPredio,
            'form' => $form,'id' => '1',//index del objeto domicilio
            'tipoDomicilio'=> "Domicilio de predio",
            'showCallesColindantes' => true,
        ]) ?>  
   
   <br>

    
    <?= $this->render("_dro_dropdown",
    ["form"=>$form,
    "modelDROList"=>$modelDROList,
    'modelSolicitudGenerica'=> $modelSolicitudGenerica,
    "attributeNameDRO"=> "id_DirectorResponsableObra",
    "idContainer"=> ""
    ])  
    ?>      
    
    <br>
      
    <?= $this->render("_propietarios",["form"=>$form,"modelPropietarios"=>$modelPropietarios])  ?>
    <br>


    <?= $this->render("_entregables",
    [
      "modelTramiteMotivoCuentaConDoc"=>$modelTramiteMotivoCuentaConDoc,
      "modelFilesRef_TramiteMotivoCuentaConDoc"=>$modelFilesRef_TramiteMotivoCuentaConDoc,
      "form"=>$form
    ]
  )  ?>

<br>

<!-- cambiar a hidden -->
    <input type="text" name="stateRequestVic" id="stateRequestVic" value="">
    <script>
       const stateRequestVic =  document.getElementById("stateRequestVic");

        const preSendForm = function (valu="submit") {
          stateRequestVic.value = valu;
        }


    </script>
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'submit-button', "onclick"=>"preSendForm()"]) ?>
    </div>
<?php ActiveForm::end(); ?>
 


 