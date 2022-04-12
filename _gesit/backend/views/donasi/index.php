<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DonasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Donasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="donasi-index">

    <div class="card card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'id_program',
                'id_donatur',
                'id_invoice',
                'nama:ntext',
                //'email:ntext',
                //'pesan:ntext',
                //'jumlah',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Donasi $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>
