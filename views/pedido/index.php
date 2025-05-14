<?php

use app\models\Pedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PedidoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idpedido',
            'fecha_pedido',
            'estado_pedido',
            'fk_idcliente',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pedido $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idpedido' => $model->idpedido]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
