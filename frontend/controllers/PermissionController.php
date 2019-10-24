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
 * PermissionController implements the CRUD actions for AuthItem model.
 */
class PermissionController extends Controller
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
                        'roles' => ['permission/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['permission/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['permission/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['permission/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['permission/view'],
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
        $dataProvider = $searchModel->search_(Yii::$app->request->queryParams,2);

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
        
        return $this->render('view', [
            'model' => $model
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
        $model->scenario = 'pagina';
        $model->status = 1;
        if(\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
            \Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $auth=\Yii::$app->authManager;
             $permission=$auth->createPermission($model->name);
             $permission->description=$model->description;
             $permission->empresa_fk = $model->empresa_fk;
             $permission->status = $model->status;
             $auth->add($permission);
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,'empresas'=>$empresas,'agencias'=>[],
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
        $model->scenario = 'pagina';
        $role_pai = $model->mapRolePai();

        if(\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
            \Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth=\Yii::$app->authManager;
            $permission=$auth->createPermission($model->name);
            $permission->description=$model->description;
            $permission->empresa_fk = $model->empresa_fk;
            $permission->status = $model->status;
            $auth->update($name,$permission);
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,'role_pai'=>$role_pai,'empresas'=>$empresas,'agencias'=>$agencias,
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
