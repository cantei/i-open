<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tbvisitdrug */

$this->title = 'import who recieve  drug';
$this->params['breadcrumbs'][] = ['label' => 'Tbvisitdrugs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbvisitdrug-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
