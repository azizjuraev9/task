<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserGiftsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Gifts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-gifts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item',
        ]) ?>
    </table>

</div>
