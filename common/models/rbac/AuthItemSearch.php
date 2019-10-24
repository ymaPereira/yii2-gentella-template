<?php

namespace app\modules\core\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\core\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form about `app\modules\core\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data','empresa_fk'], 'safe'],
            [['type', 'created_at', 'updated_at'], 'integer'],
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
    //Para perfil
   public function search($params, $flag=0,$perfil=null)
    {
        $id = Empresa::idEmpresa()===1?null:Empresa::idEmpresa();
        $query = AuthItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);
        $this->load($params);

        
        if($flag==1){
            $query->innerJoinWith(['authItemChildren0','empresaFk','authItemChildren0'])
                  ->andFilterWhere([
                        'type' => $this->type,
                        'parent'=>$perfil,
                    ]);
        }elseif($flag==2){//Permissoes que não estao adicionado ao perfil
            if(Yii::$app->user->identity->id!=1){
                $query->innerJoinWith('authItemChildren0')->where(['type'=>2, 'parent'=>Yii::$app->session->get('role')]);
            }
            $query->andWhere('type=2 and name not in (select child from '.AuthItemChild::tableName().'  
                    where parent=:_p)',['_p'=>$perfil]);
            $query->andFilterWhere(['like', 'name', $this->name])
                  ->andFilterWhere(['like', 'description', $this->description]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }

        
        $query->andFilterWhere(['like', 'nome', $this->empresa_fk])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
    
    
    public function search_($params,$type,$flag=null,$user=null)
    {
        $id = Empresa::idEmpresa()===1?null:Empresa::idEmpresa();
        $query = AuthItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if($flag==1 && !empty($user)){//Com perfil
            $query->innerJoinWith('authAssignments')->andFilterWhere(['user_id'=>$user]);
        }elseif($flag==2 && !empty($user)){//sem perfil
            $roles = Yii::$app->authManager->getRolesByUser($user);
            foreach ($roles as $key => $obj) {
                $role[] = $obj->name;
            }
            if(!empty($roles)){
                $query->where(['not in','name',$role])->andFilterWhere(['type'=>$type]);
            }
        }

        $query->innerJoinWith(['empresaFk'])->andFilterWhere([
            'type' => $type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'empresa_fk'=>$id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'nome', $this->empresa_fk]);

        return $dataProvider;
    }
}
