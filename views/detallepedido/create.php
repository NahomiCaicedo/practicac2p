<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Detallepedido $model */

$this->title = Yii::t('app', 'Create Detallepedido');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detallepedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallepedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
