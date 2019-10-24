<?php

namespace app\modules\core\controllers;

use Yii;
use app\modules\core\models\AuthItem;
use app\modules\core\models\Empresa;
use app\modules\core\models\Agencia;
use app\modules\core\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PerfilController implements the CRUD actions for AuthItem model.
 */
class PerfilController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['perfil/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['perfil/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['perfil/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['perfil/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['perfil/view'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search_(Yii::$app->request->queryParams,1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($name)
    {

        $model=$this->findModel($name);
                
        $flag=\Yii::$app->request->post('flag',null);
        $permission=\Yii::$app->request->post('selection',null);
        $perfil=\Yii::$app->authManager->getRole($name);
        
        if($flag==1 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $aux=\Yii::$app->authManager->getPermission(json_decode($obj)->name);
                \Yii::$app->authManager->removeChild($perfil,$aux);
            }
            \Yii::$app->user_log->save("Permissões removido do perfil ".$model->description,"tbl_auth_item_child");
        }elseif($flag==2 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $aux=\Yii::$app->authManager->getPermission(json_decode($obj)->name);
                \Yii::$app->authManager->addChild($perfil,$aux);
            }
            \Yii::$app->user_log->save("Permissões atribuido ao perfil ".$model->description,"tbl_auth_item_child");
        }
        $searchModel1 = new AuthItemSearch;
        $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams, 1,$name);
        
        $searchModel2 = new AuthItemSearch;
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, 2, $name);
        
        
        return $this->render('view', [
            'model' => $model,'searchModel1'=>$searchModel1,'dataProvider1'=>$dataProvider1,
            'searchModel2'=>$searchModel2,'dataProvider2'=>$dataProvider2,
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $empresa = new Empresa;
        $empresas = $empresa->getEmpresas();
        $model = new AuthItem();
        $model->scenario = 'perfil';
        $role_pai = $model->mapRolePai();
        $model->status = 1;
        if(\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
            \Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $auth=\Yii::$app->authManager;
             $role=$auth->createRole($model->name);
             $role->description=$model->description;
             $role->empresa_fk = $model->empresa_fk;
             $role->status = $model->status;
             $auth->add($role);

             if(!empty($model->role_pai)){
                $role_ = $auth->getRole($model->role_pai);
                $auth->addChild($role_,$role);
             }
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,'role_pai'=>$role_pai,'empresas'=>$empresas,'agencias'=>[]
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $empresa = new Empresa;
        $empresas = $empresa->getEmpresas();
        $ag = new Agencia;
        $agencias = $ag->getAgencias();
        $model = $this->findModel($name);
        $model->scenario = 'perfil';
        $role_ = isset($model->parents[0]->name)?($model->parents[0]->name):null;
        if(\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
            \Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        $role_pai = $model->mapRolePai();
        $model->role_pai = $role_;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth=\Yii::$app->authManager;
            $role=$auth->createRole($model->name);
            $role->name = $model->name;
            $role->description=$model->description;
            $role->empresa_fk = $model->empresa_fk;
            $role->status = $model->status;
            if(empty($model->role_pai) && !empty($role_)){
                $role_ = $auth->getRole($role_);
                $auth->removeChild($role_,$role);
            }elseif(!empty($model->role_pai)){
                $role_ = $auth->getRole($model->role_pai);
                $auth->addChild($role_,$role);
            }

            $auth->update($name,$role);
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,'role_pai'=>$role_pai,'empresas'=>$empresas,'agencias'=>$agencias
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
