<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>
<?php $form = ActiveForm::begin(['enableAjaxValidation'=>true]); ?>
<div class="perfil-form">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' Página' ?></h3>
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'exemplo: menu/index']) ?>
                   <div class="form-group field-menu-status">
                        <label class="control-label" for="status">&nbsp;</label>
                        <?= $form->field($model, 'status')->checkbox() ?>
                        <div class="help-block"></div>
                    </div>
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

                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </div>    
            </div>
            <div class="box-footer">
            </div>
            <div class="hidden">
              <?= $form->field($model,'type')->textInput(['type'=>'number','value'=>2]);?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>