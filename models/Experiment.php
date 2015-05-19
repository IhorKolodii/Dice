<?php

namespace app\models;

use Yii;

class Experiment extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'experiment';
    }

    public function rules()
    {
        return [
            [['date', 'time'], 'safe'],
            [['dice_num', 'edge_num', 'throws'], 'required'],
            [['dice_num', 'edge_num', 'throws'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_exp' => 'Id Exp',
            'date' => 'Date',
            'time' => 'Time',
            'name' => 'Name',
            'dice_num' => 'Dice Num',
            'edge_num' => 'Edge Num',
            'throws' => 'Throws',
        ];
    }

    public function getResults()
    {
        return $this->hasMany(Result::className(), ['id_exp' => 'id_exp']);
    }
}
