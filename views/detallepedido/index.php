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

$this->title = Yii::t('app', 'Detallepedidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallepedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

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

            'iddetallepedido',
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
