<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DirectorResponsableObra $model */

$this->title = 'Crear Director Responsable Obra';
$this->params['breadcrumbs'][] = ['label' => 'Director Responsable Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-responsable-obra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
