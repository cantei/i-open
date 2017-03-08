<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TbvisitdrugSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbvisitdrug-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hospcode') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'seq') ?>

    <?php // echo $form->field($model, 'date_serv') ?>

    <?php // echo $form->field($model, 'didstd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
