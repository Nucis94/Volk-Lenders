<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Footballer */

$this->title = 'Update Footballer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Footballers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="footballer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'isNew' => false,
        'model' => $model,
    ]) ?>

</div>
