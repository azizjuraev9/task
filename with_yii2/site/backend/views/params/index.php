<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $models common\models\ParamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Params';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="params-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
    <?php foreach ($models as $k=>$model): ?>
        <tr>
            <td>
                <label for=""><?= $model->desc ?></label>
            </td>
            <td>
                <?= $form->field($model, "[{$k}]value")->textInput(['maxlength' => true])->label(false) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>
