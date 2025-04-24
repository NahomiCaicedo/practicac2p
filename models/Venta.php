<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property int $idventa
 * @property string|null $fecha_venta
 * @property int|null $total
 * @property int $cliente_idcliente
 *
 * @property Cliente $clienteIdcliente
 * @property DetalleVenta[] $detalleVentas
 * @property ProductosHasVenta[] $productosHasVentas
 * @property Productos[] $productosIdproductos
 */
class Venta extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_venta', 'total'], 'default', 'value' => null],
            [['idventa', 'cliente_idcliente'], 'required'],
            [['idventa', 'total', 'cliente_idcliente'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['idventa'], 'unique'],
            [['cliente_idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['cliente_idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idventa' => Yii::t('app', 'Idventa'),
            'fecha_venta' => Yii::t('app', 'Fecha Venta'),
            'total' => Yii::t('app', 'Total'),
            'cliente_idcliente' => Yii::t('app', 'Cliente Idcliente'),
        ];
    }

    /**
     * Gets query for [[ClienteIdcliente]].
     *
     * @return \yii\db\ActiveQuery|ClienteQuery
     */
    public function getClienteIdcliente()
    {
        return $this->hasOne(Cliente::class, ['idcliente' => 'cliente_idcliente']);
    }

    /**
     * Gets query for [[DetalleVentas]].
     *
     * @return \yii\db\ActiveQuery|DetalleVentaQuery
     */
    public function getDetalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, ['venta_idventa' => 'idventa']);
    }

    /**
     * Gets query for [[ProductosHasVentas]].
     *
     * @return \yii\db\ActiveQuery|ProductosHasVentaQuery
     */
    public function getProductosHasVentas()
    {
        return $this->hasMany(ProductosHasVenta::class, ['venta_idventa' => 'idventa']);
    }

    /**
     * Gets query for [[ProductosIdproductos]].
     *
     * @return \yii\db\ActiveQuery|ProductosQuery
     */
    public function getProductosIdproductos()
    {
        return $this->hasMany(Productos::class, ['idproducto' => 'productos_idproducto'])->viaTable('productos_has_venta', ['venta_idventa' => 'idventa']);
    }

    /**
     * {@inheritdoc}
     * @return VentaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VentaQuery(get_called_class());
    }

}
