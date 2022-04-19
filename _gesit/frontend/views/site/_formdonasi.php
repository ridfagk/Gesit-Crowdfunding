<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDonasi */
/* @var $form yii\widgets\ActiveForm */
$idx = $_GET['id'];
$model->id_program = $idx
?>

<div class="program-donasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jumlah')->widget(NumberControl::classname(), [
                'displayOptions' => ['placeholder' => 'Ketik jumlah donasi',
                ],
                'maskedInputOptions' => [
                    'prefix' => 'Rp ',
                    'digits' => 0,
                    'allowMinus' => false,
                    'rightAlign' => false
                ],
                
                //'saveInputContainer' => $saveCont
            ])->label('Nominal Donasi');?>
    
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Donatur') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email') ?>

    <?= $form->field($model, 'pesan')->textarea(['rows' => 6])->label('Pesan') ?>
    
    <div class="row">
    
        <div class="col-md-6">
            <?= $form->field($model, 'id_donatur')->hiddenInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'id_program')->hiddenInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'id_invoice')->hiddenInput(['maxlength' => true])->label(false) ?>
        </div>
        
        <div class="col-md-6">
            
        </div>

    </div>
    

    <div class="form-group">
        <?= Html::submitButton('Lanjut Pembayaran', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
