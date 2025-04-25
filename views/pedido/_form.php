<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pedido $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idpedido')->textInput() ?>

    <?= $form->field($model, 'fecha_pedido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_pedido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_idcliente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
