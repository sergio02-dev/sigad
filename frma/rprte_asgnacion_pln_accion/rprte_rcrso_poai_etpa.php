<?php
    include('crud/rs/plnDsrrllo.php');
    include('crud/rs/rprte_plan_accion/rprte_plan_accion.php');

    $plan_desarrollo = $_REQUEST['plan_desarrollo']; 
    
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($plan_desarrollo);
    $nombreNivelUno = $objRsPlanDesarrollo->nivelUnoNombre();
    $nombreNivelDos = $objRsPlanDesarrollo->nivelDosNombre();
    $nombreNivelTres = $objRsPlanDesarrollo->nivelTresNombre();
    $rs_nivelUno = $objRsPlanDesarrollo->nivelUno(); 
    $vgncias_plan = $objRsPlanDesarrollo->vgncias_plan($plan_desarrollo);
    
    $task = "REPORTE RECURSOS POAI ETAPA";
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selVigencia" class="font-weight-bold"> Vigencia *</label>
                    <select name="selVigencia" id="selVigencia" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        
                        <?php
                        if($vgncias_plan){
                            foreach ($vgncias_plan as $dta_vgncia) {
                                $acp_vigencia = $dta_vgncia['acp_vigencia'];

                        ?>
                            <option value="<?php echo $acp_vigencia; ?>"><?php echo $acp_vigencia; ?> ...</option>
                        <?php
                            }
                        }
                        else{
                        ?>  
                            <option value="0">No hay Datos...</option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_vigencia" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Reporte Asignaci&oacute;n de Recursos Plan Acción *</label>
                    <div class="radio tipo1">
                        <input type="radio" id="rcompleto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedCompleto; ?> required/>
                        <label for="rcompleto"><span>&nbsp;Completo&nbsp;&nbsp;</span> </label>

                        <input type="radio" id="rsubsistema" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="2" required />
                        <label for="rsubsistema"><span>&nbsp;Por <?php echo $nombreNivelUno; ?>&nbsp;&nbsp;</span> </label>

                        <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="3" required />
                        <label for="rproyecto"><span>&nbsp;Por <?php echo $nombreNivelDos; ?>&nbsp;</span> </label>

                        <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="4" required />
                        <label for="rproyecto"><span>&nbsp;Por <?php echo $nombreNivelTres; ?> &nbsp;</span> </label>

                        <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="5" required />
                        <label for="rproyecto"><span>&nbsp;Por Actividades</span> </label>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger alerta-forcliente" id="error_estado" role="alert"></div>
        </div>

        <div class="row todo" style="display: block;">
            <div class="col-md-12">
                
                <div class="d-inline-block"><button type="button" class="btn btn-danger btn-sm" onclick="generarCompleto('<?php echo $plan_desarrollo; ?>');"> <i class="fas fa-file-excel fa-lg" >&nbsp;Asignaci&oacute;n de Recursos Plan de Acci&oacute;n Completo</i> </button></div> 
            </div>
        </div>

        <div class="row subsistema" style="display: none;">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="selSubSistema" class="font-weight-bold"> <?php echo $nombreNivelUno; ?> *</label>
                    <select name="selSubSistema" id="selSubSistema" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_nivelUno as $dat_nivel_uno) {

                            $sub_codigo = $dat_nivel_uno['sub_codigo'];
                            $sub_nombre = $dat_nivel_uno['sub_nombre'];
                            $sub_referencia = $dat_nivel_uno['sub_referencia'];
                            $sub_ref = $dat_nivel_uno['sub_ref'];

                            $dscrpcion = $sub_referencia.$sub_ref."  ".$sub_nombre
                        ?>
                            <option value="<?php echo $sub_codigo; ?>"><?php echo $dscrpcion; ?> ...</option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_sub_sistema" role="alert"></div>
                </div>
            </div>
            
        </div>

        <div class="row subsistema" style="display: none;">
            <div class="col-md-8">
                <br>
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelSubSistema('<?php echo $plan_desarrollo; ?>');"><i class="fas fa-file-excel fa-lg">&nbsp;Asignaci&oacute;n de Recursos Plan de Acci&oacute;n Por <?php echo $nombreNivelUno; ?></i> </button> </div> 
            </div>
        </div>

        <div class="row proyecto" style="display: none;">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="selNivelUno" class="font-weight-bold"> <?php echo $nombreNivelUno; ?> *</label>
                    <select name="selNivelUno" id="selNivelUno" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_nivelUno as $dat_nivel_uno) {
                            $sub_codigo = $dat_nivel_uno['sub_codigo'];
                            $sub_nombre = $dat_nivel_uno['sub_nombre'];
                            $sub_referencia = $dat_nivel_uno['sub_referencia'];
                            $sub_ref = $dat_nivel_uno['sub_ref'];

                            $dscrpcion = $sub_referencia.$sub_ref."  ".$sub_nombre
                        ?>
                            <option value="<?php echo $sub_codigo; ?>" data-nombreNivelDos="<?php echo $nombreNivelDos; ?>" data-codigouno="<?php echo $sub_codigo; ?>"><?php echo $dscrpcion; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_nivel_uno" role="alert"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group nivel_dos">
                    
                </div>
            </div>
        </div>
        <div class="row proyecto_excel" style="display: none;">
            <div class="col-sm-12">
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelProyecto('<?php echo $plan_desarrollo; ?>');"><i class="fas fa-file-excel fa-lg" >&nbsp;Asignaci&oacute;n de Recursos Plan de Acci&oacute;n Por <?php echo $nombreNivelDos; ?></i> </button></div> 
            </div>
        </div>

        <div class="row accion" style="display: none;">
            <div class="col-sm-12 selAccion">

            </div>
        </div>

        <div class="row accion_excel" style="display: none;">
            <div class="col-sm-12">
                <br>
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelAccion('<?php echo $plan_desarrollo; ?>');"><i class="fas fa-file-excel fa-lg" >&nbsp;Asignaci&oacute;n de Recursos Plan de Acci&oacute;n Por <?php echo $nombreNivelTres; ?></i> </button></div> 
            </div>
        </div>

        <div class="row actividad" style="display: none;">
            <div class="col-sm-12 selActividad">

            </div>
        </div>

        <div class="row actividad_excel" style="display: none;">
            <div class="col-sm-12">
                <br>
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelActividad('<?php echo $plan_desarrollo; ?>');"><i class="fas fa-file-excel fa-lg" >&nbsp;Asignaci&oacute;n de Recursos Plan de Acci&oacute;n Por Actividad</i> </button></div> 
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

    $('.radioReporte').click(function(){
        var chkrprte = $('input:radio[name=chkrprte]:checked').val();

        if(chkrprte == 1){//Todo
            $('.todo').fadeIn(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeOut(100);
            $('.proyecto_excel').fadeOut(100);
            $('.accion').fadeOut(100);
            $('.accion_excel').fadeOut(100);
            $('.actividad').fadeOut(100);
            $('.actividad_excel').fadeOut(100);
        }

        if(chkrprte == 2){//Sub sistema
            $('.todo').fadeOut(100);
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeOut(100);
            $('.proyecto_excel').fadeOut(100);
            $('.accion').fadeOut(100);
            $('.accion_excel').fadeOut(100);
            $('.actividad').fadeOut(100);
            $('.actividad_excel').fadeOut(100);
        }

        if(chkrprte == 3){//Proyecto
            $('.todo').fadeOut(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeIn(100);
            $('.proyecto_excel').fadeIn(100);
            $('.accion').fadeOut(100);
            $('.accion_excel').fadeOut(100);
            $('.actividad').fadeOut(100);
            $('.actividad_excel').fadeOut(100);
        }

        if(chkrprte == 4){//Acción
            $('.todo').fadeOut(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeIn(100);
            $('.proyecto_excel').fadeOut(100);
            $('.accion').fadeIn(100);
            $('.accion_excel').fadeIn(100);
            $('.actividad').fadeOut(100);
            $('.actividad_excel').fadeOut(100);
        }

        if(chkrprte == 5){//Actividad
            $('.todo').fadeOut(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeIn(100);
            $('.proyecto_excel').fadeOut(100);
            $('.accion').fadeIn(100);
            $('.accion_excel').fadeOut(100);
            $('.actividad').fadeIn(100);
            $('.actividad_excel').fadeIn(100);
        }


    });

    $('#selNivelUno').change(function(){
        var codigo_nivelUno=$(this).find(':selected').data('codigouno');
        var nombreNivelDos=$(this).find(':selected').data('nombreniveldos');
        if(codigo_nivelUno==0){

        }
        else{
            $.ajax({
                url:"selectniveldos",
                type:"POST",
                data:"codigo_nivelUno="+codigo_nivelUno+'&nombreNivelDos='+nombreNivelDos,
                async:true,

                success: function(message){
                    $(".nivel_dos").empty().append(message);
                }
            });
        }
    });
    
    /*$('#selNivelTres').change(function(){
        //plan_desarrollo
        var codigo_nivelUno=$(this).find(':selected').data('codigouno');
        var nombreNivelDos=$(this).find(':selected').data('nombreniveldos');

        if(codigo_nivelUno==0){

        }
        else{
            $.ajax({
                url:"selectniveldos",
                type:"POST",
                data:"codigo_nivelUno="+codigo_nivelUno+'&nombreNivelDos='+nombreNivelDos,
                async:true,

                success: function(message){
                    $(".nivel_dos").empty().append(message);
                }
            });
        }
    });*/

    function generarCompleto(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
		var vigencia = $('#selVigencia').val();

        if(vigencia == 0){
            $('.error_vigencia').fadeIn(100);
            $('.error_vigencia').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('.error_vigencia').fadeOut(100);
        }

		window.location.href = 'rprteasgncionrcrsosplnaccion?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia;        
    }

    function gnerarExcelSubSistema(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var vigencia = $('#selVigencia').val();
        var selSubSistema = $('#selSubSistema').val();
        
        if(vigencia == 0){
            $('.error_vigencia').fadeIn(100);
            $('.error_vigencia').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('.error_vigencia').fadeOut(100);
        }

        if(selSubSistema == 0){
            $('#error_sub_sistema').fadeIn(1);
            $('#error_sub_sistema').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_sub_sistema').fadeOut(1);
            $('#error_sub_sistema').html('');
        }

        window.location.href = 'rprteasgncionrcrsosplnaccionxsubsstma?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia+'&sub_sistema='+selSubSistema;        

    }

    function gnerarExcelProyecto(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var vigencia = $('#selVigencia').val();
        var selNivelUno = $('#selNivelUno').val();
        var selNivelDos = $('#selNivelDos').val();
        
        if(vigencia == 0){
            $('.error_vigencia').fadeIn(100);
            $('.error_vigencia').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('.error_vigencia').fadeOut(100);
        }

        if(selNivelUno == 0){
            $('#error_nivel_uno').fadeIn(1);
            $('#error_nivel_uno').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_uno').fadeOut(1);
            $('#error_nivel_uno').html('');
        }

        if(selNivelDos == 0){
            $('#error_nivel_dos').fadeIn(1);
            $('#error_nivel_dos').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_dos').fadeOut(1);
            $('#error_nivel_dos').html('');
        }

        window.location.href = 'rprteasgncionrcrsosplnaccionxprycto?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia+'&sub_sistema='+selNivelUno+'&proyecto_cod='+selNivelDos;                
    }

    function gnerarExcelAccion(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var vigencia = $('#selVigencia').val();
        var selNivelUno = $('#selNivelUno').val();
        var selNivelDos = $('#selNivelDos').val();
        var selNivelTres = $('#selNivelTres').val();
        
        if(vigencia == 0){
            $('.error_vigencia').fadeIn(100);
            $('.error_vigencia').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('.error_vigencia').fadeOut(100);
        }

        if(selNivelUno == 0){
            $('#error_nivel_uno').fadeIn(1);
            $('#error_nivel_uno').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_uno').fadeOut(1);
            $('#error_nivel_uno').html('');
        }

        if(selNivelDos == 0){
            $('#error_nivel_dos').fadeIn(1);
            $('#error_nivel_dos').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_dos').fadeOut(1);
            $('#error_nivel_dos').html('');
        }

        if(selNivelTres == 0){
            $('#error_nivel_tres').fadeIn(1);
            $('#error_nivel_tres').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_tres').fadeOut(1);
            $('#error_nivel_tres').html('');
        }

        window.location.href = 'rprteasgncionrcrsosplnaccionxaccion?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia+'&sub_sistema='+selNivelUno+'&proyecto_cod='+selNivelDos+'&accion_cod='+selNivelTres;                
    }

    function gnerarExcelActividad(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var vigencia = $('#selVigencia').val();
        var selNivelUno = $('#selNivelUno').val();
        var selNivelDos = $('#selNivelDos').val();
        var selNivelTres = $('#selNivelTres').val();
        var selActividad = $('#selActividad').val();
        
        if(vigencia == 0){
            $('.error_vigencia').fadeIn(100);
            $('.error_vigencia').html('Debe seleccionarse una Opción');
            return false;
        }
        else{
            $('.error_vigencia').fadeOut(100);
        }

        if(selNivelUno == 0){
            $('#error_nivel_uno').fadeIn(1);
            $('#error_nivel_uno').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_uno').fadeOut(1);
            $('#error_nivel_uno').html('');
        }

        if(selNivelDos == 0){
            $('#error_nivel_dos').fadeIn(1);
            $('#error_nivel_dos').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_dos').fadeOut(1);
            $('#error_nivel_dos').html('');
        }

        if(selNivelTres == 0){
            $('#error_nivel_tres').fadeIn(1);
            $('#error_nivel_tres').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_nivel_tres').fadeOut(1);
            $('#error_nivel_tres').html('');
        }

        if(selActividad == 0){
            $('#error_actividad').fadeIn(1);
            $('#error_actividad').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_actividad').fadeOut(1);
            $('#error_actividad').html('');
        }

        window.location.href = 'rprteasgncionrcrsosplnaccionxactvdad?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia+'&sub_sistema='+selNivelUno+'&proyecto_cod='+selNivelDos+'&accion_cod='+selNivelTres+'&actividad_cod='+selActividad;                
    }


    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerOficina').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
