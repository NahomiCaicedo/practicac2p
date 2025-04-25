<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detallepedido".
 *
 * @property int $iddetallepedido
 * @property string|null $cantidad
 * @property string|null $precio_unitario
 * @property string|null $precio_total
 * @property int $fk_idpedido
 * @property int $fk_idproducto
 *
 * @property Pedido $fkIdpedido
 * @property Producto $fkIdproducto
 */
class Detallepedido extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detallepedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'precio_unitario', 'precio_total'], 'default', 'value' => null],
            [['iddetallepedido', 'fk_idpedido', 'fk_idproducto'], 'required'],
            [['iddetallepedido', 'fk_idpedido', 'fk_idproducto'], 'integer'],
            [['cantidad', 'precio_unitario', 'precio_total'], 'string', 'max' => 45],
            [['iddetallepedido'], 'unique'],
            [['fk_idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::class, 'targetAttribute' => ['fk_idpedido' => 'idpedido']],
            [['fk_idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['fk_idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetallepedido' => Yii::t('app', 'Iddetallepedido'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'precio_unitario' => Yii::t('app', 'Precio Unitario'),
            'precio_total' => Yii::t('app', 'Precio Total'),
            'fk_idpedido' => Yii::t('app', 'Fk Idpedido'),
            'fk_idproducto' => Yii::t('app', 'Fk Idproducto'),
        ];
    }

    /**
     * Gets query for [[FkIdpedido]].
     *
     * @return \yii\db\ActiveQuery|PedidoQuery
     */
    public function getFkIdpedido()
    {
        return $this->hasOne(Pedido::class, ['idpedido' => 'fk_idpedido']);
    }

    /**
     * Gets query for [[FkIdproducto]].
     *
     * @return \yii\db\ActiveQuery|ProductoQuery
     */
    public function getFkIdproducto()
    {
        return $this->hasOne(Producto::class, ['idproducto' => 'fk_idproducto']);
    }

    /**
     * {@inheritdoc}
     * @return DetallepedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetallepedidoQuery(get_called_class());
    }

}
