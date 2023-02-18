<?php

use common\models\Documento;
use common\models\TipoTramite;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumentoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<p>
 
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Filtros 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
        </svg>
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">


  <div class="tipo-tramite-has-documento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= 
    $form->field($model, 'id_TipoTramite')
    ->dropDownList(
        $items = 
        ArrayHelper::merge(["0"=>"Seleccione"],        
            ArrayHelper::map(
                TipoTramite::findAll(["isActivo"=>1])
            , 'id','nombre'
            )
        ),
        ['value'=>$model?$model->id_TipoTramite:0]
    )  
    ->label("Tipo de trámite") 
    ?>


 
    <?= $form->field($model, 'id_Documento')
    ->dropDownList(
        $items= 
        ArrayHelper::merge(["0"=>"Seleccione"],     
            ArrayHelper::map(
                Documento::findAll(["isActivo"=> 1]),
                'id',
                'nombre'
            )
            ),
            ['value'=>$model?$model->id_Documento:0]
    )
    ->label("Documento") ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>


    </div>
</div>

