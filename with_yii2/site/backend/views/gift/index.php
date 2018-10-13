<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GiftsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gifts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gifts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Gifts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item',
    ]) ?>
    </table>


</div>
