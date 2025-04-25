<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pedido $model */

$this->title = Yii::t('app', 'Update Pedido: {name}', [
    'name' => $model->idpedido,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpedido, 'url' => ['view', 'idpedido' => $model->idpedido]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
