<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;
use backend\models\BannerDonasi;

$banner = BannerDonasi::find()
->where(['program_id' => $model->id ])
//->groupBy('userid')
->orderBy(['id' => SORT_DESC])
->one();

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDonasi */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Program Donasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="program-donasi-view">
    <div class="card card-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <a class="btn btn-success btn-sm modalFotosm text-white" value="<?= Url::to(['addbanner', 'id' => $model->id, 'pelatihanid'=>$model->banner]) ?>"><i class="far fa-file-image">&nbsp;</i> Banner</a>
            
        </p>

        <!-- <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'title:ntext',
                'banner:ntext',
                'deskripsi:ntext',
                'kategori',
            ],
        ]) ?> -->

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <center>
                        <div class="mt-2">
                            <?php
                                if (empty($banner)) {?>
                                    <img src="https://icons-for-free.com/iconfiles/png/512/gallery+image+landscape+mobile+museum+open+line+icon-1320183049020185924.png" width="200px" alt="">

                            <?php    } else{ ?>
                                    <?= Html::img('@web/banner/'.$banner->banner,['width' => '300'],['class' => 'img-responsive'])?>
                            <?php    }  ?>
                        </div>
                        <?php
                            if (empty($banner)) {
                        ?>
                                <a class="btn m-2 btn-success btn-sm modalFotosm text-white" value="<?= Url::to(['addfoto', 'id' => $model->id, 'pelatihanid'=>$model->id]) ?>"><i class="fas fa-pen">&nbsp;</i> Foto Pelatihan</a>
                        <?php    
                            } else{
                        ?>
                            <a class="btn m-2 btn-success btn-sm modalFotosm text-white" value="<?= Url::to(['updatefoto', 'id' => $model->id, 'pelatihanid'=>$model->id]) ?>"><i class="fas fa-pen">&nbsp;</i>Ubah Foto Pelatihan</a>
                        <?php
                            }
                        ?>
    
                    </center>
                </div>
            </div>
            <div class="col-md-8">
                <p> <b><?= $model->title?></b><br>
                    <?= $model->deskripsi?><br>
                    Tenggat Waktu: <?= $model->due?>
                </p>
                <p>Dana Terkumpul: <br>
                    Donatur:
                </p>
            </div>

        </div>
    </div>

    

</div>

<?php
$js=<<<js
    $('.modalButton').on('click', function () {
        $('#modal').modal('show')
                .find('#modalPublish')
                .load($(this).attr('value'));
    });

    $('.modalButtonprice').on('click', function () {
      $('#modalprice').modal('show')
              .find('#modalPrice')
              .load($(this).attr('value'));
  });
  $('.modalFotosm').on('click', function () {
    $('#modalfoto').modal('show')
            .find('#modalFoto')
            .load($(this).attr('value'));
  });

js;
$this->registerJs($js);

Modal::begin([  
    'id' => 'modal',
    'size' => 'modal-md',
]);
echo "<div id='modalPublish'></div>";
Modal::end();

Modal::begin([  
  'id' => 'modalprice',
  'size' => 'modal-md',
]);
echo "<div id='modalPrice'></div>";
Modal::end();

Modal::begin([  
  'id' => 'modalfoto',
  'size' => 'modal-md',
]);
echo "<div id='modalFoto'></div>";
Modal::end();
?>
