<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Detallepedido $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detallepedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iddetallepedido')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_unitario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_idpedido')->textInput() ?>

    <?= $form->field($model, 'fk_idproducto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
