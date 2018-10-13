<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GiftsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gifts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'giftname') ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'Active',2=>'Inactive'],['prompt'=>'-- status --']) ?>

    <?= $form->field($model, 'money') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
