<?php

namespace app\models;

use Yii;

class Places extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'places';
    }

    public function rules()
    {
        return [
            [['address', 'lat', 'lng'], 'required'],
            [['lat', 'lng'], 'number'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    { 
        return [
            'id' => 'ID',
            'address' => 'Адрес',
            'lat' => 'Широта',
            'lng' => 'Долгота',
        ];
    }
    //ФУНКЦИЯ РАСЧЕТА ДЛИНЫ МЕЖДУ ГОРОДАМИ
    public function calcDistance ($lat1, $long1, $lat2, $long2)
    {
        // перевести координаты в радианы
        $lat1 = $lat1 * M_PI / 180;
        $lat2 = $lat2 * M_PI / 180;
        $long1 = $long1 * M_PI / 180;
        $long2 = $long2 * M_PI / 180;
     
        // косинусы и синусы широт и разницы долгот
        $cl1 = cos($lat1);
        $cl2 = cos($lat2);
        $sl1 = sin($lat1);
        $sl2 = sin($lat2);
        $delta = $long2 - $long1;
        $cdelta = cos($delta);
        $sdelta = sin($delta);
     
        // вычисления длины большого круга
        $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
     
        $ad = atan2($y, $x);
        $dist = $ad * 6372.795;
        
        //Округляем значение
        $dist = round($dist, 3);

        return $dist;
    }
}
