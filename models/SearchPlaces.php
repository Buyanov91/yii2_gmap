<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Places;

class SearchPlaces extends Places
{

    public function rules()
    {
        return [

            [['address'], 'safe'],

        ];
    }

    public function scenarios()
    {

        return Model::scenarios();

    }

    public function search($params)
    {
        $query = Places::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['address' => SORT_ASC]],
        ]);

        $this->load($params);

        if ($this->validate()) {
            return $dataProvider;
        }

    }
}