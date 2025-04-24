<?php

use app\models\Venta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\VentaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ventas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Venta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idventa',
            'fecha_venta',
            'total',
            'cliente_idcliente',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Venta $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idventa' => $model->idventa]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
