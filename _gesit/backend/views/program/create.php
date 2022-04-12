<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDonasi */

$this->title = 'Program Donasi';
$this->params['breadcrumbs'][] = ['label' => 'Program Donasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-donasi-create">
    <div class="card card-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
