<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetalleVentaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalle-venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'iddetalle') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'precio_unitario') ?>

    <?= $form->field($model, 'precio_total') ?>

    <?= $form->field($model, 'venta_idventa') ?>

    <?php // echo $form->field($model, 'productos_idproducto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
