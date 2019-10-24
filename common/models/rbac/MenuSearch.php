<?php

namespace app\modules\core\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\core\models\Menu;

/**
 * MenuSearch represents the model behind the search form about `app\modules\core\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'self_id', 'orden', 'status', 'menu_principal'], 'integer'],
            [['descricao', 'page'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        
        $id = Empresa::idEmpresa()===1?null:Empresa::idEmpresa();
        $query = Menu::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->innerJoinWith('permission0')
            ->andFilterWhere([
                'id' => $this->id,
                'self_id' => $this->self_id,
                'orden' => $this->orden,
                'status' => $this->status,
                'menu_principal' => $this->menu_principal,
                Menu::tableName().'.empresa_fk'=>$id,
            ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'page', $this->page]);

        return $dataProvider;
    }
}
