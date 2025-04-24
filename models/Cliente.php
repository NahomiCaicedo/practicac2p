<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $idcliente
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $correo
 * @property int|null $telefono
 * @property string|null $direccion
 *
 * @property Venta[] $ventas
 */
class Cliente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'correo', 'telefono', 'direccion'], 'default', 'value' => null],
            [['idcliente'], 'required'],
            [['idcliente', 'telefono'], 'integer'],
            [['nombre', 'apellido', 'correo', 'direccion'], 'string', 'max' => 45],
            [['idcliente'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcliente' => Yii::t('app', 'Idcliente'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'correo' => Yii::t('app', 'Correo'),
            'telefono' => Yii::t('app', 'Telefono'),
            'direccion' => Yii::t('app', 'Direccion'),
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery|VentaQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * {@inheritdoc}
     * @return ClienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClienteQuery(get_called_class());
    }

}
