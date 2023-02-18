<?php

use common\models\GeneroConstruccion;
use common\models\SolicitudGenerica;
use common\models\SolicitudGenerica_has_Documento;
use common\models\SolicitudGenerica_has_Persona;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenerica $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Genericas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solicitud-generica-view">

    <?php if($model->statusSolicitud == SolicitudGenerica::STATUS_VALIDADA){ ?>

        <p>         
            <a href=<?= "imprimir-solicitud?id=$model->id" ?>  target="_blank" rel="noopener noreferrer" class="btn btn-success m-1" onclick="window.location() ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg> 
            Imprimir Solicitud
            </a>
        </p>    

    <?php } ?>


    <?php $form = ActiveForm::begin([
        'action' => ['/solicitud-generica/changestate'],
        'method' => 'post',
    ]); ?>

        <div class="container">
            <input type="hidden" name="id" value="<?=$model->id?>" />
            <div class="  row ">
                <p class="col-5">
                    <?= Html::dropDownList("newState",$model->statusSolicitud,$availableStates,["class"=>"form-select "])  ?> 
                </p>
                <?php if( count( $availableStates) > 1 ) { ?> <!-- Significa que la sesión es de un empleado, por tanto puede editar -->
                    <p class="col-3">
                        <?= Html::submitButton("Cambiar estado de solicitud",["class"=>"btn btn-success "])  ?> 
                    </p>
                <?php } ?>
    
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <h2><?= Html::encode('Resúmen de solicitud') ?></h2>    

    <h4><?= Html::encode("") ?></h4> 
   
    <h5> <b> Motivo de solicitud: </b> <?= Html::encode($model->motivoConstruccion->nombre )  ?> </h5>
    <h5> <b> Documento a entregar: </b> <?= Html::encode($model->solicitudGenericaCuentaCon->nombre )  ?> </h5>
    
    <br>

    <h4><?= Html::encode("Datos de " . strtolower( $model->solicitudGenericaCuentaCon->nombre )) ?></h4>       
    

    <?php if($model-> id_SolicitudGenericaCuentaCon =="1"){   ?> 
  
        <h5> <b> No. Escritura: </b> <?= Html::encode($model->escritura->noEscritura)  ?> </h5>
        <h5> <b> No. Registro: </b> <?= Html::encode($model->escritura->noRegistro )  ?> </h5>
        <h5> <b> No. Tomo: </b> <?= Html::encode($model->escritura->noTomo )  ?> </h5>

    <?php }else if($model-> id_SolicitudGenericaCuentaCon =="2"){ ?> 

        <h5> <b> Fecha de emisión: </b> <?= Html::encode(date("d-m-Y",strtotime( $model->constanciaEscritura->fechaEmision) ) )  ?> </h5>
        <h5> <b> No. Escritura: </b> <?= Html::encode($model->constanciaEscritura->noEscritura)  ?> </h5>
        <h5> <b> No. de Notaria: </b> <?= Html::encode($model->constanciaEscritura->noNotaria )  ?> </h5>


    <?php }else if($model-> id_SolicitudGenericaCuentaCon =="3"){ ?> 
        <h5> <b> Fecha de emisión: </b> <?= Html::encode(date("d-m-Y",strtotime($model->constanciaPosecionEjidal->fechaEmision ) ))  ?> </h5>
        <h5> <b> No. Constancia: </b> <?= Html::encode($model->constanciaPosecionEjidal->noConstanciaPosEjidal )  ?> </h5>
        <h5> <b> Emitió: </b> <?= Html::encode($model->constanciaPosecionEjidal->nombreQuienEmitio)  ?> </h5>


    <?php }  ?> 
    <br>

    <h4><?= Html::encode("Solicita") ?></h4>       
    <?php if($model->isSolicitaPersonaFisica == "1"){  ?> 
        <h5> <b> Persona Fisica: </b> <?= Html::encode($model->personaFisica->nombre . " " . $model->personaFisica->apellidoP. " " . $model->personaFisica->apellidoM)  ?> </h5>
        
    <?php }else{  ?> 
        <h5> <b> Persona Moral: </b> <?= Html::encode($model->personaMoral->rfc . " - " . $model->personaMoral->denominacion)  ?>  </h5>
    <?php }  ?> 

    <br>

    <h4><?= Html::encode("Contacto") ?></h4>       
    <h5><b>Email: </b><?= Html::encode($model->contacto->email )  ?> </h5>
    <h5><b>Teléfono: </b><?= Html::encode($model->contacto->telefono )  ?> </h5>
    
    <br>
    
    
    <br>
    <h4><?= Html::encode("Domicilio para notificaciones") ?></h4>       


    <div class="row"> 
        <div class="col">

            <h5><b>Calle: </b><?= Html::encode($model->domicilioNotificaciones->calle )  ?> </h5>
            <h5><b>Colonia/Fracc/Barrio: </b><?= Html::encode($model->domicilioNotificaciones->coloniaFraccBarrio )  ?> </h5>
            <h5><b>Código Postal: </b><?= Html::encode($model->domicilioNotificaciones->cp )  ?> </h5>
            <h5><b>Calle Norte: </b><?= Html::encode($model->domicilioNotificaciones->calleNorte )  ?> </h5>
            <h5><b>Calle Sur: </b><?= Html::encode($model->domicilioNotificaciones->calleSur )  ?> </h5>
        </div>
        <div class="col">
            <div class="row">
                
                <h5><b>No. Exterior: </b><?= Html::encode($model->domicilioNotificaciones->numExt )  ?> </h5>
                <h5><b>No. Interior: </b><?= Html::encode($model->domicilioNotificaciones->numInt )  ?> </h5>
            </div>
            <div class="row">
                <h5> </h5>
            </div>
            <h5><b>Calle Oriente: </b><?= Html::encode($model->domicilioNotificaciones->calleOriente )  ?> </h5>
            <h5><b>Calle Poniente: </b><?= Html::encode($model->domicilioNotificaciones->callePoniente )  ?> </h5>

        </div>

    </div>

    <br>

    <h4><?= Html::encode("Datos de recibo de agua") ?></h4>       
        <h5><b>Fecha de pago de agua o contrato: </b><?= Html::encode(date("d-m-Y", strtotime( $model->fechaPagoAguaOContrato ) ) )  ?> </h5>
        <h5><b>Tipo de toma de agua: </b><?= Html::encode($model->tipoTomaAgua )  ?> </h5>
        <h5><b>Número de toma de agua: </b><?= Html::encode($model->numeroTomaAgua )  ?> </h5>
        <h5><b>Número de recibo de agua: </b><?= Html::encode($model->numeroReciboAgua )  ?> </h5>
        <h5><b>Entrega: </b><?= Html::encode(($model->subeRecibo == "1" ? "Recibo de agua":"Contrato de agua") )  ?> </h5>
    <br>

    <?php if($model->id_SolicitudGenericaCuentaCon != 3): /* CUANDO ES EJIDAL, no necesita predio */?> 
        
        <h4><?= Html::encode("Datos de predial") ?></h4>       
        <h5><b>Fecha de pago de predial: </b><?= Html::encode(date("d-m-Y", strtotime( $model->fechaPagoAguaOContrato ) ) )  ?> </h5>
        <h5><b>Número de predial: </b><?= Html::encode($model->numeroPredial )  ?> </h5>            
    <?php endif;  ?> 

    <!-- No pide datos de predial cuando trae Constancia ejidal  -->
    <br>
    <h4><?= Html::encode("Documentos entregados") ?></h4>
    <table id="tableEntregables" class="table table-hover  ">
        <thead>
            <tr>                                   
                <th scope="col">Entregable</th>
                <th scope="col">Entregado</th>
                <th scope="col">Descarga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->solicitudGenericaHasDocumentos as $id => $currEntregable) { ?>
                <tr <?php echo "id = 'docRow$id' "  ?> >
                    <td><?=$currEntregable->documento->nombre ?> </td>
                    <td><?=$currEntregable->isEntregado =="1"?"SI":"NO" ?> </td>
                    <td>
                        <?php if(!$currEntregable->documento->isSoloEntregaFisica){ ?>
                        
                            <div>
                                <?= Html::a(
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg> ', 
                                
                                        "archivo-solicitud?solicitud=$model->id&documento=".$currEntregable->documento->id, 

                                        ['target' => '_blank', 'class' => 'btn btn-success m-1 fl download_link']) 
                                    ?>
                            </div>

                    <?php } else{?>
                            <!-- nada -->
                    <?php } ?>

                </tr>                                
            <?php } ?>
        </tbody>


    </table>

    <br>

    <h4><?= Html::encode("Información del predio") ?></h4>       
    <h5><b>Predio tipo: </b><?= Html::encode($model->tipoPredio-> nombre )  ?> </h5>            
    <h5><b>Superficie total del predio: </b><?= Html::encode($model->superficieTotal )  ?> </h5>            
    
    <br>
    
    <h4><?= Html::encode("Información de la construcción") ?></h4>       
    
    <br>
    <h5><b>Director Responsable de obra: </b><?= Html::encode($model->directorResponsableObra->abreviacion . " ". $model->directorResponsableObra->persona->nombre . " " .$model->directorResponsableObra->persona->apellidoP . " " .$model->directorResponsableObra->persona->apellidoM )  ?> </h5>            
    <br>
    <h5><b>Género de la construcción: </b><?= Html::encode($model->generoConstruccion->nombre )  ?> </h5>            
    <!-- <h5><b>Sub Género de la construcción: </b>  Html::encode($model->subGeneroConstruccion->nombre )    </h5>  -->           
        
    <?php if($model->id_GeneroConstruccion == GeneroConstruccion::findOne(["nombre"=>"Muros"])->id):  ?> 
        <!-- Motivo muros -->
       <div class="row">
           <h5><b>Altura: </b><?= Html::encode($model->altura )  ?> </h5>
           <?php if($model->altura >= 3){  ?> 
                <h5><b>Director Responsable de obra: </b><?= Html::encode($model->alturaDRO->abreviacion . " ". $model->directorResponsableObra->persona->nombre . " " .$model->directorResponsableObra->persona->apellidoP . " " .$model->directorResponsableObra->persona->apellidoM )  ?> </h5>            
            <?php }  ?> 

       </div>
       <div class="row">
            <h5><b>Metros lineales: </b><?= Html::encode($model->metrosLineales )  ?> </h5>
            <?php if($model->metrosLineales >= 250){  ?> 
                <h5><b>Director Responsable de obra: </b><?= Html::encode($model->metrosLinealesDRO->abreviacion . " ". $model->metrosLinealesDRO->persona->nombre . " " .$model->metrosLinealesDRO->persona->apellidoP . " " .$model->metrosLinealesDRO->persona->apellidoM )  ?> </h5>            
            <?php }  ?> 

       </div>
        
        
    <?php else:  ?> 
        <!-- motivos todos -->                
            <h5><b>Niveles: </b><?= Html::encode($model->niveles )  ?> </h5>
            <h5><b>Superficie por construir: </b><?= Html::encode($model->superficiePorConstruir )  ?> </h5>
            <h5><b>Area preexistente: </b><?= Html::encode($model->areaPreExistente )  ?> </h5>

    <?php endif;  ?> 

      
    <br>

    <div class="row"> 
        <div class="col">

            <h5><b>Calle: </b><?= Html::encode($model->domicilioPredio->calle )  ?> </h5>
            <h5><b>Colonia/Fracc/Barrio: </b><?= Html::encode($model->domicilioPredio->coloniaFraccBarrio )  ?> </h5>
            <h5><b>Código Postal: </b><?= Html::encode($model->domicilioPredio->cp )  ?> </h5>
            <h5><b>Calle Norte: </b><?= Html::encode($model->domicilioPredio->calleNorte )  ?> </h5>
            <h5><b>Calle Sur: </b><?= Html::encode($model->domicilioPredio->calleSur )  ?> </h5>
        </div>
        <div class="col">
            <div class="row">
                
                <h5><b>No. Exterior: </b><?= Html::encode($model->domicilioPredio->numExt )  ?> </h5>
                <h5><b>No. Interior: </b><?= Html::encode($model->domicilioPredio->numInt )  ?> </h5>
            </div>
            <div class="row">
                <h5> </h5>
            </div>
            <h5><b>Calle Oriente: </b><?= Html::encode($model->domicilioPredio->calleOriente )  ?> </h5>
            <h5><b>Calle Poniente: </b><?= Html::encode($model->domicilioPredio->callePoniente )  ?> </h5>

        </div>

    </div>

    <br>
    <h4><?= Html::encode("Propietarios") ?></h4>       
    <ul class="list-group">
        <?php foreach ( SolicitudGenerica_has_Persona::findAll(["id_SolicitudGenerica"=>$model->id]) as $id => $curr) { ?>            
            <?= Html::tag("li",$curr->persona->nombre . " " . $curr->persona->apellidoP. " " . $curr->persona->apellidoM,["class"=>"list-group-item"])  ?>
        <?php } ?>
    </ul>
    

       


</div>

