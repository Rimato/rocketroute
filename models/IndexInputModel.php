<?php

namespace app\models;

use yii\base\Model;

class IndexInputModel extends Model {

    public $ICAO;

    public function rules()
    {
        return [
            [['ICAO'], 'required'],
            [['ICAO'], 'string', 'length' => 4],
        ];
    }
}