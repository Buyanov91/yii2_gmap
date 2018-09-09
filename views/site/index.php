<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use models\Places;

$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить город', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                
                ['class' => 'yii\grid\SerialColumn'],
                
                [
                    'attribute' => 'address',
                    'filterInputOptions' => [
                        'placeholder' => 'Введите ваше местоположение и нажмите Inter',
                        'class' => 'form-control',
                        'address' => null,
                    ]
                ],
                'lat',
                'lng',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);?>
    
</div>
