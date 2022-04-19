<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
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

                //'id',
                'id_program',
                //'id_donatur',
                'id_invoice',
                'nama:ntext',
                'jumlah',
                [
                    'label'=>'status',
                    'attribute'=>'transaction_status',
                    'value'=>'transaction_status'
                ],
                
                'email:email',
                //'pesan:ntext',
                //'jumlah',
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, Donasi $model, $key, $index, $column) {
                //         return Url::toRoute([$action, 'id' => $model->id]);
                //     }
                // ],
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
