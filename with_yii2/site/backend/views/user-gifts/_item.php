<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 20:21
 * @var \common\models\UserGifts $model
 */

use yii\helpers\Url;
$image = ($model->money > 0)?'/imgs/money.png':$model->gift->image;
?>

<tr>
    <td><img src="<?= Url::to(['gift/image','file'=>$image]); ?>" width="100"></td>
    <td>
        <h3><?= $model->gift?$model->gift->name:$model->money ?> <?= $model->status==1?'<span class="label label-info">Sending</span>':'<span class="label label-success">sent</span>' ?> </h3>
        <p>
            <?= $model->time ?> <b><span class="glyphicon glyphicon-user"></span> <?= $model->user->username ?></b>
        </p>
    </td>
    <td>
        <?php
        if(!is_null($model->gift_id))
            echo \yii\helpers\Html::a('Send',['set-sent','id'=>$model->id],['class'=>'btn btn-success']);
        ?>
    </td>
</tr>
