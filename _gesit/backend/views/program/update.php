<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDonasi */

$this->title = 'Update Program Donasi: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Program Donasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-donasi-update">
    <div class="card card-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
