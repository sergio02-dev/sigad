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
            <span id="error_etapa<?php echo $codigo_actividad; ?>" style="color:#C2240B; font-weight: bold;"></span>
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
            <input type="hidden" name="valor_etapa<?php echo $codigo_actividad; ?>" id="valor_etapa<?php echo $codigo_actividad; ?>" value="">
        </div> 
    </div>
</div>


<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-12">
        <table class="table tablaClasificadores<?php echo $codigo_actividad; ?>">
            <tr>
                <th colspan="4">Codigo Casificador</th>
            </tr>
            <tr>
                <td colspan ="7" style="width: 95%">
                    <div class="form-label-group form-group" id="dtaClasificador<?php echo $codigo_actividad;?>">
                        
                    </div> 
                </td>
                <td rowspan="2" style="width: 5%"><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $codigo_actividad; ?>('<?php echo $codigo_actividad; ?>')"></i>
                </td>
            </tr>
            <tr>
                <td  colspan="2" style="width: 30%">
                    <div class="form-label-group form-group">
                        <label><strong>Valor</strong></label>
                        <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" placeholder="$......." name="valor_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required> 
                    </div> 
                </td>
                <td colspan="2" style="width: 30%">
                   
                    <div class="form-label-group form-group">
                        <label><strong>Codigo Dane</strong></label>
                        <input type="text" class="form-control caja_texto_sizer"  name="codigo_dane<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required>    
                    </div> 
                </td>
                <td colspan="3" style="width:40%">
                   
                    <div class="form-label-group form-group" >
                        <label><strong>Descripci&oacute;n Dane</strong></label>
                        <textarea class="form-control caja_texto_sizer" name="descripcion_dane<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required></textarea> 
                    </div>
                </td>
            </tr>
        </table>
        <span id="error_clasificador<?php echo $codigo_actividad; ?>" style="color:red; font-weight: bold;"></span>
        <span id="error_valor_clsificador<?php echo $codigo_actividad; ?>" style="color:red; font-weight: bold;"></span>
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
    var select_info<?php echo $codigo_actividad; ?> = '';
    var lista_opciones<?php echo $codigo_actividad; ?> = '';
    
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
            $('#valor_etapa<?php echo $codigo_actividad; ?>').val(0);
        }
        else{
            $('#titulo_fuente<?php echo $codigo_actividad; ?>').fadeIn(1);
            $('.datosEtapa<?php echo $codigo_actividad; ?>').fadeIn(1);
            $('.desc<?php echo $codigo_actividad; ?>').html(descrpcion);
            $('.pric<?php echo $codigo_actividad; ?>').html("$ "+numberWithCommas(rcursos_etapa));
            $('#valor<?php echo $codigo_actividad; ?>').val(numberWithCommas(rcursos_etapa)); 
            $('#valor_etapa<?php echo $codigo_actividad; ?>').val(rcursos_etapa);       
        
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
                        lista_opciones<?php echo $codigo_actividad; ?> += '<option value="'+element.cla_codigo+'">'+element.cla_numero+' '+element.cla_nombre+'</option>';
                    });

                    select_info<?php echo $codigo_actividad; ?> = '<select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker<?php echo $codigo_actividad;?>" data-size="8"><option value="0">Seleccione...</option>'+lista_opciones<?php echo $codigo_actividad; ?>+'</select>';

                    $('#dtaClasificador<?php echo $codigo_actividad;?>').html(select_info<?php echo $codigo_actividad; ?>);
                    
                    $('.selectpicker<?php echo $codigo_actividad;?>').selectpicker({
                        liveSearch: true,
                        maxOptions: 1
                    });
                }
            });
        }
    });

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    var cantida_clasificador<?php echo $codigo_actividad; ?> = 0;
    function getInput(type, activCode){
        var activCode = activCode;
        cantida_clasificador<?php echo $codigo_actividad; ?> = cantida_clasificador<?php echo $codigo_actividad; ?> +1;
        var nombre_capa = '.'+activCode+cantida_clasificador<?php echo $codigo_actividad; ?>;
      
        var dta = '<tr class="'+activCode+cantida_clasificador<?php echo $codigo_actividad; ?>+'"><td colspan="7" style="width: 95%"><div class="form-label-group form-group">'+select_info<?php echo $codigo_actividad; ?>+'</div></td><tr class="'+activCode+cantida_clasificador<?php echo $codigo_actividad; ?>+'"><td colspan="2" style="width: 30%"><div class="form-label-group form-group"><input type="text" class="form-control caja_texto_sizer puntos_miles_valor" placeholder="$......." name="valor_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required></div></td><td colspan="2" style="width: 25%"><div class="form-label-group form-group"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Dane" name="codigo_dane" aria-describedby="textHelp" value="" required> </div></td><td colspan="3"  style="width:40%"><div form-label-group form-group" ><textarea class="form-control caja_texto_sizer" placeholder="Descripcion" name="descripcion_dane" aria-describedby="textHelp" value="" required></textarea></div></td><td rowspan="2"style="width: 5%"><i class="fas fa-minus fa-lg color_icono" onclick="eliminar_clasificador<?php echo $codigo_actividad; ?>(\''+nombre_capa+'\')"></i><td></tr>'
        
        nombre_capa = '';
        return dta;
    }

    function append(className, nodoToAppend){
        var nodo = document.getElementsByClassName(className)[0];
        $('.'+className).append(nodoToAppend);

        $('.selectpicker<?php echo $codigo_actividad;?>').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });

        $(".puntos_miles_valor").on({
            "focus": function (event) {
                $(event.target).select();
            },
            "keyup": function (event) {
                $(event.target).val(function (index, value ) {
                    return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                });
            }
        });
    }

    function Agregaitems<?php echo $codigo_actividad; ?>(activCode){
        var activCode = activCode;

        var nodo_clasificacion = getInput("text", activCode);
        append("tablaClasificadores"+activCode, nodo_clasificacion);
    }

    function eliminar_clasificador<?php echo $codigo_actividad; ?>(data_info){
        var data_info = data_info;

        $(data_info).remove();
    }

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
</script>