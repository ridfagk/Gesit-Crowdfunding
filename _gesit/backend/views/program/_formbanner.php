<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\widgets\Pjax;
use kartik\number\NumberControl;



/* @var $this yii\web\View */
/* @var $model backend\models\Sbb */
/* @var $form yii\widgets\ActiveForm */
$pelatihanid = $_GET['pelatihanid'];
//$model->pelatihan_id = $pelatihanid;
?>

<div class="fotosm-form">

    <?php $form = ActiveForm::begin(['id' => 'fotosm-form','options' => ['data-pjax' => true]]); ?>

    <!-- Data SM -->
    <legend class="text-bold">Unggah Foto Banner</legend>
    
    

         <?php  if (!$model->isNewRecord): ?>
                <?php
                $img = [];
                $json = [];
                if (!empty($model->banner)){
                       
                        $img[] = Html::img($url.'@imageurl/admingesit/banner/'.$model->banner,['width'=>'200']);
        
                        $json[] = [
                            'caption'=>$model->banner, Url::to(['@webroot/pelatihan/delete-upload']),
                            'key' => 'banner'.  $model->id, 
                        ];
                    }
                ?>
                
                 <?=  $form->field($model, 'banner')->widget(FileInput::className(),[ 
                    'options' => ['accept' => ''],
                    'pluginOptions' => [
                        'showRemove'=> false,
                        'showUpload' => false,
                        'showCancel' => false, 
                        'overwriteInitial' => false,
                        'initialPreviewConfig' => $json,
                        'previewFileType' => 'image',
                        'initialPreview' => $img,
                        'uploadAsync'=> true,
                        'maxFileSize' => 3*1024*1024,
                        'deleteUrl' => Url::to(['/pelatihan/delete-upload']),
                        'allowedExtensions' => ['jpg','png','jpeg'],
                        'browseLabel' =>  'Unggah',
                    ]
                ])->label('Banner Program')?>
                <?php else : ?>
                    
                     <?= 
                     $form->field($model, 'banner')->widget(FileInput::classname(), [ 
                                'pluginOptions'=>[
                                    'showPreview' => true,
                                    'showCaption' => true,
                                    'showRemove' => false,
                                    'removeLabel'=>'', 'removeClass' => 'btn btn-danger',
                                    'showUpload' => false,
                                    'browseLabel' =>  'Unggah', 'browsClass' => 'btn btn-customb'
                                        ]
                                    ])->label('Banner Program');?>
                
             <?php endif; ?> 
    
    <div class="form-group text-right">
        <?= Html::submitButton('Simpan Data', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js=<<<js
$(document).ready(function() {
    $("#sel1").change(function() {
      var jenis = $(this).val();
      if (jenis == "1") {
        $(".box").not(".tk").hide();
        $(".tk").show();
      } else if (jenis == "2") {
        $(".box").not(".sd").hide();
        $(".sd").show();
      } else {
        $(".box").hide();
      }
    });
  
  
  });
js;
$this->registerJs($js);
?>
