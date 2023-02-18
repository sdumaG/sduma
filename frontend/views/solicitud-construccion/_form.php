<?php

use common\models\CorrSeguridadEstruc;
use common\models\GeneroConstruccion;
use common\models\MotivoConstruccion;
use common\models\SolicitudConstruccion;
use common\models\SubGeneroConstruccion;
use common\models\DirectorResponsableObra;
use common\models\Documento;
use common\models\Expediente;
use common\models\SolicitudConstruccionHasPersona;
use common\models\TipoConstruccion;
use common\models\TipoPredio;
use PhpParser\Node\Expr\Cast\Array_;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

/**
 * @var common\models\SolicitudConstruccion $modelSolicitudConstruccion
 * @var common\models\Contacto $soliContacto
 * @var common\models\Persona $propietarioPersona
 * @var common\models\Domicilio $soliDomicilioNotif
 * @var common\models\Domicilio $soliDomicilioPredio
 * @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments
 * @var string $formAction    
 * @var common\models\Expediente $expenditenOwnerSoli
 */
?>

<div class="solicitud-construccion-form">

    <?php $form = ActiveForm::begin([
        'action' => [$formAction/* 'solicitud-construccion/create' */],
        'id' => 'solicitudConstruccionForm',
        'method' => 'post',
        'options' => [
            'class' => 'row g-3',
        ],
    ]); ?>

    <h3><?= 'Solicitud para expediente: ' .
        $expenditenOwnerSoli->idAnual .
        '/' .
        $expenditenOwnerSoli->anio ?></h5> 
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_Expediente', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ]) /* ->textInput() */
        ->hiddenInput()
        ->label(false) ?>
    
    <?= $form
        ->field($modelSolicitudConstruccion, 'fechaCreacion', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>
    <?= $form
        ->field($modelSolicitudConstruccion, 'fechaModificacion', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>

    <?= $form
        ->field($modelSolicitudConstruccion, 'isDeleted', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_User_ModificadoPor', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>


    <?= $form
        ->field($modelSolicitudConstruccion, 'id_User_CreadoPor', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->/* textInput()-> */ hiddenInput()
        ->label(false) ?>

    <h4>Propietario</h4>

    
    <?= $form
        ->field($propietarioPersona, 'nombre', [
            'options' => ['class' => 'col-md-7'],
        ])
        ->textInput() ?>
    <?= $form
        ->field($propietarioPersona, 'apellidoP', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->textInput() ?>
    <?= $form
        ->field($propietarioPersona, 'apellidoM', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->textInput() ?>
 
 
    <h5><?= Html::encode('Contacto') ?></h5> 
    
    <?= 
    $form->field($modelSolicitudConstruccion, 'id_Contacto',
    
    ['options' => ['class' => 'col-md-0', 'display' => 'none'],]

    )
    ->hiddenInput()
    ->label(false)
    ?>




    <?= $form
        ->field($soliContacto, 'email', ['options' => ['class' => 'col-md-3']])
        ->textInput() ?>

    <?= $form
        ->field($soliContacto, 'telefono', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->textInput() ?>


    <h5><?= Html::encode('Domicilio para notificaciones') ?></h5>       
    <?= $form
        ->field(
            $modelSolicitudConstruccion,
            'id_DomicilioNotificaciones',
            ['options' => ['class' => 'col-md-1', 'display' => 'none'],]
        )
        ->hiddenInput()
        ->label(false) ?>
 
    <?= $this->render('_domicilio_fields', [
        'domicilio' => $soliDomicilioNotif,
        'form' => $form,
        'id' => '0',
    ]) ?>           

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_MotivoConstruccion')
        ->dropDownList(
            $items = ArrayHelper::map(
                MotivoConstruccion::findAll(['isActivo' => 1]),
                'id' /* closure too */,
                function ($currentTipoTramite) {
                    return $currentTipoTramite[
                        'nombre'
                    ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )
        )
        ->label('Motivo de solicitud') ?>


    <h4>Información del predio </h4>
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_TipoPredio', [
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
        ->label('Tipo de predio Dropdown') ?>

   <?= $form->field(
       $model = $modelSolicitudConstruccion,
       $attribute = 'superficieTotal',
       ['options' => ['class' => 'col-md-3']]
   ) ?>

   <?= $form
       ->field($modelSolicitudConstruccion, 'superficiePorConstruir', [
           'options' => ['class' => 'col-md-3'],
       ])
       ->textInput() ?>
   

    <h5><?= Html::encode('Domicilio del predio') ?></h5>   
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_DomicilioPredio', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>

        
    <?= $this->render('_domicilio_fields', [
        'domicilio' => $soliDomicilioPredio,
        'form' => $form,
        'id' => '1',
    ]) ?>           



   
    
   <h4>Información de la construcción</h4>
   
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_GeneroConstruccion', [
           'options' => ['class' => 'col-md-3'],
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
 <!-- ['onchange'=>'this.form.submit()'] //options -->
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_SubGeneroConstruccion', [
           'options' => ['class' => 'col-md-3'],
       ])
       ->dropDownList(
           $items = ArrayHelper::merge(
               ['0' => 'Seleccione subgenero'],
               ArrayHelper::map(
                   SubGeneroConstruccion::findAll([
                       'isActivo' => 1,
                       'id_GeneroConstruccion' =>
                           $modelSolicitudConstruccion->id_GeneroConstruccion,
                   ]),
                   'id',
                   function($currSubGenero){
                        return $currSubGenero->nombre." - ".$currSubGenero->nombreTarifa;
                   }
                   
               )
           )
       )
       ->label('Subgenero de Construcción') ?>
    
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_TipoConstruccion', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione Tipo Construcción'],
                ArrayHelper::map(
                    TipoConstruccion::findAll([
                        'isActivo' => 1,
                    ]),
                    'id',
                    'nombre'
                )
            )
        )
        ->label('Tipo Construcción') ?>
    




    <div class ="row g3">
        
        <?= $form
            ->field($modelSolicitudConstruccion, 'niveles', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput() ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'cajones', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput() ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'COS', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'CUS', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

    </div>

    <?= $form
        ->field($modelSolicitudConstruccion, 'superficiePreexistente', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->textInput(['type' => 'numer']) ?>



    <div class="row g3">
        <!-- falta titulo de propiedad xd, agregarlo a DB  -->

        <?= $form
            ->field($modelSolicitudConstruccion, 'RPP', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'tomo', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'folioElec', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'cuentaCatastral', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

    </div>

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_DirectorResponsableObra', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione Director'],
                ArrayHelper::map(
                    DirectorResponsableObra::findAll([
                        'isActivo' => 1,
                    ]),
                    'id',
                    function ($currentDirector) {
                        return $currentDirector['id'] .
                            ' - ' .
                            $currentDirector['abreviaicion'] .
                            '. ' .
                            $currentDirector['nombre'] .
                            ' ' .
                            $currentDirector['apellidoP'] .
                            ' ' .
                            $currentDirector['apellidoM'] .
                            ' ' .
                            $currentDirector['cedula'];
                    }
                )
            )
        )
        ->label('Director Responsable de Obra') ?>
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_CorrSeguridadEstruc', [
           'options' => ['class' => 'col-md-6'],
       ])
       ->dropDownList(
           $items = ArrayHelper::merge(
               ['0' => 'Seleccione Corr. Seguridad'],
               ArrayHelper::map(
                   CorrSeguridadEstruc::findAll([
                       'isActivo' => 1,
                   ]),
                   'id',
                   function ($currentDirector) {
                       return $currentDirector['id'] .
                           ' - ' .
                           $currentDirector['abreviaicion'] .
                           '. ' .
                           $currentDirector['nombre'] .
                           ' ' .
                           $currentDirector['apellidoP'] .
                           ' ' .
                           $currentDirector['apellidoM'] .
                           ' ' .
                           $currentDirector['cedula'];
                   }
               )
           )
       )
       ->label('Corr. Seguridad Estructural') ?>
 
    <h4>Entregables</h4>

    <table id="tableEntregables" class="table   table-hover">
        <thead>
            <tr>
                <?php if(Yii::$app->controller->action->id == "create"): ?>
                    <th scope="col">Accion Entregable</th>
                <?php endif  ?> 
                  
                <th scope="col">Entregable</th>
                <th scope="col">Nombre Archivo</th>
                <th scope="col">Acciones Archivo</th>
                <th scope="col"></th>
 
            </tr>
        </thead>
        <tbody>

            <?php foreach ($soliHasDocuments as $id => $soliHasDocument) { ?>
                <tr <?php echo "id = 'docRow$id' "  ?> >
                
                    <?php if(Yii::$app->controller->action->id == "create"): ?>
                        <td>
                            <button type="button" class="btn btn-outline-danger" onclick=" SomeDeleteRowFunction(event)  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" data-darkreader-inline-fill="" style="--darkreader-inline-fill:currentColor;">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg> 
                                Borrar
                            </button>
                        </td>
                    <?php endif;  ?> 

                    <td>
                        <?php 
                            /* ob_start();
                            var_dump("Cycle rendering:".$id);
                            var_dump($soliHasDocument);
                            Yii::debug(ob_get_clean(),"FORM RENDER uwu") */
                        ?> 
                        <?= $form
                            ->field($soliHasDocument, "[$id]id_Documento", [
                                'options' => ['class' => 'col-md-1', 'display' => 'none'],
                            ])
                            ->hiddenInput()/* textInput() */
                            ->label(false) 
                        ?>
                        <?php echo $form
                            ->field($soliHasDocument, "[$id]isEntregado")
                            ->checkbox()
                            ->label(/* $soliHasDocument -> documento ->nombre  */Documento::findOne( ["id"=>$soliHasDocument->id_Documento]) -> nombre );
                             ?>
                     <!--    <input type="button" value="Delete Row" onclick="SomeDeleteRowFunction()"> -->
                        
                    </td>
                    <td><!-- border-0 -->
                        <span >
                            <?= $form->field(
                                $soliHasDocument,
                                "[$id]nombreArchivo",
                                
                            ) ->textInput(
                                     ['class' => 'border-0 disabled',
                                      ' readonly' => ""
                                     ]
                                ) -> label(false) ?> 
                       </span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger">Borrar</button>
                    </td>
                    <td>
                        <input class="form-control form-control-sm  " id="formFileSm" type="file">

                    </td>
                </tr>
            <?php } ?>


        
        </tbody>
    </table>
 
  

 
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<script>

    function SomeDeleteRowFunction(event) {
        // event.target will be the input element.
        let button = event.target;
        if(button.type != "button") return;
        let td = button.parentNode; 
        let  tr = td.parentNode; // the row to be removed
        let tbody = tr.parentNode;
        tbody.removeChild(tr);
    }

   /*  $('#tableEntregables').on('click', 'input[type="button"]', function(e){
        $(this).closest('tr').remove()
    }) */
</script>

</div>
