<?php

use app\models\Producto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ProductoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$css = <<<CSS
.producto-index {
    position: relative;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.85);
    padding: 30px;
    border-radius: 10px;
}
.producto-index::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-image: url('https://static.vecteezy.com/system/resources/previews/006/204/627/large_2x/perfume-and-makeup-cosmetics-on-wooden-background-free-photo.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(8px);
    opacity: 0.7;
    z-index: -1;
}
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}
.card {
    width: 250px;
    height: 420px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    overflow: hidden;
    text-align: center;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}
.card h5 {
    font-size: 18px;
    margin: 10px 0 5px;
}
.card p {
    font-size: 14px;
    flex-grow: 1;
    margin: 5px 0;
}
.card .price {
    font-weight: bold;
    color: #B97527;
    margin: 10px 0;
}
CSS;

$this->registerCss($css);
$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="producto-index d-flex flex-column align-items-center justify-content-center text-center" style="margin-top: 100px; margin-bottom: 80px;">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Producto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <div class="card-container">
        <?php foreach ($dataProvider->getModels() as $producto): ?>
            <div class="card">
                <?php if ($producto->Portada): ?>
                    <?= Html::img(Url::to('@web/portadas/' . $producto->Portada, true)) ?>
                <?php else: ?>
                    <div style="height:180px; background:#eee; display:flex; align-items:center; justify-content:center;">
                        <span>Sin imagen</span>
                    </div>
                <?php endif; ?>
                
                <h5><?= Html::encode($producto->nombre) ?></h5>
                <p><?= Html::encode($producto->descripcion) ?></p>
                <div class="price">$<?= Html::encode($producto->precio) ?></div>

                <?= Html::a('Ver', ['view', 'idproducto' => $producto->idproducto], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('Editar', ['update', 'idproducto' => $producto->idproducto], ['class' => 'btn btn-warning btn-sm']) ?>
                <?= Html::a('Eliminar', ['delete', 'idproducto' => $producto->idproducto], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => '¿Estás seguro de que deseas eliminar este producto?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php Pjax::end(); ?>

</div>
