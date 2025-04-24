<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DetalleVenta]].
 *
 * @see DetalleVenta
 */
class DetalleVentaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DetalleVenta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DetalleVenta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
