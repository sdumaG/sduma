<?php 
/** @var common\models\ConfigTramiteMotivoCuentaconDoc[] $modelTramiteMotivoCuentaConDoc */
/** @var common\models\UploadFileVic $modelFilesRef_TramiteMotivoCuentaConDoc[] */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
use common\models\Documento;
?>

<?php if($modelTramiteMotivoCuentaConDoc):  ?> 
    <table id="tableEntregables" class="table table-hover  ">
        <thead>
            <tr>                                   
                <th scope="col">Entregable</th>
                <th scope="col">Subir Archivo</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($modelTramiteMotivoCuentaConDoc as $id => $currEntregable) { ?>
                <tr <?php echo "id = 'docRow$id' "  ?> >                                     

                    <td>                        
                        <?= $form
                            ->field($currEntregable->documento, "[$id]id", [//id_Documento same
                                'options' => ['class' => 'col-md-1', 'display' => 'none'],
                            ])
                            ->hiddenInput()/* textInput() */
                            ->label(false) 
                        ?>    
                        <?=Html::label($currEntregable->documento->nombre)?>     
                                 
                    </td>
                    <td>
                        <!-- Referencia al FILE - Archivo models -->
                        <?php if($currEntregable->documento->isSoloEntregaFisica):  ?> 
                            <?=Html::label("Este documento se entrega de manera física únicamente.")?>     
                        <?php else:  ?> 

                            <?= $form
                                ->field($modelFilesRef_TramiteMotivoCuentaConDoc["$currEntregable->id_Documento"], 
                                    "[$currEntregable->id_Documento]myFile",
                                    //['options' => ['class' => 'form-control ',]]
                                )
                                ->fileInput([/* 'multiple' => true,  */'accept' => '.pdf,.jpeg,.jpg,.png']) 
                                ->label(false)        
                                ?>
                        <?php endif;  ?> 
                      

                    </td>
                </tr>
            <?php } ?>


        
        </tbody>
    </table>

<?php else:?>
    <div class="row g3 border rounded-3  p-3">

        <h5>Elija una motivo de solicitud y el documento con el que cuenta, para poder subir la documentación necesaria.</h5>
    </div>

<?php endif;  ?> 
