<?php

use common\models\Documento;
use common\models\MotivoConstruccion;
use common\models\SolicitudGenericaCuentaCon;
use common\models\TipoTramite;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="config-tramite-motivo-cuentacon-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'id_TipoTramite')
            ->dropDownList(
                $items = ArrayHelper::map(
                    TipoTramite::findAll(["isActivo"=>1])
                , 'id','nombre'
                )

            )  
            ->label("Tipo Trámite") 
    ?>

    <?= $form->field($model, 'id_MotivoConstruccion')
    ->dropDownList(
        $items= ArrayHelper::map(
            MotivoConstruccion::findAll(["isActivo"=> 1]),
            'id',
            'nombre'
        )
    )
    ->label("Motivo de construcción") ?>

    <?= $form->field($model, 'id_SolicitudGenericaCuentaCon')
    ->dropDownList(
        $items= ArrayHelper::map(
            SolicitudGenericaCuentaCon::findAll(["isActivo"=> 1]),
            'id',
            'nombre'
        )
    )
    ->label("Soclicitud Generica cuenta con: ") ?>

    


    <?= $form->field($model, 'id_Documento')
    ->dropDownList(
        $items= ArrayHelper::map(
            Documento::findAll(["isActivo"=> 1]),
            'id',
            'nombre'
        )
    )
    ->label("Documento") ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
