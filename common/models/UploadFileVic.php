<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFileVic extends Model
{
    /**
     * @var UploadedFile
     */
    public $myFile;

    public function rules()
    {
        return [
            [['myFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg, pdf','maxSize' => 1024 * 1024 * 4],
        ];
    }
    public const SCENARIO_MANDATORY_FILE = 'MANDATORY SCENARIO';
    public const SCENARIO_NO_MANDATORY_FILE = 'NO MANDATORY SCENARIO';    
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        //$scenarios[self::SCENARIO_MANDATORY_FILE] = ['myFile']; //default scenario defined in rules function
        $scenarios[self::SCENARIO_NO_MANDATORY_FILE] = [/* empty */];

        return $scenarios;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->myFile->saveAs('uploads/' . $this->myFile->baseName . '.' . $this->myFile->extension);
            return true;
        } else {
            return false;
        }
    }
}


?>