<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $id_exp
 * @property integer $score
 * @property integer $count
 *
 * @property Experiment $idExp
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }


    public function rules()
    {
        return [
            [['id_exp', 'score'], 'required'],
            [['id_exp', 'score', 'count'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_exp' => 'Id Exp',
            'score' => 'Score',
            'count' => 'Count',
        ];
    }

    public function getIdExp()
    {
        return $this->hasOne(Experiment::className(), ['id_exp' => 'id_exp']);
    }
}
