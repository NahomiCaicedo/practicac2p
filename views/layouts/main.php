<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .custom-navbar {
            background-color: #D9B382;
        }

        /* Color del texto en el navbar */
        .custom-navbar .nav-link,
        .custom-navbar .navbar-brand {
            color: #5A3E1B; /* Cambia a tu color deseado */
        }
        /* Cuando haces hover sobre los links del navbar */
        .custom-navbar .nav-link:hover,
        .custom-navbar .nav-link:focus {
            color: #A26E2E; /* Cambia a tu color deseado */
        }

        .custom-navbar .dropdown-menu {
            background-color: #D9B382;
        }
        .custom-navbar .dropdown-menu .dropdown-item {
            color: #5A3E1B;
        }
        .custom-navbar .dropdown-menu .dropdown-item:hover,
        .custom-navbar .dropdown-menu .dropdown-item:focus {
            background-color: #A26E2E;
            color: white;
        }
</style>
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark custom-navbar fixed-top']

    ]);
    echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            //['label' => 'Sobre nosotros', 'url' => ['/site/about']],
            //['label' => 'Contáctenos', 'url' => ['/site/contact']],
            //['label' => 'Clientes', 'url' => ['/cliente/index']],
            //['label' => 'Pedidos', 'url' => ['/pedido/index']],
            //['label' => 'Productos', 'url' => ['/producto/index']],
            //['label' => 'Categorias', 'url' => ['/categoria/index']],
            //['label' => 'Detalles', 'url' => ['/detallepedido/index']],
            [
                'label' => 'Gestión',
                'items' => [
                    ['label' => 'Clientes', 'url' => ['/cliente/index']],
                    ['label' => 'Pedidos', 'url' => ['/pedido/index']],
                    ['label' => 'Productos', 'url' => ['/producto/index']],
                    ['label' => 'Categorias', 'url' => ['/categoria/index']],
                    ['label' => 'Detalles', 'url' => ['/detallepedido/index']],
                    (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin') ? '' : 
                    (!Yii::$app->user->isGuest ? ['label' => 'User', 'url' => ['/user/index']] : ''),                ],
            ],

            Yii::$app->user->isGuest ? '': ['label' => 'Cambiar password', 'url' =>['/user/change-password']],

            Yii::$app->user->isGuest
                ? ['label' => 'Iniciar sesión', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Cerrar sesión (' . Yii::$app->user->identity->apellido .' '. Yii::$app->user->identity->nombre .') '. Yii::$app->user->identity->role,
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Mi app <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
