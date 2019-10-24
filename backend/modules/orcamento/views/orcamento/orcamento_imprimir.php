<?php
use yii\helpers\Html;
?>
<div class="x_panel" style="">
      <div class="form-group">
            <div class="col-md-4 col-md-offset-9">
              <?php 
              echo Html::a('<i class="fa fa-hand-point-up"></i> Imprimir', ['utente/report-prescricao'], [
                    'class'=>'btn btn-primary', 
                    'target'=>'_blank', 
                    'data-toggle'=>'tooltip', 
                    //'title'=>'Will open the generated PDF file in a new window'
                ]); 
                echo Html::a('<i class="fa fa-hand-point-up"></i> Enviar por email', ['utente/report-prescricao'], [
                    'class'=>'btn btn-primary', 
                    'target'=>'_blank', 
                    'data-toggle'=>'tooltip', 
                    //'title'=>'Will open the generated PDF file in a new window'
                ]);  
            ?>   
            </div>
        </div>
    </div>
<div class="page-title" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Orçamento Nº</h3>
              </div>     

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">                  
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          
                                          <small class="pull-right">Data: 16/08/2016</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row">
                        <div class="col-xs-6">
                          Identificação de Cliente
                          <address>
                                          <strong>Nome: XPTO XPTO</strong>
                                          <br>Data Nascimento: 17/08/2019
                                          <br>Endereço: Praia, Cabo Verde
                                          <br>Telefone: (+237) 1239876
                                          <br>Email: 
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 ">
                          Entidade Responsável
                          <address>
                                          <strong>TEI</strong>
                                          <br>NIF: xxxx
                                          <br>Local: Praia, chã de areia                                       
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <b>Orçamento #007612</b>
                          <br>
                          <br>                          
                          <b>Data Emissão:</b> 05/04/2019                          
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Quantidade</th>
                                <th>Produto/Serviço</th>
                                <th>Valor</th>
                                <th style="width: 59%">Desconto</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>X</td>
                                <td>4000 ECV</td>
                                <td>10%</td>
                                <td>3900 ECV</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Y</td>
                                <td>5000 ECV</td>
                                <td>10%</td>
                                <td>9800 ECV</td>
                              </tr>                             
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">                        
                        <!-- /.col -->
                        <div class="col-xs-6">                          
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>13700 ECV</td>
                                </tr>
                                <tr>
                                  <th>IVA (15%)</th>
                                  <td>2000 ECV</td>
                                </tr>
                                <tr>
                                  <th>Transporte:</th>
                                  <td>1000 ECV</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>16700 ECV</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>