<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Footballer */

$this->title = 'Create Footballer';
$this->params['breadcrumbs'][] = ['label' => 'Footballers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="footballer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
