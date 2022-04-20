<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Donasi */

$this->title = 'Donasi dari '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Donasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="donasi-view">

    <div class="card card-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'id_program',
                'id_donatur',
                'id_invoice',
                'nama:ntext',
                'email:ntext',
                'pesan:ntext',
                'jumlah',
            ],
        ]) ?>
    </div>

</div>
