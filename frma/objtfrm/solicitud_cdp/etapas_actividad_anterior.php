<?php 
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $cdigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];
    $codigo_accion = $_REQUEST['codigo_accion'];

    if($cdigo_actividad){
        $cdigo_actividad = $cdigo_actividad;
    }
    else{
        $cdigo_actividad = 0;
    }

    $ver_otroValor = "none";

    if($cdigo_actividad){
        $etapas_list = $objSolicitudCdp->etapas_actividad($cdigo_actividad);
    }
    else{
        $etapas_list = "";
    }

    $valor_etps = 0;
    
?>

<div class="form-group">

    <label class="font-weight-bold">Etapas * </label>
    <div class="bg">
        <table class="table table-sm">
            <?php 
                if($etapas_list){
                    $num_etapa = 0;
                    foreach($etapas_list as $dta_etpas_list){
                        $poa_codigo = $dta_etpas_list['poa_codigo'];
                        $poa_referencia = $dta_etpas_list['poa_referencia'];
                        $poa_objeto = $dta_etpas_list['poa_objeto']; 
                        $poa_recurso = $dta_etpas_list['poa_recurso'];
                        $poa_estado = $dta_etpas_list['poa_estado'];
                        $poa_numero = $dta_etpas_list['poa_numero']; 
                        $poa_vigencia = $dta_etpas_list['poa_vigencia'];
                        $acp_codigo = $dta_etpas_list['acp_codigo'];
                        $poa_logroejecutado = $dta_etpas_list['poa_logroejecutado'];

                        $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                        $poai_etapa_gasto = $objSolicitudCdp->poai_etapa_gasto($poa_codigo);

                        $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;

                        
                        $checkear_etapa = "";
                        $ver_check_caja = "none";
                        $ver_otrovalor = "none";
                        $control_valor = 0;
                        $otro_valor_campo = "none";
                        
            ?>
            <tr>
                <td>
                    <div class="chiller_cb">
                        <input id="actvddes<?php echo $poa_codigo; ?>" class="etapps" name="etpass[]" data-valor_etapa="<?php echo $rcursos_etapa; ?>" type="checkbox" value="<?php echo $poa_codigo; ?>" <?php echo $checkear_etapa; ?> data-rule-required="true" required>
                        <label for="actvddes<?php echo $poa_codigo; ?>"><?php echo $etpa_nombre; ?></label>
                        <span></span>
                    </div>
                    <!--- Datos Otro valor --->
                    <input type="hidden" name="valetapa<?php echo $poa_codigo; ?>" id="valetapa<?php echo $poa_codigo; ?>" value="<?php echo $rcursos_etapa; ?>">
                    <input type="hidden" id="control_valor<?php echo $poa_codigo; ?>" value="<?php echo $control_valor; ?>">
                    <div class="row">
                        <div class="col-sm-6 otro_valor<?php echo $poa_codigo; ?> " style="display: <?php echo $ver_check_caja; ?>;">
                            <label for="codigo_clasificador<?php echo $poa_codigo; ?>" class="font-weight-bold" >Codigo Clasificador</label>

                            <div class="form-label-group form-group">
                                <input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" aria-describedby="textHelp" value="" required> 
                            </div> 
                            <table class="clasfcdorCdgo<?php echo $poa_codigo; ?>">
                            
                            </table>
                            
                        </div>

                        <div class="col-sm-1 otro_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $ver_check_caja; ?>;">
                            <br> <br>
                            <i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $poa_codigo; ?>('<?php echo $poa_codigo; ?>')"></i>
                        </div>

                        <div class="col-sm-3 otro_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $ver_check_caja; ?>;">
                            <br>
                            <lable>&nbsp;</label>
                            <input type="hidden" id="control_valor_chek<?php echo $poa_codigo; ?>" value="0">
                            &nbsp;&nbsp;<input type="checkbox" <?php echo $checkVlor; ?> name="checkOtrval<?php echo $poa_codigo; ?>" id="checkOtrval<?php echo $poa_codigo; ?>" value="1"> &nbsp;Otro valor
                        </div>

                    </div>
                    
                   
                    
                    <script type="text/javascript">
                        var cantida_clasificador = 0;
                        function getInput(type, poaCode){
                            var poaCode = poaCode;
                            cantida_clasificador = cantida_clasificador +1;
                            var dta = '<tr class="<?php echo $poa_codigo; ?>'+cantida_clasificador+'"><td style="width: 90%"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" id="codigo_clasificador<?php echo $poa_codigo; ?>'+cantida_clasificador+'" name="codigo_clasificador'+poaCode+'[]" required /></td><td style="width: 10%"><i class="fas fa-minus fa-lg color_icono" id="botton<?php echo $poa_codigo; ?>'+cantida_clasificador+'" onclick="eliminar_clasificador(\''+cantida_clasificador+'\')"></i><td></tr>'
                            return dta;
                        }

                        function eliminar_clasificador(data_info){
                            var data_info = data_info;
                            $('.<?php echo $poa_codigo; ?>'+data_info).remove();
                        }

                        function append(className, nodoToAppend){
                            var nodo = document.getElementsByClassName(className)[0];
                            $('.'+className).append(nodoToAppend);
                        }

                        function Agregaitems<?php echo $poa_codigo; ?>(poaCode){
                            var poaCode = poaCode;
                            var nodo_clasificacion = getInput("text", poaCode);
                            append("clasfcdorCdgo"+poaCode, nodo_clasificacion);
                        }

                        //cantida_clasificador

                        $('#checkOtrval<?php echo $poa_codigo; ?>').change(function(){
                            var val_other = $('input:checkbox[name=checkOtrval<?php echo $poa_codigo; ?>]:checked').val();
                            //var 

                            if(val_other==1){
                                $('#text_valor<?php echo $poa_codigo; ?>').fadeIn(100);
                                $('#control_valor_chek<?php echo $poa_codigo; ?>').val(1);
                            }
                            else{
                                $('#text_valor<?php echo $poa_codigo; ?>').fadeOut(100);
                                $('#control_valor_chek<?php echo $poa_codigo; ?>').val(0);

                            }
                        });
                    </script>

                    

                    <label style="color: #CE270D; display: none;"  class="font-weight-bold" id="titulo_fuente<?php echo $poa_codigo; ?>">Fuentes</label>

                    <div class="fuente_etapa<?php echo $poa_codigo; ?>">

                    </div>

                    
                </td>
                <td>
                    &nbsp;<br><?php echo "$".number_format($rcursos_etapa,0,'','.'); ?>
                    <br>
                    <div class="row">
                        <div class="col-sm-12" id="text_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $otro_valor_campo; ?>;">
                            <div class="form-group">
                                <label for="valor<?php echo $poa_codigo; ?>" class="font-weight-bold" >Valor </label>
                                <input type="number" class="form-control caja_texto_sizer" min="0" max="<?php echo $rcursos_etapa; ?>" id="valor<?php echo $poa_codigo; ?>" name="valor<?php echo $poa_codigo; ?>" aria-describedby="textHelp" value="<?php echo $aes_valoretapa; ?>" required>
                                <span id="error_valor_etpa<?php echo $poa_codigo; ?>" style="color:red; font-weight: bold;"></span>
                            </div> 
                        </div>
                    </div>
                </td>
                
            </tr>
            <?php
                        $num_etapa++;
                    }
                }
                else{
            ?>
            <tr>
                <td colspan="2">No hay Etapas</td>
            </tr>
            <?php
                }
            ?>
        </table>
        
    </div>
    <span class="help-block" id="error"></span>
    <span id="error_etapas" style="color:red; font-weight: bold;"></span>

</div>

<!--<div class="form-group">
    <label for="SumTotal" class="font-weight-bold">Total*</label>
    <input type="text" class="form-control" id="SumTotal" name="SumTotal" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($valor_etps,0,'','.'); ?>" required readonly>
    <span class="help-block" id="error"></span>            
</div>-->

<div class="form-group">
    <label class="font-weight-bold">Fuentes de Finaniaci&oacute;n * </label>
    <div class="bg">
        <table class="table table-sm">
            <?php
                $lista_recursos_disponibles = $objSolicitudCdp->lista_recursos_disponibles($cdigo_actividad);
                if($lista_recursos_disponibles){
                    foreach($lista_recursos_disponibles as $dat_rcsos_disponibles){
                        $codigo_poai = $dat_rcsos_disponibles['codigo_poai'];
                        $codigo_fuente = $dat_rcsos_disponibles['codigo_fuente'];
                        $recursos = $dat_rcsos_disponibles['recursos'];
                        $nombre_fuente = $dat_rcsos_disponibles['nombre_fuente'];

                        $checkear_fuente = "";
            ?>
            <tr>
                <td>
                    <div class="chiller_cb">
                        <input id="listffnte<?php echo $codigo_poai; ?>" class="fntesRcrsos" name="fuenntes[]" data-valor_fuentes="<?php echo $recursos; ?>" type="checkbox" value="<?php echo $codigo_poai; ?>" <?php echo $checkear_fuente; ?> data-rule-required="true" required>
                        <label for="listffnte<?php echo $codigo_poai; ?>"><?php echo $nombre_fuente; ?></label>
                        <span></span>
                    </div>
                </td>
                <td>
                    &nbsp;<br><?php echo "$".number_format($recursos,0,'','.'); ?>
                    <br>
                    <div class="row">
                        <input type="hidden" id="control_fuente<?php echo $codigo_poai; ?>" value="0">
                        <div class="col-sm-12" id="text_solicitud_fuente<?php echo $codigo_poai; ?>" style="display: none;">
                            <div class="form-group">
                                <label for="valorpoai<?php echo $codigo_poai; ?>" class="font-weight-bold">Valor </label>
                                <input type="number" class="form-control caja_texto_sizer" min="0" max="<?php echo $recursos; ?>" id="valorpoai<?php echo $codigo_poai; ?>" name="valorpoai<?php echo $codigo_poai; ?>" aria-describedby="textHelp" value="" required>
                                <div class="alert alert-danger alerta-forcliente" id="error_valor_fuente<?php echo $codigo_poai; ?>" role="alert"></div>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                    }
                }
                else{
            ?>
            <tr>
                <td>No hay Recursos</td>
            </tr>
            <?php
                }
            ?>
        </table>
        <div class="alert alert-danger alerta-forcliente" id="error_fuente" role="alert"></div>
        <div class="alert alert-danger alerta-forcliente" id="error_valor_solicitado" role="alert"></div>
        <div class="alert alert-danger alerta-forcliente" id="error_recursos_disponibles" role="alert"></div>
    </div>
</div>


<input type="hidden" name="summaa" id="summaa" value="<?php echo $valor_etps; ?>">
<script type="text/javascript">
    

    var valor_total = new Array();

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('.fntesRcrsos').change(function(){

        //manejo visibilidad campo otro valor 
        var codigo_poai = this.value;
        //alert(codigo_poai);
        if($('#control_fuente'+codigo_poai).val() == 0){
            $('#control_fuente'+codigo_poai).val(1);
            $('#text_solicitud_fuente'+codigo_poai).fadeIn(1);
        }
        else{
            $('#control_fuente'+codigo_poai).val(0);
            $('#text_solicitud_fuente'+codigo_poai).fadeOut(1);
        }
        //fin manejo visibilidad campo otro valor
        
    });

    $('.etapps').change(function(){

        var suma_etapa = 0;

        //manejo visibilidad campo otro valor 
        var codigo_etpa = this.value;
        if($('#control_valor'+codigo_etpa).val() == 0){
            $('#control_valor'+codigo_etpa).val(1);
            $('.otro_valor'+codigo_etpa).fadeIn(1);

            //Fuentes 
            $('#titulo_fuente'+codigo_poai).fadeIn(1);
        }
        else{
            $('#control_valor'+codigo_etpa).val(0);
            $('.otro_valor'+codigo_etpa).fadeOut(1);

            //Fuentes 
            $('#titulo_fuente'+codigo_poai).fadeIn(1);
            $("#etpas_lista").empty();
        }
        //fin manejo visibilidad campo otro valor

        valor_etapa = $('[name="etpass[]"]:checked').map(function () {
                                return $(this).data('valor_etapa')
                       }).get();

        for (let index = 0; index < valor_etapa.length; index++) {
            suma_etapa = parseInt(suma_etapa) + parseInt(valor_etapa[index]);   
        }

        //$('#SumTotal').val(numberWithCommas(suma_etapa));
        $('#summaa').val(suma_etapa);
        
    });

</script>