<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserGifts */

$this->title = 'Create User Gifts';
$this->params['breadcrumbs'][] = ['label' => 'User Gifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-gifts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
