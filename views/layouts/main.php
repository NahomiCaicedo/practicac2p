<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .vertical-navbar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #D9B382;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 1030;
        }

        .vertical-navbar .navbar-brand {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #5A3E1B;
            display: flex;
            align-items: center;
        }

        .vertical-navbar .navbar-brand i {
            margin-right: 0.5rem;
        }

        .vertical-navbar .nav-link {
            color: #5A3E1B;
            padding: 0.75rem 0;
            border-top: 1px solid #c59f6d;
            display: flex;
            align-items: center;
        }

        .vertical-navbar .nav-link i {
            margin-right: 0.5rem;
        }

        .vertical-navbar .nav-link:first-child {
            border-top: none;
        }

        .vertical-navbar .nav-link:hover,
        .vertical-navbar .nav-link:focus {
            color: #A26E2E;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Dropdown menu */
        .vertical-navbar .dropdown-menu {
            background-color: #A26E2E;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            margin-left: 0;
            margin-top: 0.25rem;
            border: none;
            padding: 0.5rem 0;
            min-width: 100%;
            color: white;
            z-index: 1040;
        }
        .vertical-navbar .dropdown-menu.show {
            display: block;
        }
        
        .vertical-navbar .dropdown-menu li > a {
            display: block;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .vertical-navbar .dropdown-menu li > a:hover,
        .vertical-navbar .dropdown-menu li > a:focus {
            background-color: #A26E2E;
            color: #fff;
            text-decoration: none;
        }


        .content-with-sidebar {
            margin-left: 240px;
            padding: 1rem;
        }

        footer.content-with-sidebar {
            margin-left: 240px;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <div class="vertical-navbar">
        <div class="navbar-brand">
            <i class="bi bi-heart-fill"></i> UNIBELLEZA
        </div>
        <?= Nav::widget([
            'options' => ['class' => 'nav flex-column'],
            'items' => [
                [
                    'label' => '<i class="bi bi-house-fill"></i> Inicio',
                    'url' => ['/site/index'],
                    'encode' => false,
                    'linkOptions' => ['class' => 'nav-link']
                ],
                [
                    'label' => '<i class="bi bi-folder-fill"></i> Gestión',
                    'items' => [
                        ['label' => 'Clientes', 'url' => ['/cliente/index']],
                        ['label' => 'Pedidos', 'url' => ['/pedido/index']],
                        ['label' => 'Productos', 'url' => ['/producto/index']],
                        ['label' => 'Categorias', 'url' => ['/categoria/index']],
                        ['label' => 'Detalles', 'url' => ['/detallepedido/index']],
                        (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin') ? '' :
                        (!Yii::$app->user->isGuest ? ['label' => 'User', 'url' => ['/user/index']] : ''),
                    ],
                    'encode' => false,
                    'linkOptions' => ['class' => 'nav-link dropdown-toggle', 'data-bs-toggle' => 'dropdown'],
                    'dropDownOptions' => ['class' => 'dropdown-menu show'],
                ],
                Yii::$app->user->isGuest ? ''
                    : [
                        'label' => 'Cambiar password',
                        'url' => ['/user/change-password'],
                        'linkOptions' => ['class' => 'nav-link']
                    ],
                Yii::$app->user->isGuest
                    ? [
                        'label' => '<i class="bi bi-box-arrow-in-right"></i> Iniciar sesión',
                        'url' => ['/site/login'],
                        'encode' => false,
                        'linkOptions' => ['class' => 'nav-link']
                    ]
                    : [
                        'label' => 'Cerrar sesión (' . Yii::$app->user->identity->apellido . ' ' . Yii::$app->user->identity->nombre . ') ' . Yii::$app->user->identity->role,
                        'url' => ['/site/logout'],
                        'linkOptions' => [
                            'data-method' => 'post',
                            'class' => 'nav-link'
                        ]
                    ]
            ],
        ]) ?>
    </div>
</header>

<main id="main" class="flex-shrink-0 content-with-sidebar" role="main">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3 bg-light content-with-sidebar">
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
