<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetalleVenta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalle-venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iddetalle')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_unitario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'venta_idventa')->textInput() ?>

    <?= $form->field($model, 'productos_idproducto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
