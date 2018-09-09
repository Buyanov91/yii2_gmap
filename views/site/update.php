<?php

use yii\helpers\Html;

$this->title = 'Изменяемый город: ' . $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->address, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';

?>

<div class="places-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="floating-panel">
      <input id="address" type="textbox" placeholder="Введите название города" value="<?=$model['address']?>">
      <input id="submit" class="btn btn-info" type="button" value="Найти">
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div id="map"></div>

</div>

<?php $this->registerJsFile('@web/js/script.js') ?>
