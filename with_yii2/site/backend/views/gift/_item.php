<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 19:27
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<tr>
    <td><img src="<?= Url::to(['image','file'=>$model->image]); ?>" width="100"></td>
    <td>
        <h3><?= $model->name ?> <?= $model->status==1?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>' ?> </h3>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id]) ?> |
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </td>
    <td>
        <h1>X<?= $model->amount ?></h1>
    </td>
</tr>
