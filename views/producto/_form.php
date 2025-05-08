<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Detallepedido;

/** @var yii\web\View $this */
/** @var app\models\Producto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    
    <?php if($model->Portada): ?>
        <div class="form-group">
            <?= Html::label('Imagen Actual') ?>
            <div>
            <?= Html::img(Yii::getAlias('@web' . '/portadas/' . $model->Portada,['style' => 'width: 200px']))?>
            </div>
        </div>
    <?php endif; ?>

    <?php //$form->field($model, 'Portada')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imageFile')->fileInput()->label('Selecionar portada') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder'=>'Nombre del producto', 'required'=>true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => 255,'placeholder'=>'Escriba aqui la descripción del producto', 'required'=>true]) ?>

    <?= $form->field($model, 'precio')->textInput(['maxlength' => true,'placeholder'=>'Ingrese el precio...', 'required'=>true]) ?>

    <?= $form->field($model, 'fk_idcategoria')->dropDownList(ArrayHelper::map(Categoria::find()->select(['idcategoria','CONCAT(nombre_categoria) AS nombre_categoria_completo'])
                                                                                              ->orderBy('nombre_categoria')
                                                                                              ->asArray()
                                                                                              ->all(), 'idcategoria', 'nombre_categoria_completo'),
                                                                                              ['prompt'=>'Seleccione una categoria', 'required'=>true])
    ?>

    <div class= "mb-3">
        <?= Html::label('Selecciones el detalle del pedido', 'detallepedido-search',['class'=>'form-label']) ?>
        <div class="input-group">
            <input type="text" class="detallepedido-search" placeholder="Buscar detalle" class="form-control">
            <a href="<?= Yii::$app->urlManager->createUrl(['detallepedido/create']) ?>" class="btn btn-secondary">
              <i class="bi bi-plus"></i> 
              Nuevo detalle</a> 
        </div>
        <?= Html::activeListBox($model, 'detallepedidos', ArrayHelper::map(Detallepedido::find()->orderBy(['cantidad' => SORT_ASC])->all(),
                                                                                             'iddetallepedido',function($detallepedido){
                                                                                                return $detallepedido->cantidad . ',' . $detallepedido->precio_unitario;
                                                                                                }), ['multiple' => true, 'size' => 10, 'id'=>'detallepedidos-select', 'class'=>'form-control mt-2']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
