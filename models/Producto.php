<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idproducto
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $precio
 * @property int $fk_idcategoria
 *
 * @property Detallepedido[] $detallepedidos
 * @property Categoria $fkIdcategoria
 */
class Producto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'precio'], 'default', 'value' => null],
            [['idproducto', 'fk_idcategoria'], 'required'],
            [['idproducto', 'fk_idcategoria'], 'integer'],
            [['nombre', 'descripcion', 'precio'], 'string', 'max' => 45],
            [['idproducto'], 'unique'],
            [['fk_idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['fk_idcategoria' => 'idcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => Yii::t('app', 'Idproducto'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'fk_idcategoria' => Yii::t('app', 'Fk Idcategoria'),
        ];
    }

    /**
     * Gets query for [[Detallepedidos]].
     *
     * @return \yii\db\ActiveQuery|DetallepedidoQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::class, ['fk_idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[FkIdcategoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriaQuery
     */
    public function getFkIdcategoria()
    {
        return $this->hasOne(Categoria::class, ['idcategoria' => 'fk_idcategoria']);
    }

    /**
     * {@inheritdoc}
     * @return ProductoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductoQuery(get_called_class());
    }

}
