<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProgramDonasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Donasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-donasi-index">
    
    <div class="card">

        <div class="card-header">
            <?= Html::a('Buat Program Donasi', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'title:ntext',
                    [
                        'attribute' => 'banner',
                        'format' => 'html',    
                        'value' => function ($data) {
                            return Html::img(Yii::getAlias('@imageurl').'/admingesit/banner/'. $data['banner'],
                                ['width' => '100px']);
                        },
                    ],
                    'deskripsi:ntext',
                    'kategori',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'contentOptions' => ['class' => 'tdwrap'],
                        'headerOptions' => ['width' => '13%', 'class' => 'activity-view-link',],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view'=>function ($url, $model) {
                                $t = 'view?id='.$model->id;
                                return  Html::a('<i class="fas fa-eye">&nbsp;</i>', Url::to($t), ['class' => 'btn btn-info btn-xs']);
                            },
            
                            'update'=>function ($url, $model) {
                                $t = 'update?id='.$model->id;
                                return Html::a('<i class="fas fa-pen text-white">&nbsp;</i>', Url::to($t), ['class' => 'btn btn-warning btn-xs']);
                            },
                        'delete' => function ($url, $model) {
                            $t ='delete?id='.$model->id;
                            return  Html::a('<i class="fas fa-trash">&nbsp;</i>', $t, ['class' => 'btn btn-danger btn-xs',
                            'data' => [
                                'confirm' => 'Apakah anda benar-benar yakin? Anda akan kehilangan semua informasi tentang data  jika anda menghapusnya.',
                                'method' => 'post',
                            ],]);
                        }
            
                        ],

                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    
    </div>

</div>
