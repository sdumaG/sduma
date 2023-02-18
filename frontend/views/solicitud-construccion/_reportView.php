
<?php

use common\models\Documento;
use common\models\Expediente;
use yii\bootstrap5\Html;
/* @var common\models\Expediente  $expediente */
/* @var common\models\SolicitudConstruccion $solicitudConstruccion*/
/* @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments
?>
<?php  
  /* $baseUrl = Yii::$app ->baseUrl; 
  $cs = Yii::$app->getClientScript();
  //$cs->registerScriptFile($baseUrl.'/js/yourscript.js');
  $cs->registerCssFile($baseUrl.'/css/printStyle.css'); */
/*     $assets = '../css';

    $baseUrl = Yii::$app ->assetManager->publish($assets); */
/*     ob_start();
    var_dump($baseUrl);
    Yii::debug(ob_get_clean(),"set css"); */
    // $this->registerCss("uwu",["href"=>$assets . '/printStyle.css']);
    //$this->registerLinkTag(["href"=> $assets . '/printStyle.css',"rel"=>"stylesheet"])
  

  /*  Html::tag('link', '', $options); */
   // Yii::$app ->clientScript()->registerCssFile(  $baseUrl . '/css/style.css');

?>
    
<button id="print-btn" class="btn btn-success m-1"  onclick="window.print(); ">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
    </svg> 
    Imprimir
</button>

<div class="container recibo-doc pt-3 pb-3">
    <div class="d-flex flex-column flex-sm-nowrap align-items-center">
        <div >DIRECCIÓN DE DESARROLLO URBANO</div>
        <div>VENTANILLA DE ATENCIÓN AL PÚBLICO (TRÁMITES)</div>
        <div><b> RECIBO DE DOCUMENTACIÓN</b></div>
    </div>

    <div>
        <b>EXPEDIENTE:</b> <?= $expediente->idAnual . '/' . $expediente->anio ?>
    </div> 

    <div>
        <b>
            SOLICITUD DE CONSTRUCCIÓN: 
        </b>
        <?= $solicitudConstruccion->motivoConstruccion->nombre  ?>
    </div>
    <div>
        <?= "Fecha de respuesta: "."_______"." / "."20______" ?>
    </div>

    <div>
        <?= 
            "RECIBÍ DEL (LA) C. "
            .$expediente->personaSolicita->nombre." "
            .$expediente->personaSolicita->apellidoP." "
            .$expediente->personaSolicita->apellidoM
        ?>
    </div>

 

    <div class="d-flex flex-column flex-sm-nowrap align-items-center mt-3 mb-4">
        <div class="mb-2">
            DOCUMENTOS ENTREGADOS
        </div>
        <div class="container-xl">

            <?php foreach (array_chunk($soliHasDocuments,2, $preserve_keys = true) as $currCouple) { ?>
                
                <div class="row ">
                    <?php foreach ($currCouple as $key => $soliHasDocument ) { ?> 
                        <div class="col text-break" >
                            <?= Html::checkbox("[$key]id_Documento",$soliHasDocument->isEntregado,
                                /* [
                                    'options' => ['class' => 'col-md-1', 'display' => 'none'],
                                ] */);
                            ?>   
                            <span >                                
                                <?=  (Documento::findOne( ["id"=>$soliHasDocument->id_Documento/* /84 */]) -> nombre )  ?>            
                            </span>                                                    
                        </div>

                    <?php }  ?> 
                </div>
                
            <?php }  ?> 




        </div>

    </div>

<!-- footer -->
<div class="d-flex flex-column align-items-center">
    <div>
        URUAPAN, MICH. A <?= date('d');  ?> de <?= date('F');  ?> del <?= date('Y');   ?> - <?= date('h:i a');   ?>
    </div>
    <div>
        RECIBIÓ: <?= Yii::$app->user->identity->username  ?>
    </div>
    <div >TEL. 52 3 72 87</div>

</div>
 
    
</div>
 