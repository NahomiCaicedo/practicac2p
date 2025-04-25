<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detallepedido;

/**
 * DetallepedidoSearch represents the model behind the search form of `app\models\Detallepedido`.
 */
class DetallepedidoSearch extends Detallepedido
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetallepedido', 'fk_idpedido', 'fk_idproducto'], 'integer'],
            [['cantidad', 'precio_unitario', 'precio_total'], 'safe'],
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
        $query = Detallepedido::find();

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
            'iddetallepedido' => $this->iddetallepedido,
            'fk_idpedido' => $this->fk_idpedido,
            'fk_idproducto' => $this->fk_idproducto,
        ]);

        $query->andFilterWhere(['like', 'cantidad', $this->cantidad])
            ->andFilterWhere(['like', 'precio_unitario', $this->precio_unitario])
            ->andFilterWhere(['like', 'precio_total', $this->precio_total]);

        return $dataProvider;
    }
}
