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
    background-color: rgba(255, 255, 255, 0.85);
    padding: 30px;
    border-radius: 10px;
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
    opacity: 0.7;
    z-index: -1;
}
CSS;

$this->registerCss($css);
$this->title = Yii::t('app', 'Detallepedidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallepedido-index d-flex flex-column align-items-center justify-content-center text-center" style="margin-top: 100px; margin-bottom: 80px;">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Detallepedido'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'iddetallepedido',
            'cantidad',
            'precio_unitario',
            'precio_total',
            'fk_idpedido',
            //'fk_idproducto',
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
