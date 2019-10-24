<?php

namespace app\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_menu".
 *
 * @property integer $id
 * @property string $descricao
 * @property integer $self_id
 * @property integer $orden
 * @property integer $status
 * @property integer $menu_principal
 * @property string $permission
 *
 * @property Menu $self
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_fk','page','id_entidade'], 'required','on'=>'save_ent_menu'],
            [['descricao','empresa_fk',], 'required','on'=>'save_normal_menu'],
            [['self_id', 'orden', 'status', 'menu_principal','empresa_fk','id_entidade'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
            [['page'], 'string', 'max' => 64],
            ['page','validatePermission'],
            [['empresa_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_fk' => 'id']],
            [['self_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['self_id' => 'id']],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['save_normal_menu'] = ['empresa_fk','page','descricao','status','self_id','orden','menu_principal'];
        $scenarios['save_ent_menu'] = ['empresa_fk','page','id_entidade','descricao','status','self_id','orden'];
        return $scenarios;
    }

    public function validatePermission($attribute,$params){
        if(empty($this->page) && $this->menu_principal==0){
            $this->addError($attribute,'A Página não pode ficar em branco');
        }
    }


    public function getMenuPai(){
        if(empty($this->id))
            $query = self::find()->where(['menu_principal'=>1])->all();
        if(!empty($this->id))
            $query = self::find()->where(['menu_principal'=>1])->andWhere(['<>','id',$this->id])->all();
        return \yii\helpers\ArrayHelper::map($query,'id','descricao');
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
            'self_id' => 'Menu Pai',
            'orden' => 'Orden',
            'status' => 'Ativo?',
            'menu_principal' => 'Menu Principal?',
            'page'=>'Página',
            'empresa_fk'=>'Empresa',
            'id_entidade'=>'Entidade'
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->page=='')
                $this->page = null;
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelf()
    {
        return $this->hasOne(Menu::className(), ['id' => 'self_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['self_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission0()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'page']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaFk()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_fk']);
    }
     public function afterSave($insert,$changedAttributes){
        \Yii::$app->user_log->save("Registo de menu ".$this->descricao,self::tableName());
    }
}
