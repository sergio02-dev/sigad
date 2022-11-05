<?php
    include('crud/rs/rp/rprte_rp.php');

    $pln_desarrollo = $objRprteRP->pln_desarrollo();
    
    $task = "REPORTE PLAN DE ACCI&Oacute;N";
    $checkedCompleto = "checked";
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="plandesarrolloform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task;?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="selPlanDesarrollo" class="font-weight-bold"> Plan Desarrollo *</label>
                    <select name="selPlanDesarrollo" id="selPlanDesarrollo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0" data-plan_desarrollo="0">Seleccione ...</option>
                        <?php
                        if($pln_desarrollo){
                            foreach ($pln_desarrollo as $dta_plan_dsrrollo) {
                                $pde_codigo = $dta_plan_dsrrollo['pde_codigo'];
                                $pde_nombre = $dta_plan_dsrrollo['pde_nombre'];

                        ?>
                            <option value="<?php echo $pde_codigo; ?>" data-plan_desarrollo="<?php echo $pde_codigo; ?>"><?php echo $pde_nombre; ?> </option>
                        <?php
                            }
                        }
                        else{
                        ?>  
                            <option value="0" data-plan_desarrollo="0">No hay Datos...</option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_plan_desarrollo" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="filtros_reporte">
            
        </div>


        <div class="row">
            <div class="col-sm-12">
                <br>
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="generarExcel();"><i class="fas fa-file-excel fa-lg" >&nbsp; Reporte RP</i> </button></div> 
            </div>
        </div>
        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="plan_desarrollo" id="plan_desarrollo" value="<?php echo $plan_desarrollo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroPlanDesarrollo.js"></script>
<script type="text/javascript">

    $('#selPlanDesarrollo').change(function(){
        var plan_desarrollo = $(this).find(':selected').data('plan_desarrollo');
        
        if(plan_desarrollo == 0){

        }
        else{
            $.ajax({
                url:"filtrosreporterp",
                type:"POST",
                data:"plan_desarrollo="+plan_desarrollo,
                async:true,
                success: function(message){
                    $(".filtros_reporte").empty().append(message);
                }
            });
        }
    });   

    
    function generarExcel(){
        var selPlanDesarrollo = $('#selPlanDesarrollo').val();
        var selVigencia = $('#selVigencia').val();
        var chkrprte = $('input:radio[name=chkrprte]:checked').val();
        var selSubSistema = $('#selSubSistema').val();
        var selProyecto = $('#selProyecto').val();
        var selAccion = $('#selAccion').val();
        var selActividad = $('#selActividad').val();
        
        if(selPlanDesarrollo == 0){
            $('#error_plan_desarrollo').fadeIn(100);
            $('#selPlanDesarrollo').focus();
            $('#error_plan_desarrollo').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('#error_plan_desarrollo').fadeOut(100);
            $('#error_plan_desarrollo').html('');
        }

        if(selVigencia == 0){
            $('#selVigencia').focus();
            $('#error_vigencia').fadeIn(100);
            $('#error_vigencia').html('Debe seleccionarse una Opción');
            return false;
            
        }
        else{
            $('#error_vigencia').fadeOut(100);
            $('#error_vigencia').html('');
        }

        if(!chkrprte){
            $('#error_reporte').fadeIn(100);
            $('#error_reporte').html('Debe seleccionar una Opción');
            return false;
        }
        else{
            $('#error_reporte').fadeOut(100);
            $('#error_plan_desarrollo').html('');
        }

        if(chkrprte == 2){
            if(selSubSistema == 0){
                $('#selSubSistema').focus();
                $('#error_sub_sistema').fadeIn(1);
                $('#error_sub_sistema').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_sub_sistema').fadeOut(1);
                $('#error_sub_sistema').html('');
            }
            window.location.href = 'excelsubsistemarp?codigo_plan='+selPlanDesarrollo+'&codigo_vigencia='+selVigencia+'&codigo_subsistema='+selSubSistema;                
        }

        if(chkrprte == 3){
            if(selSubSistema == 0){
                $('#selSubSistema').focus();
                $('#error_sub_sistema').fadeIn(1);
                $('#error_sub_sistema').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_sub_sistema').fadeOut(1);
                $('#error_sub_sistema').html('');
            }

            if(selProyecto == 0){
                $('#selProyecto').focus();
                $('#error_proyecto').fadeIn(1);
                $('#error_proyecto').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_proyecto').fadeOut(1);
                $('#error_proyecto').html('');
            }
            window.location.href = 'excelproyectorp?codigo_plan='+selPlanDesarrollo+'&codigo_vigencia='+selVigencia+'&codigo_subsistema='+selSubSistema+'&codigo_proyecto='+selProyecto;                
        }

        if(chkrprte == 4){
            if(selSubSistema == 0){
                $('#selSubSistema').focus();
                $('#error_sub_sistema').fadeIn(1);
                $('#error_sub_sistema').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_sub_sistema').fadeOut(1);
                $('#error_sub_sistema').html('');
            }

            if(selProyecto == 0){
                $('#selProyecto').focus();
                $('#error_proyecto').fadeIn(1);
                $('#error_proyecto').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_proyecto').fadeOut(1);
                $('#error_proyecto').html('');
            }

            if(selAccion == 0){
                $('#selAccion').focus();
                $('#error_accion').fadeIn(1);
                $('#error_accion').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_accion').fadeOut(1);
                $('#error_accion').html('');
            }
            window.location.href = 'excelacciorp?codigo_plan='+selPlanDesarrollo+'&codigo_vigencia='+selVigencia+'&codigo_subsistema='+selSubSistema+'&codigo_proyecto='+selProyecto+'&codigo_accion='+selAccion;                
        }

        if(chkrprte == 5){
            if(selSubSistema == 0){
                $('#selSubSistema').focus();
                $('#error_sub_sistema').fadeIn(1);
                $('#error_sub_sistema').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_sub_sistema').fadeOut(1);
                $('#error_sub_sistema').html('');
            }

            if(selProyecto == 0){
                $('#selProyecto').focus();
                $('#error_proyecto').fadeIn(1);
                $('#error_proyecto').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_proyecto').fadeOut(1);
                $('#error_proyecto').html('');
            }

            if(selAccion == 0){
                $('#selAccion').focus();
                $('#error_accion').fadeIn(1);
                $('#error_accion').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_accion').fadeOut(1);
                $('#error_accion').html('');
            }

            if(selAccion == 0){
                $('#selAccion').focus();
                $('#error_accion').fadeIn(1);
                $('#error_accion').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_accion').fadeOut(1);
                $('#error_accion').html('');
            }

            if(selActividad == 0){
                $('#selActividad').focus();
                $('#error_actividad').fadeIn(1);
                $('#error_actividad').html('Seleccione una Opción');
                return false;
            }
            else{
                $('#error_actividad').fadeOut(1);
                $('#error_actividad').html('');
            }

            window.location.href = 'excelactividadrp?codigo_plan='+selPlanDesarrollo+'&codigo_vigencia='+selVigencia+'&codigo_subsistema='+selSubSistema+'&codigo_proyecto='+selProyecto+'&codigo_accion='+selAccion+'&codigo_actividad='+selActividad;                
        }
    }


    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

</script>
