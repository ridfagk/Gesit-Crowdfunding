<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use sjaakp\loadmore\LoadMorePager;
use backend\models\ProgramDonasi;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<style>
.summary{
    display:none
}
.checked {
  color: #ffa31a;
}
.unchecked{
    color:#b3b3b3;
}
</style>
<div class="site-index">

    <?php Pjax::begin(['id' => 'pjax-listview']); ?>

        <?php
            $query =  ProgramDonasi::find()->orderBy(['id'=> SORT_DESC]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => array('pageSize' => 20),
            ]);

            echo \yii\widgets\LinkPager::widget([
                'pagination'=>$dataProvider->pagination,
            ]);

            $query->andFilterWhere([
            'level_id' => $_GET['level_id'],
            'program_id' => $_GET['program_id'],

            ]);
        ?>

        <?= ListView::widget([
            'options' => ['class' => 'list-view row'],
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'col-md-4 mb-3 item'],
            'itemView' => '_donateitem',
            'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
            'triggerText' => Yii::t('app', '<button class="btn btn-info">Lihat Lainnya <i class="fas fa-chevron-circle-down"></i></button>'),
            'triggerTemplate' => '<div class="col-md-12 ias-trigger mt-3" style="text-align: center; cursor: pointer;"><a>{text}</a></div>',
            'noneLeftText' => Yii::t('app', 'Semua data donasi sudah ditampilkan<br>
                                    <button onclick="topFunction()" id="myBtn" class="btn btn-primary mt-2" title="Go to top">
                                    Kembali ke awal <i class="fas fa-chevron-circle-up"></i></button>'),
            'noneLeftTemplate' => '<div class="col-md-12 ias-trigger mt-3" style="text-align: center; cursor: pointer;color:orange;font-size:20px;"><a>{text}</a></div>',
            'spinnerSrc' => Yii::t('app', ''),
            'spinnerTemplate' => '<div class="col-md-12 ias-spinner mt-3" style="text-align: center;">'.Html::img('@web/img/preloader.gif',['width'=>'150px',]).'<h5 style="margin-top:-0.9em">Loading</h5></div>',
            ],
        ]) ?>

    <?php Pjax::end(); ?>
    <!-- <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div> -->
</div>
