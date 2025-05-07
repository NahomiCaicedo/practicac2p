<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
