<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="user-form">
	<div class="box box-primary">
	    <div class="box-header with-border">
	      <h3 class="box-title"><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' Utilizador' ?></h3>
	    </div><!-- /.box-header -->
	    
	    <div class="box-body">
            <div class="row">
            	<div class="col-md-6">
				    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

				    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

				    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
				</div>
            	<div class="col-md-6">
				    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-6">

			    	<?=// Various Select2 Sizes
						 $form->field($model, 'agencia_fk')->widget(Select2::className(),[
						    'data' => $agencias,
						    'maintainOrder' => true,
						    'toggleAllSettings' => [
						        'selectOptions' => ['class' => 'text-success'],
						        'unselectOptions' => ['class' => 'text-danger'],
						    ],
						    'options' => ['placeholder' => 'Selecionar Agencia', 'multiple' => false],
						    'pluginOptions' => [
						        'tags' => true,
						        'maximumInputLength' => 100
						    ]
						]); 
					?>
			    	<?=// Various Select2 Sizes
						 $form->field($model, 'permission')->widget(Select2::className(),[
						    'data' => $permission,
						    'value'=>$value,
						    'maintainOrder' => true,
						    'toggleAllSettings' => [
						        'selectOptions' => ['class' => 'text-success'],
						        'unselectOptions' => ['class' => 'text-danger'],
						    ],
						    'options' => ['placeholder' => 'Selecionar Perfil', 'multiple' => true],
						    'pluginOptions' => [
						        'tags' => true,
						        'maximumInputLength' => 100
						    ]
						]); 
					?>
				    <?= $form->field($model, 'status')->checkbox() ?>
				</div>
			</div>
			<div class="box-footer">
            </div>
		    <div class="form-group">
		        <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-default']) ?>
		    </div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>
