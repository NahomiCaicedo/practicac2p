<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetallepedidoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detallepedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'iddetallepedido') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'precio_unitario') ?>

    <?= $form->field($model, 'precio_total') ?>

    <?= $form->field($model, 'fk_idpedido') ?>

    <?php // echo $form->field($model, 'fk_idproducto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
