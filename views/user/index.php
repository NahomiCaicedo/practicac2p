<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

// Estilos CSS embebidos
$css = <<<CSS
.user-index-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    position: relative;
    z-index: 1;
}

.user-index {
    background-color: rgba(255, 255, 255, 0.94);
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(0,0,0,0.15);
    padding: 30px 40px;
    width: 100%;
    max-width: 1000px;
    color: #3a2a14;
    text-align: center;
}

/* Fondo difuminado */
.user-index-wrapper::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-image: url('https://static.vecteezy.com/system/resources/previews/006/204/627/large_2x/perfume-and-makeup-cosmetics-on-wooden-background-free-photo.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(10px);
    opacity: 0.7;
    z-index: -1;
}

/* Estilo de tabla */
table.table {
    background-color: white;
    color: #333;
    border-radius: 8px;
    overflow: hidden;
}

table.table th {
    background-color: #4e2c10;
    color: #fff;
    text-align: center;
}

table.table td {
    text-align: center;
    vertical-align: middle;
}

table.table tr:nth-child(even) {
    background-color: #f8f4f0;
}

table.table tr:hover {
    background-color: #f3e5d3;
}

/* Botones */
.btn-success {
    background-color: #b97527;
    border-color: #b97527;
}

.btn-success:hover {
    background-color: #965c1e;
    border-color: #965c1e;
}

.btn-warning {
    background-color: #d48a0b;
    border-color: #d48a0b;
    color: white;
}
.btn-warning:hover {
    background-color: #b56f07;
    border-color: #b56f07;
}
CSS;

$this->registerCss($css);
?>

<!-- Contenedor general con fondo -->
<div class="user-index-wrapper">
    <div class="user-index">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success mb-3']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'username',
                'role',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {reset-password}',
                    'buttons' => [
                        'reset-password' => function ($url, $model, $key) {
                            return Html::a('Reset Password', ['reset-password', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to reset the password for this user?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
