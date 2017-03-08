<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'attachment')->fileInput() ?>

  <?= Html::submitButton('Submit', ['class'=>'btn btn-primary']);?>

<?php ActiveForm::end() ?>