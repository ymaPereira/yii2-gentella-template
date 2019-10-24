<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
?>
<div class="row">
  <div class="col-md-12">
  	<div class="x_panel" style="">
  		<div class="form-group">
            <div class="col-md-4 col-md-offset-10">
              <?= Html::a('Gravar   ','index.php?r=orcamento/orcamento/orcamento_imprimir',['class'=>'btn btn-primary'])?>
            <?= Html::a('Cancelar','#',['class'=>'btn btn-danger'])?>
            </div>
        </div>
    </div>
	<div class="x_panel" style="">
			<div class="x_title">
                <h3>Novo Orçamento</h3>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
               
                 <?php $form = ActiveForm::begin([
                          'options' => [
                              'id' => 'demo-form2',
                              'class' => 'form-horizontal form-label-left'
                          ]
                        ]); ?> 

				  <h2>Dados Gerais </h2>
				  <div class="well" style="overflow: auto">
                  	<div class="col-md-4">
        			    <div class="form-group">
					    	<label class="control-label" for="cliente">Cliente<span class="required">*</span>
		                    </label>
			        		<div class="">	        			
							    <?= $form->field($model, 'cliente')->dropDownList([],['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
							</div>
						</div>				
                  	</div>
             
                  	<div class="col-md-4">
                        <div class="form-group">
			                <label class="control-label" for="data">Data Validade<span class="required">*</span>
			                    </label>
			                <div class="">
			                    <?= 
			                    DatePicker::widget([
			                        'model' => $model,
			                        'name' => 'data', 
			                        'value' => '',
			                        'options' => ['placeholder' => 'selecionar data validade'],
			                        'pluginOptions' => [
			                            'format' => 'dd-MM-yyyy',
			                            'todayHighlight' => true
			                        ]
			                    ]);
			                    ?>
			                </div>
	            		</div>
                  	</div>

                  	<div class="col-md-12">
                  		<div class="form-group">
					    	<label class="control-label" for="desc">Descrição<span class="required">*</span>
		                    </label>
			        		<div class="">	        			
							    <?= $form->field($model, 'desc')->textArea(['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
							</div>
						</div>				
                  	</div>
               </div>
	
                <div class="clearfix"></div>
				<h2>Produtos </h2>
				<div class="well" style="overflow: auto">
					<?= $form->field($model,'itens')->widget(MultipleInput::className(),[
                            'max' => 50,
                            'cloneButton' => true,
                            'columns' => [
                                [                                    
                                    'type'  => Select2::classname(),
                                    'name'  => 'produto',
                                    'title' => 'Produtos',                                    
                                    'options' => [
                                      'data' => null,
                                      'pluginOptions' => [
                                          'allowClear' => true
                                      ],                                    
                                     ], 
                                      
                                                                        
                                ],
                                [
                                    'name'  => 'quantidade',
                                    'title' => 'Quantidade',
                                    'defaultValue' => 1,
                                    'enableError' => true,
                                    'options' => [
                                        'type' => 'number',
                                        'class' => 'input-priority',
                                    ]
                                ],
                                [
                                  	'name'  => 'valor',
                                  	'title' => 'Valor',
	                                'defaultValue' => 1,
	                                'enableError' => true,
                                  	'options' => [
                                      'type' => 'number',
                                      'class' => 'input-priority',
                                    ]
                                ],
                                [
                                  'name'  => 'valor',
                                  'title' => 'Valor',
                                  'options' => [
                                      'type' => 'number',
                                      'class' => 'input-priority',
                                    ]
                                ],
                                [                                    
                                    'type'  => Select2::classname(),
                                    'name'  => 'desconto',
                                    'title' => 'Descontos',                                    
                                    'options' => [
                                      'data' => null,
                                      'pluginOptions' => [
                                          'allowClear' => true
                                      ],                                    
                                     ],                                    
                                ], 
                                 [
                                  'name'  => 'subtotal',
                                  'title' => 'Subtotal',
                                  'options' => [
                                      'type' => 'number',
                                    ]
                                ],
                            ]
                        ])->label(false);
                      ?>  
				</div> 

                <div class="clearfix"></div>
				<h2>Serviços </h2>
				<div class="well" style="overflow: auto">
					<?= $form->field($model,'itens')->widget(MultipleInput::className(),[
                            'max' => 50,
                            'cloneButton' => true,
                            'columns' => [
                                [                                    
                                    'type'  => Select2::classname(),
                                    'name'  => 'servico',
                                    'title' => 'Serviços',                                    
                                    'options' => [
                                      'data' => null,
                                      'pluginOptions' => [
                                          'allowClear' => true
                                      ],                                    
                                     ], 
                                      
                                                                        
                                ],
                                [
                                    'name'  => 'quantidade',
                                    'title' => 'Quantidade',
                                    'defaultValue' => 1,
                                    'enableError' => true,
                                    'options' => [
                                        'type' => 'number',
                                        'class' => 'input-priority',
                                    ]
                                ],
                                [
                                  	'name'  => 'valor',
                                  	'title' => 'Valor',
	                                'defaultValue' => 1,
	                                'enableError' => true,
                                  	'options' => [
                                      'type' => 'number',
                                      'class' => 'input-priority',
                                    ]
                                ],
                                [
                                  'name'  => 'valor',
                                  'title' => 'Valor',
                                  'options' => [
                                      'type' => 'number',
                                      'class' => 'input-priority',
                                    ]
                                ],
                                [                                    
                                    'type'  => Select2::classname(),
                                    'name'  => 'desconto',
                                    'title' => 'Descontos',                                    
                                    'options' => [
                                      'data' => null,
                                      'pluginOptions' => [
                                          'allowClear' => true
                                      ],                                    
                                     ],                                    
                                ], 
                                 [
                                  'name'  => 'subtotal',
                                  'title' => 'Subtotal',
                                  'options' => [
                                      'type' => 'number',
                                    ]
                                ],
                            ]
                        ])->label(false);
                      ?>  
				</div>          
                <?php ActiveForm::end(); ?>	
          	</div>
     	</div>
     	<div class="x_panel" style="">
  		<div class="form-group">
            <div class="col-md-4 col-md-offset-10">
            	<?= Html::a('Gravar   ','index.php?r=orcamento/orcamento/orcamento_imprimir',['class'=>'btn btn-primary'])?>
            <?= Html::a('Cancelar','#',['class'=>'btn btn-danger'])?>
            </div>
        </div>
    </div>
    </div>
</div>