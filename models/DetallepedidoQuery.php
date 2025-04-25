<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Detallepedido]].
 *
 * @see Detallepedido
 */
class DetallepedidoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Detallepedido[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Detallepedido|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
