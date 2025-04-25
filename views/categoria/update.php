<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categoria $model */

$this->title = Yii::t('app', 'Update Categoria: {name}', [
    'name' => $model->idcategoria,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcategoria, 'url' => ['view', 'idcategoria' => $model->idcategoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
