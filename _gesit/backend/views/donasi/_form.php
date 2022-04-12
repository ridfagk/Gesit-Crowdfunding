<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Donasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="donasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_program')->textInput() ?>

    <?= $form->field($model, 'id_donatur')->textInput() ?>

    <?= $form->field($model, 'id_invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pesan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
