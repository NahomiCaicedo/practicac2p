<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idventa')->textInput() ?>

    <?= $form->field($model, 'fecha_venta')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'cliente_idcliente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
