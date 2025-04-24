<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cliente $model */

$this->title = Yii::t('app', 'Update Cliente: {name}', [
    'name' => $model->idcliente,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcliente, 'url' => ['view', 'idcliente' => $model->idcliente]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
