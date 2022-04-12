<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kategori */

$this->title = 'Kategori Program Donasi';
$this->params['breadcrumbs'][] = ['label' => 'Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-create">

    <div class="row justify-content-md-center">
        <div class="col-md-5">
            <div class="card card-body">
            
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
            </div>
        </div>
        
    </div>
</div>
