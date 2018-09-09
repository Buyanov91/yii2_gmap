<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="places-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'lat')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'lng')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
