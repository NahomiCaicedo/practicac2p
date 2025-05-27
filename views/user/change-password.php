<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ChangePasswordForm $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* Fondo con imagen difuminada */
    .background-blur {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }

    .background-blur img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: blur(10px);
        transform: scale(1.1); /* evita bordes feos por el blur */
    }

    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .change-password-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
        position: relative;
        z-index: 1;
    }

    .card-custom {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 40px;
        max-width: 500px;
        width: 100%;
        color: #4E2C10;
    }

    .card-custom h1 {
        font-weight: bold;
        color: #4E2C10;
        margin-bottom: 15px;
    }

    .card-custom p {
        color: #5C5C5C;
        margin-bottom: 25px;
    }

    .form-label {
        color: #4E2C10;
    }

    .btn-primary {
        background-color: #B97527;
        border-color: #B97527;
        color: white;
    }

    .btn-primary:hover {
        background-color: #965C1E;
        border-color: #965C1E;
    }
</style>

<!-- Imagen de fondo difuminada -->
<div class="background-blur">
    <img src="https://static.vecteezy.com/system/resources/previews/006/204/627/large_2x/perfume-and-makeup-cosmetics-on-wooden-background-free-photo.jpg" alt="Fondo difuminado">
</div>

<!-- Contenido del formulario -->
<div class="change-password-container">
    <div class="card-custom text-center">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to change your password:</p>

        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control mb-3'],
                'errorOptions' => ['class' => 'invalid-feedback d-block'],
            ],
        ]); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary w-100']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
