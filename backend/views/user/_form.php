<?php

use common\models\Horario;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\User;
use common\models\UserLevel;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <?= $form->field($model, 'username',['options'=>["class"=>"col-6"]])->textInput(['maxlength' => true]) ?>
    
        
        <?=$form->field($model,"id_UserLevel",['options'=>["class"=>"col-4"]])->dropDownList(
                    $items = 
                    ArrayHelper::map(
                        UserLevel::find( )->all(),
                        'id',/* closure too */
                        "Nombre"
                        )
                        
            )->label("Nivel de usuario")         ?>

    </div>    

    <div class="row">


    <?=$form->field($model,"status",['options'=>["class"=>"col-3"]])->dropDownList(
        $items = [
                User::STATUS_INACTIVE =>"Eliminado", 
                User::STATUS_INACTIVE =>"Inactivo", 
                User::STATUS_ACTIVE =>"Activo", 
                 ]
                
        )->label("Estado del usuario")        
        ?>
   
    <?=$form->field($model,"id_Horario" ,['options'=>["class"=>"col-7"]])->dropDownList(
                $items = 
                ArrayHelper::map(
                    Horario::find( )->all(),
                    'id',/* closure too */
                    function ($currHorario){
                        return $currHorario->nombre." - ".date("h:i a",  strtotime( $currHorario->inicioActividad)   )." - ".date("h:i a",  strtotime( $currHorario->finActividad)   );
                    }
                   
                )
            
        )
        ->label("Horario")
        ?>
    </div>



    <?= $form->field($model, 'email',['options'=>["class"=>"col-4" ]])->input(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_Datos_Persona')->hiddenInput()/* textInput() */->label(false) ?>

    <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'password_hash')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'password_reset_token')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'verification_token')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
