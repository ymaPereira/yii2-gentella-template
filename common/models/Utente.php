<?php

namespace common\models;

use yii\base\Model;

class Utente extends Model
{
    public $NumeroSNS;
    public $NomeCompleto;
    public $DataNascimento;
    public $Contacto;
    public $PaisNacionalidade;
    public $Sexo;
    public $PaisNaturalidade;
    /*Necessario enviar o Id?? */
    //public $id; 


    public function rules()
    {
        return [         
            [['NumeroSNS'], 'required'],           
        ];
    }

    public function attributeLabels()
    {
        return [
            'NumeroSNS' => 'Numero SNS',            
        ];
    }
}