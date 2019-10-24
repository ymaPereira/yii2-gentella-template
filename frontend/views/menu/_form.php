<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="menu-form">
	<div class="box box-primary">
	    <div class="box-header with-border">
	      <h3 class="box-title"><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' Menu' ?></h3>
	    </div><!-- /.box-header -->
	    
	    <div class="box-body">
            <div class="row">
            	<div class="col-md-6">
				    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
					<?= $form->field($model,'self_id')->widget(Select2::classname(),[
						    'data' => $self_id,
						    'maintainOrder' => true,
						    'toggleAllSettings' => [
						        'selectOptions' => ['class' => 'text-success'],
						        'unselectOptions' => ['class' => 'text-danger'],
						    ],
						    'options' => ['placeholder' => 'Selecionar Menu Pai', 'multiple' => false],
						    'pluginOptions' => [
						        'tags' => true,
						        'maximumInputLength' => 100
						    ]
						]); 
					?> 
                    <?= $form->field($model, 'orden')->textInput() ?>
                </div>
                <div class="col-md-6">

                	<?= $form->field($model,'page')->widget(Select2::classname(),[
						    'data' => $permission,
						    'maintainOrder' => true,
						    'toggleAllSettings' => [
						        'selectOptions' => ['class' => 'text-success'],
						        'unselectOptions' => ['class' => 'text-danger'],
						    ],
						    'options' => ['placeholder' => 'Selecionar Página', 'multiple' => false],
						    'pluginOptions' => [
						        'tags' => true,
						        'maximumInputLength' => 100
						    ]
						]); 
					?>
					<?= $form->field($model,'empresa_fk')->widget(Select2::classname(),[
						    'data' => $empresas,
						    'maintainOrder' => true,
						    'toggleAllSettings' => [
						        'selectOptions' => ['class' => 'text-success'],
						        'unselectOptions' => ['class' => 'text-danger'],
						    ],
						    'options' => ['placeholder' => 'Selecionar Empresa', 'multiple' => false],
						    'pluginOptions' => [
						        'tags' => true,
						        'maximumInputLength' => 100
						    ]
						]); 
					?> 
                   <div class="form-group field-menu-status">
	                    <label class="control-label" for="status">&nbsp;</label>
						<?= $form->field($model, 'status')->checkbox() ?>
						<div class="help-block"></div>
					</div>

                   <div class="form-group field-menu-menu_principal">
	                    <label class="control-label" for="menu_principal">&nbsp;</label>
                    	<?= $form->field($model, 'menu_principal')->checkbox() ?>
						<div class="help-block"></div>
					</div>

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