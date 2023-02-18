<?php

use common\models\DirectorResponsableObra;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\DirectorResponsableObraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Director Responsable Obra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-responsable-obra-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Director Responsable Obra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'abreviacion',
            'cedula',
            /*  'isActivo', */
            [
            'label' => "Activo",                
            'value' => function($currExpediente){
                    return $currExpediente->isActivo?"Sí":"No";
                }
            ],
            //'id_Persona',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DirectorResponsableObra $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
