<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 2:17
 */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = "Winnings";
?>

<div class="user-gifts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <?= ListView::widget([
            'dataProvider' => $dp,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item',
        ]) ?>
    </table>
</div>
