<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var common\models\DirectorResponsableObra[] $modelDROList */
/** @var  $form */
use yii\bootstrap5\Html;
use common\models\Documento;


$contInputTxtfirmaAlturaDROName = "contInputTxtfirmaAlturaDRO";
$contInputTxtfirmametrosLinealesDRO = "contInputTxtfirmametrosLinealesDRO";
?>


<div class="row g3 px-3 pt-3">

    <h6><?= Html::encode('Muros') ?></h6>       
    <?= $form
    ->field($modelSolicitudGenerica, 'altura',['options' => ['class' => 'col-md-5']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" , "min"=>"0",'onchange'=> 'alturaChange(event)']) 
    ?>
    <!-- SI es mayor a 2.5, desbloquear FIRMA DRO-->
    <?= $this->render("_dro_dropdown",
        ["form"=>$form,"modelDROList"=>$modelDROList,
        'modelSolicitudGenerica'=> $modelSolicitudGenerica,
        "attributeNameDRO"=> "id_AlturaDRO",
        "idContainer"=>$contInputTxtfirmaAlturaDROName
        ])  
    ?>

</div>

<div class="row g3 px-3 pb-3">


    <?= $form
    ->field($modelSolicitudGenerica, 'metrosLineales',['options' => ['class' => 'col-md-5']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" ,"min"=>"0",'onchange'=> 'metrosLinealesChange(event)']) 
    ?>

    <?= $this->render("_dro_dropdown",
        ["form"=>$form,"modelDROList"=>$modelDROList,
        'modelSolicitudGenerica'=> $modelSolicitudGenerica,
        "attributeNameDRO"=> "id_MetrosLinealesDRO",
        "idContainer"=>$contInputTxtfirmametrosLinealesDRO
        ])  
    ?>   
    <!-- SI es mayor 30 metros lineales, desbloquear FIRMA DRO-->

</div>


<script>	

    const contInputTxtfirmaAlturaDROName = document.getElementById('<?=$contInputTxtfirmaAlturaDROName ?>' );
    const contInputTxtfirmaAlturaDROName_Parent = contInputTxtfirmaAlturaDROName.parentElement;

    const contInputTxtfirmametrosLinealesDRO = document.getElementById('<?=$contInputTxtfirmametrosLinealesDRO ?>' );
    const contInputTxtfirmametrosLinealesDRO_Parent = contInputTxtfirmametrosLinealesDRO.parentElement;


    const alturaChange = function(event){
        //desbloquea FIRMA DRO
        let source = event.target || event.srcElement;
        let alturaInput = source.value;
        hideShowAlturaDRO_dd(alturaInput);
    }

    const hideShowAlturaDRO_dd = function (alturaAmount){

        /* if(!alturaAmount)contInputTxtfirmaAlturaDROName.remove();
        else  */
        if(alturaAmount >= 2.5){
            contInputTxtfirmaAlturaDROName_Parent.appendChild(contInputTxtfirmaAlturaDROName);
        }
        else{
            contInputTxtfirmaAlturaDROName.remove();            
        }        
    }

    const metrosLinealesChange = function(event){
        //desbloquea FIRMA DRO
        let source = event.target || event.srcElement;
        let metrosLinealesInput = source.value;
        hideShowMetrosLienalesDRO_dd(metrosLinealesInput);
    }

    const hideShowMetrosLienalesDRO_dd = function(metrosLineales){

            
       /*  if(!metrosLineales)contInputTxtfirmametrosLinealesDRO.remove();
        else  */
        if(metrosLineales > 30){
            contInputTxtfirmametrosLinealesDRO_Parent.appendChild(contInputTxtfirmametrosLinealesDRO);
        }
        else{
            contInputTxtfirmametrosLinealesDRO.remove();            
            
        }

    }

    hideShowAlturaDRO_dd(<?= $modelSolicitudGenerica->altura  ?>)
    hideShowMetrosLienalesDRO_dd(<?= $modelSolicitudGenerica->metrosLineales  ?> )



</script>