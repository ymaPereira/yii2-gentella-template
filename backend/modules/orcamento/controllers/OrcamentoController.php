<?php
namespace backend\modules\orcamento\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\modules\orcamento\models\Orcamento;

/**
 * Site controller
 */
class OrcamentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Orcamento;
        return $this->render('index',['model'=>$model]);
    }

    public function actionOrcamento_imprimir()
    {
        $model = new Orcamento;
        return $this->render('orcamento_imprimir',['model'=>$model]);
    }

    
}
