<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $attachment;

    public function rules()
    {
        return [
            [['attachment'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
           $this->attachment->saveAs('uploads/' .$newfilename);           
            return true;
        } else {
            return false;
        }
    }
}

?>