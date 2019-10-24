	
	
	<?php
		use yii\helpers\Html;
		use kartik\detail\DetailView;
		use yii\widgets\ActiveForm;

		/* @var $this yii\web\View */
		/* @var $model app\modules\sgi\models\User */

		$this->title = 'Meu Perfil';
		$this->params['breadcrumbs'][] = $model->username;
	?>
	
          <div class="row">
            <div class="col-md-4">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
               <?php 
					echo \yii\helpers\Html::img(\Yii::$app->request->baseUrl.'/images/icons/no-image.png',[
							'class'=>'profile-user-img img-responsive img-circle',
							]);
				?>	
				 <h3 class="profile-username text-center">Nina Mcintire</h3>
                  <p class="text-muted text-center">Software Engineer</p>

                  <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
                      <b>Estado</b> <a class="pull-right">13,287</a>
                    </li>
                    <li class="list-group-item">
                      <b>Último Login</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Criado em</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                      <b>Perfil </b> <a class="pull-right">administrador / secretarioUnidade</a>
                    </li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
			<div class="col-md-8">
			
				<div class="box box-primary">
				
				<div class="box-header with-border">
				  <h3 class="box-title">Infomações do Login</h3>
				</div>
				
                <div class="box-body">
				
					<?php
					//yii\widgets\Pjax::begin();
						echo DetailView::widget([
							'model'=>$model,
							'condensed'=>true,
							'hover'=>true,
							'mode'=>DetailView::MODE_VIEW,
							'buttons1'=>'{update}',
							'alertMessageSettings'=>[
								'kv-detail-error' => 'alert alert-danger',
								'kv-detail-success' => 'alert alert-success',
								'kv-detail-info' => 'alert alert-info',
								'kv-detail-warning' => 'alert alert-warning'
							],
							'panel'=>[
								'heading'=>'Utilizador ',
								'type'=>DetailView::TYPE_INFO,
							],
							'formOptions'=>['options'=>['data-pjax'=>1]],
							'attributes'=>[
								'username',
								[
									'attribute'=>'password',
									'value'=>$model->password_hash,
								],
								'email:email',
							]
						]);
						
					//yii\widgets\Pjax::end();
					?>
				
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			
			</div>
          </div><!-- /.row -->