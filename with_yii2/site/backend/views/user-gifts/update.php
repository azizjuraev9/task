<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserGifts */

$this->title = 'Update User Gifts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Gifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-gifts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
