<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'Местоположение';
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-search">

    <h1><?= Html::encode($this->title) ?></h1>
 
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
       
	        [
	            'attribute'=>'address',
	            'label'=>'Адрес',
	        ],
            
            [
	            'attribute'=>'distance',
	            'label'=>'Расстояние, км',
	        ],

        ],
    ]);?>

</div>
