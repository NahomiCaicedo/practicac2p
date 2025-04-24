<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleVenta;

/**
 * DetalleVentaSearch represents the model behind the search form of `app\models\DetalleVenta`.
 */
class DetalleVentaSearch extends DetalleVenta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetalle', 'venta_idventa', 'productos_idproducto'], 'integer'],
            [['cantidad'], 'safe'],
            [['precio_unitario', 'precio_total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = DetalleVenta::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'iddetalle' => $this->iddetalle,
            'precio_unitario' => $this->precio_unitario,
            'precio_total' => $this->precio_total,
            'venta_idventa' => $this->venta_idventa,
            'productos_idproducto' => $this->productos_idproducto,
        ]);

        $query->andFilterWhere(['like', 'cantidad', $this->cantidad]);

        return $dataProvider;
    }
}
