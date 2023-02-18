<?php

namespace frontend\models;

use Yii;
use yii\base\Model; 
use Exception;

class NuevoExpedienteForm extends Model
{
    
    public $nombre;
    public $apellidoP;
    public $apellidoM;

    public $tipoTramiteId;


    public function attributeLabels()
    {    
        return array(

            'nombre' => 'Nombre',
            'apellidoP' => 'Apellido Paterno',
            'apellidoM' => 'Apellido Materno',
            'tipoTramiteId' => 'Tipo trámite' 

        );
    
    }
    public function rules()
    {
        return [
         
            [['nombre','apellidoP'], 'required'], 
            [['nombre','apellidoP'], 'string', 'max' => 255 /* (new Persona)->getValidators()[1]->max */],
          
            ['apellidoM', 'string', 'max' => 255 ],

            ['tipoTramiteId', 'required' ],
            ['tipoTramiteId', 'integer' ],

        
        ];
    }

   /*  @idSolicitudGenerica INT,
    @newStatus INT,
    @tipoTramite INT,
    @idUserCreated INT  */
    public function createExpediente(){

        $sql ="EXEC sp_create_expediente :idSolicitudGenerica,:newStatus,:tipoTramite,:idUserCreated; ";
        $params =[
                ':idSolicitudGenerica'=>$this->nombre,
                ':newStatus'=>$this->apellidoP,
                ':apellidoM'=>$this->apellidoM,
                ':tipoTramite'=>$this->tipoTramiteId,
                ':idUserCreated'=>Yii::$app->user->identity->id ,
        ];
        $res = -1;
       /*  try{
            $rows =  Yii::$app->db->createCommand($sql, $params) ->queryAll( );

           // $res = $rows[0]["ROWS_INSERTED"] ;
           
        }
        catch(Exception $ex){
        } */
        Yii::info("ERROR", $category = 'Error al crear expediente.');
        return ["success" => false, "MSG" =>"Error al crear expediente"];
        /* Yii::info($res, $category = 'Expediente creado');
        return ["success" => true,"MSG" => "Expediente creado."];  */
        
 
        

    }

}