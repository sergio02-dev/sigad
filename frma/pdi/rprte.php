<?php
    include('crud/rs/plnDsrrllo.php');

    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo']; 
    
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
    $nombreNivelUno = $objRsPlanDesarrollo->nivelUnoNombre();
    $nombreNivelDos = $objRsPlanDesarrollo->nivelDosNombre();
    $rs_nivelUno = $objRsPlanDesarrollo->nivelUno(); 
    
    $task = "REPORTE PDI";
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
                    <label for="textNumeroVeces" class="font-weight-bold">Reporte PDI *</label>
                    <div class="radio tipo1">
                        <input type="radio" id="rcompleto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedCompleto; ?> required/>
                        <label for="rcompleto"><span>&nbsp;Completo&nbsp;&nbsp;</span> </label>

                        <input type="radio" id="rsubsistema" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="2" required />
                        <label for="rsubsistema"><span>&nbsp;Por <?php echo $nombreNivelUno; ?>&nbsp;&nbsp;</span> </label>

                        <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="3" required />
                        <label for="rproyecto"><span>&nbsp;Por <?php echo $nombreNivelDos; ?></span> </label>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger alerta-forcliente" id="error_estado" role="alert"></div>
        </div>

        <div class="row todo" style="display: block;">
            <div class="col-md-12">
                
                <div class="d-inline-block"><button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelTodo('<?php echo $codigo_planDesarrollo; ?>');"> <i class="fas fa-file-excel fa-lg" >&nbsp; PDI Completo</i> </button></div> 
            </div>
        </div>

        <div class="row subsistema" style="display: none;">
            <div class="col-sm-6">
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

                            $dscrpcion = $sub_referencia.$sub_ref." ".$sub_nombre
                        ?>
                            <option value="<?php echo $sub_codigo; ?>"><?php echo $dscrpcion; ?> ...</option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_sub_sistema" role="alert"></div>
                </div>
            </div>
            <div class="col-md-6">
                <br>
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelSubSistema('<?php echo $codigo_planDesarrollo; ?>');"><i class="fas fa-file-excel fa-lg">&nbsp; PDI Por <?php echo $nombreNivelUno; ?></i> </button> </div> 
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

                            $dscrpcion = $sub_referencia.$sub_ref." ".$sub_nombre
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
        <div class="row proyecto" style="display: none;">
            <div class="col-sm-12">
                <div class="d-inline-block"> <button type="button" class="btn btn-danger btn-sm" onclick="gnerarExcelProyecto('<?php echo $codigo_planDesarrollo; ?>');"><i class="fas fa-file-excel fa-lg" >&nbsp; PDI Por <?php echo $nombreNivelDos; ?></i> </button></div> 
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $pde_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroPlanDesarrollo.js"></script>
<script type="text/javascript">

    $('.radioReporte').click(function(){
        var chkrprte = $('input:radio[name=chkrprte]:checked').val();

        if(chkrprte == 1){
            $('.todo').fadeIn(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeOut(100);
        }

        if(chkrprte == 2){
            $('.todo').fadeOut(100);
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeOut(100);
        }

        if(chkrprte == 3){
            $('.todo').fadeOut(100);
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeIn(100);
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

    function gnerarExcelTodo(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        //alert(codigo_plandesarrollo);

        if(codigo_plandesarrollo == 1){
            window.location.href = 'reporteplandesarrolloantiguo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        else{
            window.location.href = 'excelplandesarrollo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        
    }

    function gnerarExcelSubSistema(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var selSubSistema = $('#selSubSistema').val();
        
        if(selSubSistema == 0){
            $('#error_sub_sistema').fadeIn(1);
            $('#error_sub_sistema').html('Seleccione una Opción');
            return false;
        }
        else{
            $('#error_sub_sistema').fadeOut(1);
            $('#error_sub_sistema').html('');
        }

        if(codigo_plandesarrollo == 1){
            window.location.href = 'reporteplandesarrolloantiguo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        else{
            window.location.href = 'excelpdixsubsistema?codigo_plandesarrollo='+codigo_plandesarrollo+'&sub_sistema='+selSubSistema;
        }
    }

    function gnerarExcelProyecto(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        var selNivelUno = $('#selNivelUno').val();
        var selNivelDos = $('#selNivelDos').val();
        
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


        if(codigo_plandesarrollo == 1){
            window.location.href = 'reporteplandesarrolloantiguo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        else{
            window.location.href = 'excelpdixproyecto?codigo_plandesarrollo='+codigo_plandesarrollo+'&sub_sistema='+selNivelUno+'&proyecto_sub='+selNivelDos;
        }
        
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
