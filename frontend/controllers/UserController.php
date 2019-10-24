<?php

namespace app\modules\core\controllers;

use Yii;
use common\models\User;
use app\modules\core\models\UserSearch;
use app\modules\core\models\Empresa;
use app\modules\core\models\Agencia;
use app\modules\core\models\AuthItemSearch;
use app\modules\core\models\AuthItem;
use app\modules\core\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'roles' => ['user/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['user/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['user/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['user/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['user/view'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['permission'],
                        'roles' => ['user/permission'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['perfil'],
                        'roles' => ['user/perfil'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update-password'],
                        'roles' => ['user/update-password'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $auth = new AuthItem;
        $agencia = new Agencia;
        $permission = $auth->getPermission(1);
        $model = new User();
        $model->scenario = 'save_user';
        $model->status = 1;
        $agencias = $agencia->getAgencias();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($model->permission as $key => $value) {
                if(AuthItem::findOne($value)!=null){
                    $role=\Yii::$app->authManager->getRole($value);
                    \Yii::$app->authManager->assign($role,$model->id);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'permission'=>$permission,'value'=>[],'agencias'=>$agencias
            ]);
        }
    }

    //Atribuir perfil a user
    public function actionPerfil($id){
        $model = $this->findModel($id);
        
        $flag=\Yii::$app->request->post('flag',null);
        $permission=\Yii::$app->request->post('selection',null);
        
        if($flag==1 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $role=\Yii::$app->authManager->getRole(json_decode($obj)->name);
                \Yii::$app->authManager->revoke($role,$id);
            }
        }elseif($flag==2 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $role=\Yii::$app->authManager->getRole(json_decode($obj)->name);
                \Yii::$app->authManager->assign($role,$id);
            }
        }
        $searchModel1 = new AuthItemSearch;
        $dataProvider1 = $searchModel1->search_(Yii::$app->request->queryParams, 1, 1, $id);

        $searchModel2 = new AuthItemSearch;
        $dataProvider2 = $searchModel2->search_(Yii::$app->request->queryParams, 1, 2, $id);

        return $this->render('add_perfil',['model'=>$model,'searchModel1'=>$searchModel1,'searchModel2'=>$searchModel2,'dataProvider1'=>$dataProvider1,'dataProvider2'=>$dataProvider2]);
    }

    //atribuir permissao a user
    public function actionPermission($id){
        $model = $this->findModel($id);
       
        $flag=\Yii::$app->request->post('flag',null);
        $permission=\Yii::$app->request->post('selection',null);
        
        if($flag==1 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $p=\Yii::$app->authManager->getPermission(json_decode($obj)->name);
                \Yii::$app->authManager->revoke($p,$id);
            }
        }elseif($flag==2 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $p=\Yii::$app->authManager->getPermission(json_decode($obj)->name);
                \Yii::$app->authManager->assign($p,$id);
            }
        }
        $searchModel1 = new AuthItemSearch;
        $dataProvider1 = $searchModel1->search_(Yii::$app->request->queryParams, 2, 1, $id);

        $searchModel2 = new AuthItemSearch;
        $dataProvider2 = $searchModel2->search_(Yii::$app->request->queryParams, 2, 2, $id);

        return $this->render('add_perfil',['model'=>$model,'searchModel1'=>$searchModel1,'searchModel2'=>$searchModel2,'dataProvider1'=>$dataProvider1,'dataProvider2'=>$dataProvider2]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $auth = new AuthItem;
        $agencia = new Agencia;
        $permission = $auth->getPermission(1);
        $model = $this->findModel($id);
        $model->scenario = 'save_user';
        $model->password_hash = null;
        $agencias = $agencia->getAgencias();
        $value = \yii\helpers\ArrayHelper::map(\Yii::$app->authManager->getRolesByUser($id),'name','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->authManager->revokeAll($id);
            foreach ($model->permission  as $key => $value) {
                if(AuthItem::findOne($value)!=null){
                    $role=\Yii::$app->authManager->getRole($value);
                    \Yii::$app->authManager->assign($role,$model->id);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,'permission'=>$permission,'value'=>$value,'agencias'=>$agencias
            ]);
        }
    }

    public function actionUpdatePassword(){
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'alter_pw';
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model_ = $this->findModel(Yii::$app->user->identity->id);
            $model_->password_hash = $model->password_hash_new;
            $model_->save();
            \Yii::$app->user_log->save("Alteração de password","tbl_utilizador");
            return $this->redirect(['/site/perfil']);
        }else{
            return $this->redirect(['/site/perfil','error'=>'<div class="alert alert-error">Password inválido</div>']);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
