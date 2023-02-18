<?php
namespace common\models;

use yii\db\ActiveRecord;

class ProbarActive extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{probaractive}}';
    }

/* 
id
nombre
apellido 
edad

*/
    public static function insertarAlv(){
        $modelo = new ProbarActive();

        $modelo-> nombre = "Harry";
        $modelo->apellido = "tugfa";
        $modelo->edad = 2;

        $modelo->save();
    }

}