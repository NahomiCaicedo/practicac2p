<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_venta".
 *
 * @property int $iddetalle
 * @property string|null $cantidad
 * @property float|null $precio_unitario
 * @property float|null $precio_total
 * @property int $venta_idventa
 * @property int $productos_idproducto
 *
 * @property Productos $productosIdproducto
 * @property Venta $ventaIdventa
 */
class DetalleVenta extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'precio_unitario', 'precio_total'], 'default', 'value' => null],
            [['iddetalle', 'venta_idventa', 'productos_idproducto'], 'required'],
            [['iddetalle', 'venta_idventa', 'productos_idproducto'], 'integer'],
            [['precio_unitario', 'precio_total'], 'number'],
            [['cantidad'], 'string', 'max' => 100],
            [['iddetalle'], 'unique'],
            [['productos_idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['productos_idproducto' => 'idproducto']],
            [['venta_idventa'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::class, 'targetAttribute' => ['venta_idventa' => 'idventa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalle' => Yii::t('app', 'Iddetalle'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'precio_unitario' => Yii::t('app', 'Precio Unitario'),
            'precio_total' => Yii::t('app', 'Precio Total'),
            'venta_idventa' => Yii::t('app', 'Venta Idventa'),
            'productos_idproducto' => Yii::t('app', 'Productos Idproducto'),
        ];
    }

    /**
     * Gets query for [[ProductosIdproducto]].
     *
     * @return \yii\db\ActiveQuery|ProductosQuery
     */
    public function getProductosIdproducto()
    {
        return $this->hasOne(Productos::class, ['idproducto' => 'productos_idproducto']);
    }

    /**
     * Gets query for [[VentaIdventa]].
     *
     * @return \yii\db\ActiveQuery|VentaQuery
     */
    public function getVentaIdventa()
    {
        return $this->hasOne(Venta::class, ['idventa' => 'venta_idventa']);
    }

    /**
     * {@inheritdoc}
     * @return DetalleVentaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetalleVentaQuery(get_called_class());
    }

}
