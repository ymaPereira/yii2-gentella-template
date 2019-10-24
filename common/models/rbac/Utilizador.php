<?php

namespace app\modules\core\models;

use Yii;

/**
 * This is the model class for table "{{%utilizador}}".
 *
 * @property integer $id
 * @property string $nome
 * @property string $email
 * @property string $password_hash
 * @property string $username
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Cobranca[] $cobrancas
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%utilizador}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'password_hash', 'username', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at','agencia_fk'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['email', 'username'], 'string', 'max' => 80],
            [['password_hash'], 'string', 'max' => 65],
            [['password_reset_token', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'username' => 'Username',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'agencia_fk'=>'Agência',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCobrancas()
    {
        return $this->hasMany(Cobranca::className(), ['id_user' => 'id']);
    }
}
