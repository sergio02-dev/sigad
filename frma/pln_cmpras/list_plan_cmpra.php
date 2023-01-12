<?php

   $codigo_poai = $_REQUEST['codigo_poai'];
   $codigo_accion = $_REQUEST['codigo_accion'];   
   
   include('crud/rs/pln_cmpras/pln_cmpras.php');

   $datos_etapa = $objPlanCompras->datos_etapa($codigo_poai);

   $list_plan_cmpras = $objPlanCompras->list_plan_cmpras($codigo_poai);

    $url_guardar="modificarplancompras";
    $codigo_formulario = $codigo_poai;
    $tarea = "MODIFICAR";
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
                        <th style="width: 3% ">No</th>
                        <th style="width: 27% ">Dependencia</th>
                        <th style="width: 12% ">Area</th>
                        <th style="width: 25% ">Caracteristica</th>
                        <th style= "width: 10%"> Cantidad </th>
                        <th style="width: 10% ">Valor unitario</th>
                        <th style="width: 13% ">Valor total</th>
                    </tr>
                    <?php
                        if($list_plan_cmpras){
                            $num_datos = count($list_plan_cmpras);
                            $num = 1;
                            foreach($list_plan_cmpras as $dta_list_plan_cmpras){
                                $pco_codigo = $dta_list_plan_cmpras['pco_codigo'];
                                $pco_etapa = $dta_list_plan_cmpras['pco_etapa'];
                                $pco_descrpcion = $dta_list_plan_cmpras['pco_descrpcion']; 
                                $pco_cantidad = $dta_list_plan_cmpras['pco_cantidad'];
                                $pco_valorunitario = $dta_list_plan_cmpras['pco_valorunitario'];
                                $pco_estado = $dta_list_plan_cmpras['pco_estado'];

                               

                                if($pco_estado == 1){
                                    $checkedA = "checked";
                                    $checkedI = "";
                                }
                                else{
                                    $checkedA = "";
                                    $checkedI = "checked";
                                }

                                $valor = $pco_cantidad * $pco_valorunitario;
                    ?>
                    <tr>    
                        <td><?php echo $num; ?></td>
                        <td>
                            <input type="hidden" name="codigo_mod<?php echo $num; ?>" id="codigo_mod<?php echo $num; ?>" value="<?php echo $pco_codigo; ?>">
                            <textarea class="form-control fuente_input_tabla" rows="2" name="txtDescripcion<?php echo $num; ?>" id="txtDescripcion<?php echo $num; ?>" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $pco_descrpcion; ?></textarea>  
                        </td>
                        <td>
                            <input type="number" class="form-control fuente_input_tabla sma<?php echo $num; ?>" id="txtCantidad<?php echo $num; ?>" name="txtCantidad<?php echo $num; ?>" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pco_cantidad;?>" required>
                        </td>
                        <td>
                            <input type="text" class="form-control fuente_input_tabla sma<?php echo $num; ?>" id="txtValorUnitario<?php echo $num; ?>" name="txtValorUnitario<?php echo $num; ?>" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($pco_valorunitario,0,'','.'); ?>" required>
                        </td>
                        <td>
                            $ <span id="valorFinal<?php echo $num; ?>"><?php echo number_format($valor,0,'','.'); ?></span>
                        </td>
                        <td>
                            <input type="radio"   id="ractivo<?php echo $num; ?>" name="chkestado<?php echo $num; ?>"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                            <label for="ractivo<?php echo $num; ?>">&nbsp; Activo &nbsp;&nbsp;</label>
                            <br>
                            <input type="radio"   id="rinactivo<?php echo $num; ?>" name="chkestado<?php echo $num; ?>"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                            <label for="rinactivo<?php echo $num; ?>">&nbsp; Inactivo</label>
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

