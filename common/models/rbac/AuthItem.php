<?php

namespace app\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{
    public $permission;
    public $permission2;
    public $role_pai;
    public $flag;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'type','empresa_fk'], 'required','on'=>'perfil'],
            [['name', 'type','empresa_fk'], 'required','on'=>'pagina'],
            [['type', 'created_at', 'updated_at','flag','status','empresa_fk'], 'integer'],
            [['description', 'data','role_pai'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
            [['name','empresa_fk'],'validateUnique'],
            [['empresa_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_fk' => 'id']],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['perfil'] = ['description', 'type','name','rule_name','created_at','updated_at','flag','status','role_pai','data','empresa_fk'];
        $scenarios['pagina'] = ['description', 'type','name','rule_name','created_at','updated_at','flag','status','role_pai','data','empresa_fk'];
        return $scenarios;
    }
    public function validateUnique($attribute){
        if($this->scenario == 'perfil'){
            $this->name = strtolower(\yii\helpers\Inflector::camelize($this->description).'_'.$this->empresa_fk);
            if(self::findOne(['name'=>$this->name,'empresa_fk'=>$this->empresa_fk])!=null && $this->isNewRecord){
                $this->addError($attribute,'Esta atribuição já foi efetuada');
            }
        }elseif($this->scenario == 'pagina'){
            if(self::findOne(['name'=>$this->name,'empresa_fk'=>$this->empresa_fk])!=null && $this->isNewRecord){
                $this->addError($attribute,'Esta atribuição já foi efetuada');
            }
        }
        
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->scenario == 'perfil'){
                $this->name = strtolower(\yii\helpers\Inflector::camelize($this->description).'_'.$this->empresa_fk);
            }
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'type' => 'Type',
            'description' => 'Descrição',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'empresa_fk' => 'Empresa',
            'status' => 'Ativo?',
        ];
    }

    public function mapRolePai(){
        $id = Empresa::idEmpresa()===1?null:Empresa::idEmpresa();
        if(empty($this->name))
            $query = self::find()->innerJoinWith('empresaFk')->where(['type'=>1])->andFilterWhere(['empresa_fk'=>$id])->all();
        if(!empty($this->name))
            $query = self::find()->innerJoinWith('empresaFk')->where(['type'=>1])->andWhere(['<>','name',$this->name])->andFilterWhere(['empresa_fk'=>$id])->all();
        return \yii\helpers\ArrayHelper::map($query,'name','description');
    }

    public function getPermission($type=2){
        $id = Empresa::idEmpresa()===1?null:Empresa::idEmpresa();
        $query = self::find()->innerJoinWith('empresaFk')->where(['type'=>$type])->andFilterWhere(['empresa_fk'=>$id])->all();
        return \yii\helpers\ArrayHelper::map($query,'name',function($query){ return $query->empresaFk->nome.' - '.$query->description;});
    }

    public function getPages(){
        $query = self::find()->where(['type'=>2]);
        if(Yii::$app->user->identity->id != 1)
        {
          $query = self::find()->innerJoinWith(['authItemChildren0'])->where(['type'=>2, 'parent'=>Yii::$app->session->get('role')]);
        }
        
        $query = $query->all();
        return \yii\helpers\ArrayHelper::map($query,'name','name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('tbl_auth_item_child', ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'parent'])->viaTable('tbl_auth_item_child', ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaFk()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_fk']);
    }
    /**
     * @inheritdoc
     * @return AuthItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthItemQuery(get_called_class());
    }

    public function afterSave($insert,$changedAttributes){
        if($this->scenario == 'perfil'){
            \Yii::$app->user_log->save("Regsito de perfil ".$this->description,self::tableName());
        }elseif($this->scenario == 'pagina'){
            \Yii::$app->user_log->save("Registo de página ".$this->description,self::tableName());
        }
    }
}
