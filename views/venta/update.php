<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */

$this->title = Yii::t('app', 'Update Venta: {name}', [
    'name' => $model->idventa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idventa, 'url' => ['view', 'idventa' => $model->idventa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
