<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDonasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-donasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Judul Program') ?>
    
    <div class="row">
    
        <div class="col-md-6">
            <?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-md-6">
            
            <?= $form->field($model, 'due')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);?>
        </div>

    </div>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6])->label('Deskripsi Program') ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan Program', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
