<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DonasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="donasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_program') ?>

    <?= $form->field($model, 'id_donatur') ?>

    <?= $form->field($model, 'id_invoice') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'pesan') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
