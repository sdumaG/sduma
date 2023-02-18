<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenerica $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="solicitud-generica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statusSolicitud')->textInput() ?>

    <?= $form->field($model, 'isSolicitaPersonaFisica')->textInput() ?>

    <?= $form->field($model, 'superficieTotal')->textInput() ?>

    <?= $form->field($model, 'niveles')->textInput() ?>

    <?= $form->field($model, 'superficiePorConstruir')->textInput() ?>

    <?= $form->field($model, 'areaPreExistente')->textInput() ?>

    <?= $form->field($model, 'tipoTomaAgua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeroTomaAgua')->textInput() ?>

    <?= $form->field($model, 'fechaPagoAguaOContrato')->textInput() ?>

    <?= $form->field($model, 'numeroReciboAgua')->textInput() ?>

    <?= $form->field($model, 'subeRecibo')->textInput() ?>

    <?= $form->field($model, 'numeroPredial')->textInput() ?>

    <?= $form->field($model, 'fechaPagoPredial')->textInput() ?>

    <?= $form->field($model, 'altura')->textInput() ?>

    <?= $form->field($model, 'metrosLineales')->textInput() ?>

    <?= $form->field($model, 'id_MetrosLinealesDRO')->textInput() ?>

    <?= $form->field($model, 'id_AlturaDRO')->textInput() ?>

    <?= $form->field($model, 'id_PersonaFisica')->textInput() ?>

    <?= $form->field($model, 'id_PersonaMoral')->textInput() ?>

    <?= $form->field($model, 'id_Contacto')->textInput() ?>

    <?= $form->field($model, 'id_DomicilioNotificaciones')->textInput() ?>

    <?= $form->field($model, 'id_MotivoConstruccion')->textInput() ?>

    <?= $form->field($model, 'id_SolicitudGenericaCuentaCon')->textInput() ?>

    <?= $form->field($model, 'id_Escritura')->textInput() ?>

    <?= $form->field($model, 'id_ConstanciaEscritura')->textInput() ?>

    <?= $form->field($model, 'id_ConstanciaPosecionEjidal')->textInput() ?>

    <?= $form->field($model, 'id_TipoPredio')->textInput() ?>

    <?= $form->field($model, 'id_GeneroConstruccion')->textInput() ?>

    <?= $form->field($model, 'id_SubGeneroConstruccion')->textInput() ?>

    <?= $form->field($model, 'id_DomicilioPredio')->textInput() ?>

    <?= $form->field($model, 'id_DirectorResponsableObra')->textInput() ?>

    <?= $form->field($model, 'id_Archivo_MemoriaCalculo')->textInput() ?>

    <?= $form->field($model, 'id_Archivo_MecanicaSuelos')->textInput() ?>

    <?= $form->field($model, 'id_Archivo_LicenciaConstruccionAreaPreexistenteFile')->textInput() ?>

    <?= $form->field($model, 'id_User_CreadoPor')->textInput() ?>

    <?= $form->field($model, 'id_User_ModificadoPor')->textInput() ?>

    <?= $form->field($model, 'fechaCreacion')->textInput() ?>

    <?= $form->field($model, 'fechaModificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
