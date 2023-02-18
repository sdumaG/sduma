<?php

use common\models\Expediente;
use yii\helpers\Html;

/** @var yii\web\View $this  
* @var common\models\SolicitudConstruccion $modelSolicitudConstruccion  
* @var common\models\Contacto $soliContacto  
* @var common\models\Persona $propietarioPersona  
* @var common\models\Domicilio $soliDomicilioNotif  
* @var common\models\Domicilio $soliDomicilioPredio  
* @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments    
 * 
 */
$expenditenOwnerSoli = Expediente::findOne([
    'id' => $modelSolicitudConstruccion->id_Expediente,
]);
$this->title = 'Actualizar Solicitud  de Construcción '/*  . $model->id */;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud  de Construcción', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>
 <div class="d-flex justify-content-end">
     
    <a href=<?= "formrecibodoc?exp=$expenditenOwnerSoli->id" ?>  target="_blank" rel="noopener noreferrer" class="btn btn-info m-1" onclick="window.location() ">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg> 
        Imprimir recibo de documentación
    </a>

    <a href=<?= "printsolicitud?exp=$expenditenOwnerSoli->id" ?> target="_blank" rel="noopener noreferrer"  class="btn btn-primary m-1" onclick="window.location() ">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg> 
        Imprimir Solicitud de Construcción
    </a>
    
    <button type="button" class="btn btn-success m-1" onclick="">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg> 
        Imprimir Licencia
    </button>

 </div>
 


    <?= $this->render('_form', [
        'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
        'propietarioPersona' => $propietarioPersona,
        'soliDomicilioNotif' => $soliDomicilioNotif,
        'soliDomicilioPredio' => $soliDomicilioPredio,
        'soliContacto' => $soliContacto,
        'soliHasDocuments' => $soliHasDocuments,
        'formAction' => "solicitud-construccion/update?exp=$expenditenOwnerSoli->id",
        'expenditenOwnerSoli' => $expenditenOwnerSoli
    ]) ?>
</div>
