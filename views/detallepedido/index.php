<?php

use app\models\Detallepedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\DetallepedidoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$css = <<<CSS
.detallepedido-index {
    position: relative;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(90, 62, 27, 0.3);
}
.detallepedido-index::before {
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
    opacity: 0.6;
    z-index: -1;
}

/* Estilo de tabla */
table.table {
    background-color: rgba(255, 255, 255, 0.96);
    color: #3C2F1B;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(123, 78, 18, 0.2);
}

table.table th {
    background-color: #B97527;
    color: white;
    text-align: center;
    font-weight: bold;
    border: none;
}

table.table td {
    text-align: center;
    vertical-align: middle;
    border: none;
}

table.table tr:nth-child(even) {
    background-color: #f7f0e6;
}

table.table tr:hover {
    background-color: #f1e5d6;
    transition: 0.3s;
}

/* Botón */
.btn-success {
    background-color: #b97527;
    border-color: #b97527;
    color: white;
    font-weight: bold;
}

.btn-success:hover {
    background-color: #965c1e;
    border-color: #965c1e;
}
CSS;

$this->registerCss($css);
$this->title = Yii::t('app', 'Detallepedidos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="detallepedido-index d-flex flex-column align-items-center justify-content-center text-center" style="margin-top: 100px; margin-bottom: 80px;">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Detallepedido'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cantidad',
            'precio_unitario',
            'precio_total',
            'fk_idpedido',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Detallepedido $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'iddetallepedido' => $model->iddetallepedido]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
