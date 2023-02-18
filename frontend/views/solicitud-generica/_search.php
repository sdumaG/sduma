<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenericaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="solicitud-generica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'statusSolicitud') ?>

    <?= $form->field($model, 'isSolicitaPersonaFisica') ?>

    <?= $form->field($model, 'superficieTotal') ?>

    <?= $form->field($model, 'niveles') ?>

    <?php // echo $form->field($model, 'superficiePorConstruir') ?>

    <?php // echo $form->field($model, 'areaPreExistente') ?>

    <?php // echo $form->field($model, 'tipoTomaAgua') ?>

    <?php // echo $form->field($model, 'numeroTomaAgua') ?>

    <?php // echo $form->field($model, 'fechaPagoAguaOContrato') ?>

    <?php // echo $form->field($model, 'numeroReciboAgua') ?>

    <?php // echo $form->field($model, 'subeRecibo') ?>

    <?php // echo $form->field($model, 'numeroPredial') ?>

    <?php // echo $form->field($model, 'fechaPagoPredial') ?>

    <?php // echo $form->field($model, 'altura') ?>

    <?php // echo $form->field($model, 'metrosLineales') ?>

    <?php // echo $form->field($model, 'id_MetrosLinealesDRO') ?>

    <?php // echo $form->field($model, 'id_AlturaDRO') ?>

    <?php // echo $form->field($model, 'id_PersonaFisica') ?>

    <?php // echo $form->field($model, 'id_PersonaMoral') ?>

    <?php // echo $form->field($model, 'id_Contacto') ?>

    <?php // echo $form->field($model, 'id_DomicilioNotificaciones') ?>

    <?php // echo $form->field($model, 'id_MotivoConstruccion') ?>

    <?php // echo $form->field($model, 'id_SolicitudGenericaCuentaCon') ?>

    <?php // echo $form->field($model, 'id_Escritura') ?>

    <?php // echo $form->field($model, 'id_ConstanciaEscritura') ?>

    <?php // echo $form->field($model, 'id_ConstanciaPosecionEjidal') ?>

    <?php // echo $form->field($model, 'id_TipoPredio') ?>

    <?php // echo $form->field($model, 'id_GeneroConstruccion') ?>

    <?php // echo $form->field($model, 'id_SubGeneroConstruccion') ?>

    <?php // echo $form->field($model, 'id_DomicilioPredio') ?>

    <?php // echo $form->field($model, 'id_DirectorResponsableObra') ?>

    <?php // echo $form->field($model, 'id_Archivo_MemoriaCalculo') ?>

    <?php // echo $form->field($model, 'id_Archivo_MecanicaSuelos') ?>

    <?php // echo $form->field($model, 'id_Archivo_LicenciaConstruccionAreaPreexistenteFile') ?>

    <?php // echo $form->field($model, 'id_User_CreadoPor') ?>

    <?php // echo $form->field($model, 'id_User_ModificadoPor') ?>

    <?php // echo $form->field($model, 'fechaCreacion') ?>

    <?php // echo $form->field($model, 'fechaModificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
