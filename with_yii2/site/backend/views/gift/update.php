<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gifts */

$this->title = 'Update Gifts: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gifts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
