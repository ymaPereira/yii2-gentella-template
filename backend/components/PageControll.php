<?php 
namespace backend\components;

class PageControll extends \yii\base\Behavior{
	
	public function events(){
		return [
			\yii\web\Application::EVENT_BEFORE_REQUEST =>'controlPage',
		];
	}

	public function controlPage(){
		$exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if(\Yii::$app->user->isGuest){
                return \Yii::$app->runAction('site/login');
            }
            return \Yii::$app->runAction('site/index');
        }
	}
}
?>