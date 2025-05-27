<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
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
        transform: scale(1.1); /* evita bordes visibles del blur */
    }

    .login-container {
        position: relative;
        z-index: 1;
    }

    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /* NUEVOS ESTILOS PARA CONTRASTE Y COLORIMETRÍA */
    .card {
        background-color: rgba(255, 255, 255, 0.92);
        border-radius: 12px;
        color: #4E2C10;
    }

    .card-title {
        color: #4E2C10;
        font-weight: bold;
    }

    .card-text,
    .text-muted {
        color: #5C5C5C;
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

    .form-check-label {
        color: #4E2C10;
    }
</style>

<!-- Imagen de fondo difuminada -->
<div class="background-blur">
    <img src="https://static.vecteezy.com/system/resources/previews/006/204/627/large_2x/perfume-and-makeup-cosmetics-on-wooden-background-free-photo.jpg" alt="Fondo difuminado">
</div>

<!-- Contenido del login -->
<div class="site-login d-flex justify-content-center align-items-center login-container" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <div class="card-body text-center">
            <h1 class="card-title"><?= Html::encode($this->title) ?></h1>
            <p class="card-text">Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control mb-3'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"form-check mb-3 text-start\">{input} {label}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => 'form-check-label'],
                'inputOptions' => ['class' => 'form-check-input'],
            ]) ?>

            <div class="form-group mb-3">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="text-muted mt-3">
                You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                To modify the username/password, check <code>app\models\User::$users</code>.
            </div>
        </div>
    </div>
</div>
