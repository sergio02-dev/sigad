<?php

   $codigo_poai = $_REQUEST['codigo_poai'];
   $codigo_accion = $_REQUEST['codigo_accion'];   
  
   
   include('crud/rs/pln_cmpras/pln_cmpras.php');

   $datos_etapa = $objPlanCompras->datos_etapa($codigo_poai);

   $codigo_sede = $objPlanCompras->etapas_actividad_sede($codigo_poai);

   $list_plan_cmpras = $objPlanCompras->list_plan_cmpras($codigo_accion, $codigo_sede);
   
    $url_guardar="modificarplancompras";
    $codigo_formulario = $codigo_poai;
    $tarea = "AGREGAR";
    $checkedA="checked";
    $checkedI="";
    $valor_uni = 0;
    $cantidad = 0;
?>
<style>
    .fuente_input_tabla{
        font-size: 12px;
    }

    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

</style>
<form id="editarplancompraform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title"><strong><?php echo $tarea; ?> PLAN DE COMPRAS</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 113%;"><?php echo $datos_etapa; ?></p>
                
                
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-sm fuente_input_tabla">
                    <tr>
                        <th style="width: 3% "></th>
                        <th style="width : 4%" > Sede</th>
                        <th style="width: 23% ">Dependencia</th>
                        <th style="width: 12% ">Area</th>
                        <th style="width: 10% ">Planta fisica</th>
                        <th style="width: 15% ">Caracteristica</th>
                        <th style= "width: 10%"> Cantidad </th>
                        <th style="width: 10% ">Valor unitario</th>
                        <th style="width: 13% ">Valor total</th>
                       
                    <?php
                        if($list_plan_cmpras){
                            $num_datos = count($list_plan_cmpras);
                            $num = 1;
                            foreach($list_plan_cmpras as $dta_list_plan_cmpras){
                                $pco_codigo = $dta_list_plan_cmpras['pco_codigo'];
                                $pco_etapa = $dta_list_plan_cmpras['pco_etapa'];
                                $pdi_sede = $dta_list_plan_cmpras['pdi_sede'];
                                $pdi_dependencia = $dta_list_plan_cmpras['pdi_dependencia'];
                                $pdi_area = $dta_list_plan_cmpras['pdi_area'];
                                $pdi_plantafisica = $dta_list_plan_cmpras['pdi_plantafisica'];
                                $pdi_equipodescripcion = $dta_list_plan_cmpras['pdi_equipodescripcion']; 
                                $pdi_cantidad = $dta_list_plan_cmpras['pdi_cantidad'];
                                $pdi_valorunitario = $dta_list_plan_cmpras['pdi_valorunitario'];

                                $nombre_sede = $objPlanCompras->nombre_sede($pdi_sede);
                                $nombre_dependencia = $objPlanCompras->nombre_dependencia($pdi_dependencia);
                                $nombre_area = $objPlanCompras->nombre_area($pdi_area);
                                $nombre_descripcionEquipo = $objPlanCompras->nombre_descripcionEquipo($pdi_equipodescripcion);
                                $valor = $pdi_cantidad * $pdi_valorunitario;
                    ?>
                    <tr>   
                        <td> <input  name="fuente[]" type="checkbox"  data-rule-required="true" required ></td>
                        <td><?php echo $nombre_sede; ?></td>    
                        <td>
                            
                            <?php echo $nombre_dependencia; ?>
                        </td>
                        <td>
                            
                            <?php echo $nombre_area; ?>
                        </td>
                        <td>
                            
                            <?php echo $pdi_plantafisica; ?>
                        </td>
                        <td>
                            <?php echo $nombre_descripcionEquipo; ?>
                        </td>
                        <td>
                           <?php echo $pdi_cantidad;?>
                        </td>
                        <td>
                          <?php echo number_format($pdi_valorunitario,0,'','.'); ?>
                        </td>
                        <td>
                            $ <span id="valorFinal<?php echo $num; ?>"><?php echo number_format($valor,0,'','.'); ?></span>
                        </td>
                    
                    </tr>
                    <script type="text/javascript">

                        $("#txtValorUnitario<?php echo $num; ?>").on({
                            "focus": function (event) {
                                $(event.target).select();
                            },
                            "keyup": function (event) {
                                $(event.target).val(function (index, value ) {
                                    return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                                });
                            }
                        });

                        function numberWithCommas(formatoNumero) {
                            return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }

                        $('.sma<?php echo $num; ?>').change(function(){
                            var undades = $('#txtCantidad<?php echo $num; ?>').val();
                            var str= $('#txtValorUnitario<?php echo $num; ?>').val();
                            var valor_unidades = 0;

                            valor_unidades = str.toString().replace(/\./g,'');
        
                            var total = undades * valor_unidades;

                            $('#valorFinal<?php echo $num; ?>').html(numberWithCommas(total));
                        });

                    </script>
                    <?php
                                $num++;
                                
                            }
                        }
                    ?>
                </table>
            </div>
        </div>

    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="num_datos" id="num_datos" value="<?php echo $num_datos; ?>">
        <input type="hidden" name="codigo_formulario" id="codigo_formulario" value="<?php echo $codigo_formulario; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php
            if($num_datos>0){
        ?>
        <button type="submit" class="btn btn-danger" onClick="validar_plancompras();"><i class="far fa-save"></i> Guardar</button>
        <?php
            }
        ?>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_edtar_pln_cmpras.js"></script>
