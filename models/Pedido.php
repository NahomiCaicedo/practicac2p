<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $idpedido
 * @property string|null $fecha_pedido
 * @property string|null $estado_pedido
 * @property int $fk_idcliente
 *
 * @property Detallepedido[] $detallepedidos
 * @property Cliente $fkIdcliente
 */
class Pedido extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_pedido', 'estado_pedido'], 'default', 'value' => null],
            [['idpedido', 'fk_idcliente'], 'required'],
            [['idpedido', 'fk_idcliente'], 'integer'],
            [['fecha_pedido', 'estado_pedido'], 'string', 'max' => 45],
            [['idpedido'], 'unique'],
            [['fk_idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['fk_idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpedido' => Yii::t('app', 'Idpedido'),
            'fecha_pedido' => Yii::t('app', 'Fecha Pedido'),
            'estado_pedido' => Yii::t('app', 'Estado Pedido'),
            'fk_idcliente' => Yii::t('app', 'Fk Idcliente'),
        ];
    }

    /**
     * Gets query for [[Detallepedidos]].
     *
     * @return \yii\db\ActiveQuery|DetallepedidoQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::class, ['fk_idpedido' => 'idpedido']);
    }

    /**
     * Gets query for [[FkIdcliente]].
     *
     * @return \yii\db\ActiveQuery|ClienteQuery
     */
    public function getFkIdcliente()
    {
        return $this->hasOne(Cliente::class, ['idcliente' => 'fk_idcliente']);
    }

    /**
     * {@inheritdoc}
     * @return PedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PedidoQuery(get_called_class());
    }

}
