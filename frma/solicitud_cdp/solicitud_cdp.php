<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_plan = $objSolicitudCdp->codigo_plan();

    $nombre_nivel_tres = $objSolicitudCdp->nombre_nivel_tres($codigo_plan);

    $plan_accion_consulta = $objSolicitudCdp->plan_accion_consulta($codigo_plan);

    

    // $resolucionFecha = $objSolicitudCdp->resolucionFecha();

  
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    



    $url_guardar="registrosolicitudcdp";
    $task = "REGISTRAR SOLICITUD CDP";
    $fecha_solicitud = date('Y-m-d');
    $checkedA = "checked";
    $checkedI = "";
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="solicitudcdpform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->

        


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtFechaSolicitud" class="font-weight-bold">Fecha de Solicitud </label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFechaSolicitud" name="txtFechaSolicitud" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $fecha_solicitud ; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_fecha_solicitud" role="alert"></div>
                </div>
            </div>
        

        
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtnumero" class="font-weight-bold">Numero de solicitud </label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtnumero" name="txtnumero" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $numero_consecutivo ; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_numero_solicitud" role="alert"></div>
                </div>
            </div>
        
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtObjetoCDP" class="font-weight-bold">Objeto </label>
                    <textarea class="form-control caja_texto_sizer" name="txtObjetoCDP" id="txtObjetoCDP" aria-describedby="textHelp" data-rule-required="false"></textarea>
                    <div class="alert alert-danger alerta-forcliente" id="error_objeto_solicitud" role="alert"></div>
              
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selAccion" class="font-weight-bold"><?php echo $nombre_nivel_tres; ?> *</label>
                    <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0" data-codigo_accion="0"> Seleccione ...</option>
                        <?php
                            if($plan_accion_consulta){
                                foreach ($plan_accion_consulta as $dta_plan_accion_consulta) {
                                    $acc_codigo = $dta_plan_accion_consulta['acc_codigo'];
                                    $acc_referencia = $dta_plan_accion_consulta['acc_referencia'];
                                    $acc_numero = $dta_plan_accion_consulta['acc_numero'];
                                    $acc_descripcion = $dta_plan_accion_consulta['acc_descripcion'];

                                    $dscrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

                            
                        ?>
                            <option value="<?php echo  $acc_codigo; ?>" data-codigo_accion="<?php echo $acc_codigo; ?>" <?php echo $selected_accion; ?>><?php echo substr($dscrpcion,0,100); ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay <?php echo $nombre_nivel_tres; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_accion" role="alert"></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#selAccion').change(function(){
                var codigo_accion = $(this).find(':selected').data('codigo_accion');
                
                if(codigo_accion == 0){

                }
                else{
                    $.ajax({
                        url:"actividadsolicitudcdp",
                        type:"POST",
                        data:"codigo_accion="+codigo_accion,
                        async:true,

                        success: function(message_uno){
                            
                            $("#actvdades_lista").empty().append(message_uno);
                        }
                    });                    
                }
                
            });
        </script>



        <div class="row">
            <div class="col-sm-12" >
                <div class="form-group" id="actvdades_lista">
                   
                </div>

            </div>
        </div>



        <div class="row">
            <div class="col-sm-12" id="etpas_lista">
                
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
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
            </div>
        </div>

        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_solicitud" id="codigo_solicitud" value="<?php echo $codigo_solicitud; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_solicitud_cdp();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_solicitud_cdp.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

