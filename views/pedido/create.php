<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pedido $model */

$this->title = Yii::t('app', 'Create Pedido');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
