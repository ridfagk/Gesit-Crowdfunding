<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true])->label('Kategori Program') ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan kategori', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
