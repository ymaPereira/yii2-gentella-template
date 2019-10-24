	
<?php
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;

	$this->title = 'SGAO';
?>

<div class="login-box" style="width: 400px;">
      <div class="login-logo">
		    <p><?=Html::img(\Yii::$app->request->baseUrl.'/images/logo/logo.png',['class'=>'img-circle','alt'=>'SGAO']);?></p>
        <span style="font-size:15px;"><b>Sistema de Gestão e Automatização de Oficina - SGAO</b></span>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
          <div class="form-group has-feedback">
           <?= $form->field($model, 'username',['template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>{error}'])->textInput(['placeholder'=>'Nome utilizador ou email','autofocus' => true]) ?>
		      </div>
          <div class="form-group has-feedback">
            <?= $form->field($model, 'password',['template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}'])->passwordInput(['placeholder'=>'Senha','maxlength'=>30]) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
			         <?= $form->field($model, 'rememberMe')->checkbox()?>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </div><!-- /.col -->
          </div>
        <?php ActiveForm::end(); ?>
      </div><!-- /.login-box-body -->
	  <div class="box-footer" style="text-align:center;">
  		<p class="box-msg">
  			<strong>Copyright &copy; <?=date('Y')?> <a href="#" title="">Emanuel Pereira</a>.</strong> All rights reserved.
  		</p>
	  </div>
</div>
