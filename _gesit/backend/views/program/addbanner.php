<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SekolahMitra */

$this->title = 'Tambahkan Foto SM';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Mitras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sekolah-mitra-create">

    <div class="card">
        <div class="card-body" style="padding: 2em">
            <?= $this->render('_formbanner', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
