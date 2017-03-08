<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "tbvisitdrug".
 *
 * @property integer $id
 * @property string $hospcode
 * @property string $cid
 * @property string $hn
 * @property string $seq
 * @property string $date_serv
 * @property string $didstd
 */
class Tbvisitdrug extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    
    public static function tableName()
    {
        return 'tbvisitdrug';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_serv'], 'safe'],
            [['hospcode'], 'string', 'max' => 5],
            [['cid'], 'string', 'max' => 13],
            [['hn'], 'string', 'max' => 15],
            [['seq', 'didstd'], 'string', 'max' => 16],
            [['hospcode', 'hn', 'seq'], 'unique', 'targetAttribute' => ['hospcode', 'hn', 'seq'], 'message' => 'The combination of Hospcode, Hn and Seq has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'Hospcode',
            'cid' => 'Cid',
            'hn' => 'Hn',
            'seq' => 'Seq',
            'date_serv' => 'Date Serv',
            'didstd' => 'Didstd',
        ];
    }
}
