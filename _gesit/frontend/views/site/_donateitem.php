<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use backend\models\BannerDonasi;

$banner = BannerDonasi::find()
->where(['program_id' => $model->id ])
//->groupBy('userid')
->orderBy(['id' => SORT_DESC])
->one();


    $user = Yii::$app->user->identity->id;
  
?>


<div class="card shadow mb-3 zoom">
<a href="https://pa.ihf.or.id/pelatihan-online/detail?id=<?= $model->id?>" class="item-course" style="color:#343a40;text-decoration:none">

    <center>
        <?php
            if (empty($banner)) {?>
                <img src="https://icons-for-free.com/iconfiles/png/512/gallery+image+landscape+mobile+museum+open+line+icon-1320183049020185924.png" width="200px" alt="">

        <?php    } else{ ?>
                <?= Html::img('@imageurl/admingesit/banner/'.$banner->banner,['width' => '300'],['class' => 'img-responsive'])?>
        <?php    }  ?>
    </center>

    <div class="card-body">
        <p style="font-weight:bold"><?= $model->title?></p>
        <p><b>Rp 5.623.000</b> dari Rp 10.500.000</p>
       
        <div class="progress" style="height: 8px;">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div><hr>

        <div class="row">
            <div class="col-md-5">
                <b>20</b> Donasi
            </div>
            <div class="col-md-7">
                <button type="button" class="btn btn-primary btn-block">Donasi Sekarang</button>
            </div>
        </div>
        
        <!-- <?php
            
            if (!empty($enroll)) { 
                echo Html::a('Lihat Pelatihan', ['detail','id'=>$model->id] ,
                ['class' => 'btn btn-primary btn-block mt-1','style'=>'text-decoration:none;']);
            } else {
                echo Html::a('Lihat Pelatihan', ['detail','id'=>$model->id] ,
                ['class' => 'btn btn-primary btn-block mt-1','style'=>'text-decoration:none;']);
            }
        ?> -->
    </div>
    </a>
</div>
                