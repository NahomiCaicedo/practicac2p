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

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Producto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idproducto',
            //'Portada',
            [
                'attribute' => 'Portada',
                'format' => 'raw',
                'value' => function(Producto $model){
                    if($model->Portada)
                    return Html::img(Yii::getAlias('@web' . '/portadas/' . $model->Portada), ['style' => 'width: 80px']);
                return null;
                }
            ],
            'nombre',
            'descripcion',
            'precio',
            //'fk_idcategoria',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Producto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idproducto' => $model->idproducto]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
