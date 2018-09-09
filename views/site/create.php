<?php

use yii\helpers\Html;

$this->title = 'Добавить Город';
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="floating-panel">
      <input id="address" type="textbox" placeholder="Введите название города">
      <input id="submit" class="btn btn-info" type="button" value="Найти">
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div id="map"></div>

</div>
<?php $this->registerJsFile('@web/js/script.js') ?>