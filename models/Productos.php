<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $idproducto
 * @property string|null $nombre
 * @property string|null $categoria
 * @property float|null $precio
 * @property string|null $stock
 *
 * @property DetalleVenta[] $detalleVentas
 * @property ProductosHasVenta[] $productosHasVentas
 * @property Venta[] $ventaIdventas
 */
class Productos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'categoria', 'precio', 'stock'], 'default', 'value' => null],
            [['idproducto'], 'required'],
            [['idproducto'], 'integer'],
            [['precio'], 'number'],
            [['nombre', 'categoria', 'stock'], 'string', 'max' => 45],
            [['idproducto'], 'unique'],
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
            'categoria' => Yii::t('app', 'Categoria'),
            'precio' => Yii::t('app', 'Precio'),
            'stock' => Yii::t('app', 'Stock'),
        ];
    }

    /**
     * Gets query for [[DetalleVentas]].
     *
     * @return \yii\db\ActiveQuery|DetalleVentaQuery
     */
    public function getDetalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, ['productos_idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[ProductosHasVentas]].
     *
     * @return \yii\db\ActiveQuery|ProductosHasVentaQuery
     */
    public function getProductosHasVentas()
    {
        return $this->hasMany(ProductosHasVenta::class, ['productos_idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[VentaIdventas]].
     *
     * @return \yii\db\ActiveQuery|VentaQuery
     */
    public function getVentaIdventas()
    {
        return $this->hasMany(Venta::class, ['idventa' => 'venta_idventa'])->viaTable('productos_has_venta', ['productos_idproducto' => 'idproducto']);
    }

    /**
     * {@inheritdoc}
     * @return ProductosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductosQuery(get_called_class());
    }

}
