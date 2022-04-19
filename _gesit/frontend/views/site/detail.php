<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\BannerDonasi;
use backend\models\ProgramDonasi;

$idprogram = $_GET['id'];
$banner = BannerDonasi::find()
    ->where(['program_id' => $idprogram ])
    //->groupBy('userid')
    ->orderBy(['id' => SORT_DESC])
    ->one();

$program = ProgramDonasi::find()
    ->where(['id' => $idprogram ])
    //->groupBy('userid')
    ->orderBy(['id' => SORT_DESC])
    ->one();
?>
<div class="container mb-4">

  <div class="row justify-content-md-center">
    <div class="col col-md-6 card-body shadow">
    <div class="row py-4">
        <div class="col-md-5">
            
                    <?php
                        if (empty($banner)) {?>
                            <img src="https://icons-for-free.com/iconfiles/png/512/gallery+image+landscape+mobile+museum+open+line+icon-1320183049020185924.png" width="160px" alt="">

                    <?php    } else{ ?>
                            <?= Html::img('@imageurl/admingesit/banner/'.$banner->banner,['width' => '160'],['class' => 'img-responsive'])?>
                    <?php    }  ?>
            
        </div>
        <div class="col-md-7">
                <h3>
                    <?= $program->title?>
                </h3><hr>
                <p>
                    <?= $program->deskripsi?> <br>
                    Tenggat waktu : <?= $program->due?>
                </p>
        </div>
    </div>

    <div class="card card-body">
        <?= $this->render('_formdonasi', [
            'model' => $model,
        ]) ?>
        
    </div>
    


    </div>
  </div>
</div>


