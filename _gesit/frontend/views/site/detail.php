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
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-body shadow-sm">
                <center>
                    <?php
                        if (empty($banner)) {?>
                            <img src="https://icons-for-free.com/iconfiles/png/512/gallery+image+landscape+mobile+museum+open+line+icon-1320183049020185924.png" width="200px" alt="">

                    <?php    } else{ ?>
                            <?= Html::img('@imageurl/admingesit/banner/'.$banner->banner,['width' => '200'],['class' => 'img-responsive'])?>
                    <?php    }  ?>
                </center>
            </div>
        </div>
        <div class="col-md-8">
                <h3>
                    <?= $program->title?>
                </h3><hr>
                <p>
                    <?= $program->deskripsi?> <br>
                    Tenggat waktu : <?= $program->due?>
                </p>
        </div>
    </div>
</div>