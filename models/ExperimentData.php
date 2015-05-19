<?php
namespace app\models;

use models\User;
use yii\base\Model;
use Yii;

class ExperimentData extends Model
{
    public $name;
    public $dices;
    public $throws;
    public $edge_num;

    public function rules()
    {
        return [
          [['name', 'dices', 'throws', 'edge_num'], 'required', 'message' => 'Поле не может быть пустым'],
          [['dices', 'edge_num', 'throws'], 'integer', 'message' => 'Допускается только целое число'],
          ['dices', 'in', 'range'=>range(1,10), 'message' => 'От 1 до 10 костей'],
          ['edge_num', 'in', 'range'=>range(2,20), 'message' => 'От 2 до 20 граней'],
          ['throws', 'compare', 'operator'=>'<=','compareValue'=>1000000, 'message'=>'Не более 1000000 бросков'],
          ['throws', 'compare', 'operator'=>'>=','compareValue'=>1, 'message'=>'Не менее 1 броска'],
          [['name'], 'string', 'max' => 50, 'message' => 'Максимум 50 символов']
        ];
    }
    
    public function attributeLabels() {
      return [
          'name'=>'Ваше имя',
          'dices'=>'Количество костей',
          'throws'=>'Количество бросков',
          'edge_num'=>'Количество граней каждой кости',
        ];
    }

}
