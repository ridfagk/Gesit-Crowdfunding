<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Donasi */

$this->title = 'Create Donasi';
$this->params['breadcrumbs'][] = ['label' => 'Donasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="donasi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
