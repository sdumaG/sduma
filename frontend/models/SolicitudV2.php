<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Domicilio;
/**
 * ContactForm is the model behind the contact form.
 */
class SolicitudV2 extends Model
{

    public $domicilioNotificaciones;
    public $domicilioPredio;
 


    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
 
}
