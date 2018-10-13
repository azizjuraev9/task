<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserGiftsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-gifts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-11">
            <div class="col-md-3">
                <?= $form->field($model, 'username')->label(false) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'giftname')->label(false) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'status')->dropDownList([1 => 'Sending', 2 => 'Sent'], ['prompt' => '-- status --'])->label(false) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'money')->label(false) ?>
            </div>
        </div>
        <div class="col-md-1">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
