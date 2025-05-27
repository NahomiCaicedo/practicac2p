<?php

use app\models\Producto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
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
    background-color: #3a2c1f; /* Marrón oscuro */
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    overflow: hidden;
    text-align: center;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #f0e9de; /* Texto claro */
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.8);
}

.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #b97527; /* borde dorado para destacar */
}

.card h5 {
    font-size: 18px;
    margin: 10px 0 5px;
    color: #f0e9de;
}

.card p {
    font-size: 14px;
    flex-grow: 1;
    margin: 5px 0;
    color: #d4c9b1;
}

.card .price {
    font-weight: bold;
    color: #b97527; /* Color dorado brillante */
    margin: 10px 0;
}

.btn-primary {
    background-color: #6a4e2a; /* marrón oscuro */
    border-color: #6a4e2a;
    color: #f0e9de;
}

.btn-primary:hover {
    background-color: #8b6a38;
    border-color: #8b6a38;
    color: #fff;
}

.btn-warning {
    background-color: #b97f2b; /* dorado mate */
    border-color: #b97f2b;
    color: #3a2c1f;
}

.btn-warning:hover {
    background-color: #d1a240;
    border-color: #d1a240;
    color: #2b1f0e;
}

.btn-danger {
    background-color: #a0301a; /* rojo oscuro */
    border-color: #a0301a;
    color: #f0e9de;
}

.btn-danger:hover {
    background-color: #c0482a;
    border-color: #c0482a;
    color: #fff;
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
            <?php 
                $imagePath = Yii::getAlias('@web') . '/portadas/' . $producto->Portada;
                $fullImagePath = Yii::getAlias('@webroot') . '/portadas/' . $producto->Portada;
                
                // Verificar si el archivo existe físicamente
                if (file_exists($fullImagePath)): 
            ?>
                <?= Html::img($imagePath, ['alt' => $producto->nombre, 'class' => 'img-fluid']) ?>
            <?php else: ?>
                <div style="height:180px; background:#eee; display:flex; align-items:center; justify-content:center; color:#666;">
                    <span>Imagen no encontrada</span>
                </div>
                <!-- Debug: <?= $fullImagePath ?> -->
            <?php endif; ?>
        <?php else: ?>
            <div style="height:180px; background:#eee; display:flex; align-items:center; justify-content:center; color:#666;">
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
