<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Domicilio".
 *
 * @property int $id
 * @property string $coloniaFraccBarrio
 * @property string $calle
 * @property string|null $numExt
 * @property string|null $numInt
 * @property string $cp
 * @property string|null $entreCallesH
 * @property string|null $entreCallesV
 *
 * @property SolicitudConstruccion[] $solicitudConstruccions
 * @property SolicitudConstruccion[] $solicitudConstruccions0
 */
class Domicilio extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'scenariocreate';
    const SCENARIO_UPDATE = 'scenarioupdate';
  
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Domicilio';
    }


/*       // scenarios encapsulated
    public function getCustomScenarios()
    {
      
      return [
          self::SCENARIO_CREATE =>  ['user_id', 'name', 'desc', 'published','date_create'],
          self::SCENARIO_UPDATE =>  ['user_id', 'name', 'desc', 'date_update'],
      ];
    }

    public function scenarios()
    {
        
        $scenarios = $this->getCustomScenarios();
        return $scenarios;
    } */
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coloniaFraccBarrio', 'calle', 'cp'], 'required'],
            [['coloniaFraccBarrio', 'calle', 'numExt', 'numInt', 'cp'], 'string', 'max' => 45],
            [['entreCallesH', 'entreCallesV'], 'string', 'max' => 90],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coloniaFraccBarrio' => 'Colonia Fracc Barrio',
            'calle' => 'Calle',
            'numExt' => 'Num Ext',
            'numInt' => 'Num Int',
            'cp' => 'Cp',
            'entreCallesH' => 'Entre Calles H',
            'entreCallesV' => 'Entre Calles V',
        ];
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_Persona_DomicilioNotificaciones' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions0()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_DomicilioPredio' => 'id']);
    }
}
