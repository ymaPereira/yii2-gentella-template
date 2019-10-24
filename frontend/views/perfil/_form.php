<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['enableAjaxValidation'=>true]); ?>
<div class="perfil-form">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' Perfil' ?></h3>
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model,'role_pai')->widget(Select2::classname(),[
                            'data' => $role_pai,
                            'maintainOrder' => true,
                            'toggleAllSettings' => [
                                'selectOptions' => ['class' => 'text-success'],
                                'unselectOptions' => ['class' => 'text-danger'],
                            ],
                            'options' => ['placeholder' => 'Selecionar Perfil Pai', 'multiple' => false,'prompt'=>'--- Selecionar Perfil Pai ---',],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 100
                            ]
                        ])->label('Perfil Pai'); 
                    ?> 
                </div>
                <div class="col-md-6">
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
                    ]);?> 
                   <div class="form-group field-menu-menu_principal">
                        <label class="control-label" for="menu_principal">&nbsp;</label>
                        <?= $form->field($model, 'status')->checkbox() ?>
                        <div class="help-block"></div>
                    </div>

                </div>  
            </div>
            <div class="box-footer">
            </div>
            <div class="hidden">
              <?= $form->field($model,'type')->textInput(['type'=>'number','value'=>1]);?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>