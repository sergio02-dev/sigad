<?php
    include('crud/rs/agncion_rcrsos/agncion_rcrsos.php');

    $codigo_poai = $_REQUEST['codigo_poai'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_indicador = $_REQUEST['codigo_indicador'];
    $codigo_asignacion = $_REQUEST['codigo_asignacion'];
    
    $vigencia_actividad = $objAsignacionRecursos->vigencia_actividad($codigo_poai);


    $list_fuente_disponibilidad = $objAsignacionRecursos->list_fuente_disponibilidad($codigo_poai, $codigo_accion, $codigo_indicador, $codigo_asignacion);
    

    if($codigo_asignacion){
        $titulo_formulario ="MODIFICAR ASIGNACIÓN";
        $url_proceso = "modificarasignacionrecurso";
        $asignacion_form = $objAsignacionRecursos->asignacion_form($codigo_asignacion);
        foreach($asignacion_form as $dat_asignacion_frma){
            $asre_codigo = $dat_asignacion_frma['asre_codigo'];
            $asre_etapa = $dat_asignacion_frma['asre_etapa'];
            $asre_accion = $dat_asignacion_frma['asre_accion'];
            $asre_fuente = $dat_asignacion_frma['asre_fuente'];
            $asre_indicador = $dat_asignacion_frma['asre_indicador'];
            $asre_vigenciarecurso = $dat_asignacion_frma['asre_vigenciarecurso'];
            $asre_vigenciapoai = $dat_asignacion_frma['asre_vigenciapoai'];
            $asre_recurso = $dat_asignacion_frma['asre_recurso'];
            $asre_estado = $dat_asignacion_frma['asre_estado'];   
            $asre_tipo = $dat_asignacion_frma['asre_tipo'];         
        }

        if($asre_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($asre_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $vigencia_actividad = $asre_vigenciapoai;
    }
    else{
        $titulo_formulario ="REGISTRAR ASIGNACIÓN";
        $url_proceso = "registroasignacionrecursos";
        $vigencia_actividad = $objAsignacionRecursos->vigencia_actividad($codigo_poai);
        $checkedA = "checked";
        $asre_vigenciarecurso = 0;
        $asre_fuente = 0;
        $asre_recurso = 0;
    }

    $url_direccion = "viewasignacionrecursos?codigo_poai=".$codigo_poai."&codigo_accion=".$codigo_accion."&codigo_indicador=".$codigo_indicador;

?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="asignacionrecursoform">
    <div class="modal-header fondo-titulo">
        <h6 class="modal-title"><strong><?php echo $titulo_formulario; ?></strong></h6>
        <button type="button" class="close" aria-label="Close" onclick="cerrar_formulario();">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="selFuente" class="font-weight-bold"> FUENTE DE FINANCIACI&Oacute;N *</label>
            <select name="selFuente" id="selFuente"  class="form-control caja_texto_sizer" data-size="8" data-rule-required="true" required>
            <option value="0" data-vigencia_recurso="0"> Seleccione ...</option>
                <?php
                    if($list_fuente_disponibilidad){
                        foreach ($list_fuente_disponibilidad as $dta_fntes_fnnccion) {
                            $codigo_fuente = $dta_fntes_fnnccion['codigo_fuente'];
                            $nombre_fuente = $dta_fntes_fnnccion['nombre_fuente'];
                            $vigencia_recurso = $dta_fntes_fnnccion['vigencia_recurso'];
                            $recurso_disponible = $dta_fntes_fnnccion['recurso_disponible'];
                            $cdigo_indicador = $dta_fntes_fnnccion['cdigo_indicador'];

                            $descrp = $vigencia_recurso." ".$nombre_fuente." $".number_format($recurso_disponible,0,'','.');
                        
                            if($codigo_fuente == $asre_fuente && $vigencia_recurso ==  $asre_vigenciarecurso && $cdigo_indicador == $asre_indicador){
                                $selected_accion = "selected";
                                $rcrso_disponible = $recurso_disponible;
                            }
                            else{
                                $selected_accion = "";
                            }
                    
                ?>
                    <option value="<?php echo  $codigo_fuente; ?>" data-saldo="<?php echo number_format($recurso_disponible,0,'','.'); ?>" data-vigencia_recurso="<?php echo $vigencia_recurso; ?>" data-rcrso_disponible="<?php echo $recurso_disponible; ?>" <?php echo $selected_accion; ?>><?php echo substr($descrp,0,105)."..."; ?></option>
                <?php
                        }
                    }
                    else{
                ?>
                    <option value="0" data-accion="<?php echo $acc_codigo; ?>"> No hay Fuentes de Financiación</option>
                <?php
                    }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_fuente" role="alert"></div>
        </div>

        <div class="form-group">
            <label for="txtResurso" class="font-weight-bold">Recursos *</label>
            <input type="text" class="form-control caja_texto_sizer" id="txtResurso" name="txtResurso" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($asre_recurso,0,'','.'); ?>" required>
            <div class="alert alert-danger alerta-forcliente" id="error_recurso" role="alert"></div>
        </div>

        <div class="form-group">
            <label for="chkestado" class="font-weight-bold">Estado *</label>
            <div class="radio tipo1">
                <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                <label for="ractivo">&nbsp;Activo &nbsp;&nbsp;</label>

                <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                <label for="rinactivo">&nbsp;Inactivo</label>
                <div class="alert alert-danger alerta-forcliente" id="error_estado" role="alert"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="alert alert-danger alerta-forcliente" id="error_asignacion" role="alert"></div>
        </div>

        <div class="form-group">
            <div class="alert alert-danger alerta-forcliente" id="error_saldo" role="alert"></div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" id="url_direccion" name="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" id="url_proceso" name="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" id="rcrso_disponible" name="rcrso_disponible" value="<?php echo $rcrso_disponible; ?>">
        <input type="hidden" id="vigencia_actividad" name="vigencia_actividad" value="<?php echo $vigencia_actividad; ?>">
        <input type="hidden" id="vigencia_recurso" name="vigencia_recurso" value="<?php echo $asre_vigenciarecurso; ?>">
        <input type="hidden" id="codigo_asignacion" name="codigo_asignacion" value="<?php echo $codigo_asignacion; ?>">
        <input type="hidden" id="codigo_poai" name="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" id="codigo_accion" name="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" id="codigo_indicador" name="codigo_indicador" value="<?php echo $codigo_indicador; ?>">
        <button type="button" class="btn btn-secondary" onclick="cerrar_formulario();">Cerrar</button>
        <button type="button" class="btn btn-danger" onClick="validar_asignacion();"><i class="far fa-save"></i> Guardar </button>
    </div>
</form>

<script src="vjs/vldar_asignacion.js"></script>
<script type="text/javascript">
    $("#txtResurso").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });

    function cerrar_formulario(){
        $(".formulario_recursos").empty();
    }

    $('#selFuente').change(function(){
        var vigencia_recurso = $(this).find(':selected').data('vigencia_recurso');
        var rcrso_disponible = $(this).find(':selected').data('rcrso_disponible');
        var saldo = $(this).find(':selected').data('saldo');

        $('#vigencia_recurso').val(vigencia_recurso);
        $('#rcrso_disponible').val(rcrso_disponible);
        $('#txtResurso').val(saldo);
    });
    
    
</script>