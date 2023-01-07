<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $etapas_list = $objSolicitudCdp->etapas_actividad($codigo_actividad);

?>
<div class="row"><div class="col-md-12">&nbsp;</div></div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="etpass<?php echo $codigo_actividad; ?>" class="font-weight-bold">Etapa *</label>
            <select name="etpass<?php echo $codigo_actividad; ?>" id="etpass<?php echo $codigo_actividad; ?>" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0" data-codigo_etapa="0" data-descrpcion="" data-rcursos_etapa="0"> Seleccione ...</option>
                <?php
                    if($etapas_list){
                        foreach ($etapas_list as $dta_etpas_list) {
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

                            $poai_etapa_gasto = $objSolicitudCdp->poai_etapa_gasto($poa_codigo, $codigo_solicitud);

                            $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;

                ?>
                    <option value="<?php echo  $poa_codigo; ?>" data-codigo_etapa="<?php echo $poa_codigo; ?>" data-descrpcion="<?php echo $etpa_nombre; ?>" data-rcursos_etapa="<?php echo $rcursos_etapa; ?>"><?php echo substr($etpa_nombre,0,110); ?></option>
                <?php
                        }
                    }
                    else{
                ?>
                    <option value="0" data-codigo_etapa="0" data-descrpcion="" data-rcursos_etapa="0"> No hay Etapas</option>
                <?php
                    }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_etapaactivdad<?php echo $codigo_actividad; ?>" role="alert"></div>
        </div>
    </div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-8 desc<?php echo $codigo_actividad; ?>"></div>
    <div class="col-md-4 pric<?php echo $codigo_actividad; ?>"></div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-8">
        <br>
        <input type="hidden" id="control_valor_chek<?php echo $codigo_actividad; ?>" value="0">
        <input type="checkbox" name="checkOtrval<?php echo $codigo_actividad; ?>" id="checkOtrval<?php echo $codigo_actividad; ?>" value="1"> &nbsp;Otro valor
    </div>
    <div class="col-md-4">
        <div class="form-group" id="text_valor<?php echo $codigo_actividad; ?>" style="display: none;">
            <label for="valor<?php echo $codigo_actividad; ?>" class="font-weight-bold" >Valor </label>
            <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" min="0" id="valor<?php echo $codigo_actividad; ?>" name="valor<?php echo $codigo_actividad; ?>" aria-describedby="textHelp" value="" required>
            <span id="error_valor_etpa<?php echo $codigo_actividad; ?>" style="color:red; font-weight: bold;"></span>
        </div> 
    </div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-12">
        <table class="table">
            <tr>
                <th colspan="3">Codigo Casificador</th>
            </tr>
            <tr>
                <td>
                    <div class="form-label-group form-group" id="dtaClasificador<?php echo $codigo_actividad;?>">
                        <!--<input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required> -->
                        <select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker" id="opcions<?php echo $codigo_actividad; ?>" data-size="8" data-rule-required="true"></select>
                    </div> 
                </td>
                <td>
                    <div class="form-label-group form-group">
                        <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" placeholder="$......." name="codigo_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required> 
                    </div> 
                </td>
                <td><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $codigo_actividad; ?>('<?php echo $codigo_actividad; ?>')"></i></td>
            </tr>
        </table>
    </div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-12">
        <label style="color: #C2240B; display: none;"  class="font-weight-bold" id="titulo_fuente<?php echo $codigo_actividad; ?>"><strong>Fuentes</strong></label>         
        <div class="fuente_etapa<?php echo $codigo_actividad; ?>">
            
        </div>
    </div>
</div>

<script type="text/javascript">
    var select_info = '';
    var lista_opciones = '';
    
    $(document).ready(function () {
        
        /*$.ajax({
            url:"jclasificadores",
            type:"POST",
            data:'valor',
            async:true,
            dataType: 'json',
            success: function(message){
                datos = message.data;
                $.each(datos, function(index, element){
                    lista_opciones += '<option value="'+element.cla_codigo+'">'+element.cla_numero+' '+element.cla_nombre+'</option>';
                });

                //select_info = '<select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true">'+lista_opciones+'</select>';
                alert(lista_opciones);
                
                $("#opcions<?php echo $codigo_actividad; ?>").empty().append(lista_opciones);

                //$('#dtaClasificador<?php echo $codigo_actividad;?>').empty().append(select_info);
                //$('#dtaClasificador<?php echo $codigo_actividad;?>').html(select_info);
            }
        });*/
        
        
        
        
    });   //*/
    

    /*function listClasificadores() {

        $.ajax({
            url:"jclasificadores",
            type:"POST",
            data:'',
            async:true,
            dataType: 'json',
            success: function(message){
                console.log(JSON.stringify(message));
                var select_info = '';

                $.each(message, function(index, element){
                    select_info += '<option value="'+ element.bancocodigo+'">'+element.banconombre+'</option>';
                })
            }
            //$('.clasificadorData<?php echo $codigo_actividad; ?>').append(select_info);
        })
    }*/

    $('#checkOtrval<?php echo $codigo_actividad; ?>').change(function(){
        var val_other = $('input:checkbox[name=checkOtrval<?php echo $codigo_actividad; ?>]:checked').val();
        
        if(val_other==1){
            $('#text_valor<?php echo $codigo_actividad; ?>').fadeIn(100);
            $('#control_valor_chek<?php echo $codigo_actividad; ?>').val(1);
        }
        else{
            $('#text_valor<?php echo $codigo_actividad; ?>').fadeOut(100);
            $('#control_valor_chek<?php echo $codigo_actividad; ?>').val(0);
        }
    });

    $(".puntos_miles_etapa").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#etpass<?php echo $codigo_actividad; ?>').change(function(){
        var codigo_etapa = $(this).find(':selected').data('codigo_etapa');
        var descrpcion = $(this).find(':selected').data('descrpcion');
        var rcursos_etapa = $(this).find(':selected').data('rcursos_etapa');
        
        if(codigo_etapa == 0){
            $('#titulo_fuente<?php echo $codigo_actividad; ?>').fadeOut(1);
            $('.fuente_etapa<?php echo $codigo_actividad; ?>').empty();
            $('.datosEtapa<?php echo $codigo_actividad; ?>').fadeOut(1);
            $('.desc<?php echo $codigo_actividad; ?>').html('');
            $('.pric<?php echo $codigo_actividad; ?>').html('');
            $('#valor<?php echo $codigo_actividad; ?>').val(0);
        }
        else{
            $('#titulo_fuente<?php echo $codigo_actividad; ?>').fadeIn(1);
            $('.datosEtapa<?php echo $codigo_actividad; ?>').fadeIn(1);
            $('.desc<?php echo $codigo_actividad; ?>').html(descrpcion);
            $('.pric<?php echo $codigo_actividad; ?>').html("$ "+numberWithCommas(rcursos_etapa));
            $('#valor<?php echo $codigo_actividad; ?>').val(numberWithCommas(rcursos_etapa));         
        
            $.ajax({
                url:"fuenteasignadaxetapa",
                type:"POST",
                data:'codigo_etapa='+codigo_etapa,
                async:true,
                success: function(message){
                    $(".fuente_etapa<?php echo $codigo_actividad; ?>").empty().append(message);
                }
            });

            
            $.ajax({
                url:"jclasificadores",
                type:"POST",
                data:'valor',
                async:true,
                dataType: 'json',
                success: function(message){
                    datos = message.data;
                    $.each(datos, function(index, element){
                        lista_opciones += '<option value="'+element.cla_codigo+'">'+element.cla_numero+' '+element.cla_nombre+'</option>';
                    });

                    select_info = '<select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true">'+lista_opciones+'</select>';
                    alert(select_info);
                    $('#dtaClasificador<?php echo $codigo_actividad;?>').html('<select class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true">'+lista_opciones+'</select>');
                }
            });
        }
    });
</script>