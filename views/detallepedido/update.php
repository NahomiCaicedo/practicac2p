<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Detallepedido $model */

$this->title = Yii::t('app', 'Update Detallepedido: {name}', [
    'name' => $model->iddetallepedido,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detallepedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddetallepedido, 'url' => ['view', 'iddetallepedido' => $model->iddetallepedido]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="detallepedido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
