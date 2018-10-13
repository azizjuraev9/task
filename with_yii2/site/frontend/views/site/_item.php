<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 20:21
 * @var \common\models\UserGifts $model
 */

?>

<tr>
    <td><img src="<?= ($model->money > 0)?'/imgs/money.png':$model->gift->image; ?>" width="100"></td>
    <td>
        <h3><?= ($model->gift?$model->gift->name:$model->money).' <span class="glyphicon glyphicon-euro"></span>' ?> <?= $model->status==1?'<span class="label label-info">Sending</span>':'<span class="label label-success">sent</span>' ?> </h3>
        <p>
            <?= $model->time ?>
        </p>
    </td>
</tr>
