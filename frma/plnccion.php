<?php

   $codigo_actividad = $_REQUEST['codigo_actividad'];
   $referenciaActividad = $_REQUEST['referenciaActividad'];
   $codigo_poai = $_REQUEST['codigo_poai'];
   $codigo_accion = $_REQUEST['codigo_accion'];
   $codigo_sede = $_REQUEST['codigo_sede'];                                                                                                                                                                                                                                                                                                                                                                                                                        

   include('crud/rs/plnccion.php');

   $descripcionActividad=$objPlanAccion->descripcion_poai($codigo_actividad);

   $fuentes_inversion = $objPlanAccion->fuentes_inversion();

   list($anio_start, $anio_stop) = $objPlanAccion->list_anios_plan($codigo_accion);


    if($codigo_poai){

        $updatepoai=$objPlanAccion->formUpdatePoai($codigo_poai);
        foreach($updatepoai as $dataFormPoai){
            $poa_codigo = $dataFormPoai['poa_codigo'];
            $poa_referencia = $dataFormPoai['poa_referencia'];
            $poa_objeto = $dataFormPoai['poa_objeto'];
            $poa_recurso = $dataFormPoai['poa_recurso'];
            $poa_logro = $dataFormPoai['poa_logro'];
            $poa_estado = $dataFormPoai['poa_estado'];
            $poa_numero = $dataFormPoai['poa_numero'];
            $poa_logroejecutado = $dataFormPoai['poa_logroejecutado'];
            $poa_vigencia = $dataFormPoai['poa_vigencia'];
            $poa_codigoclasificadorpresupuestal = $dataFormPoai['poa_codigoclasificadorpresupuestal'];
            $poa_descripcionclasificador = $dataFormPoai['poa_descripcionclasificador'];
            $poa_dane = $dataFormPoai['poa_dane'];
            $poa_plancompras = $dataFormPoai['poa_plancompras'];
        }
        

        if($poa_estado=='1'){
            $checkedA="checked";    
            $checkedI="";
        }
        if($poa_estado=='0') {
            $checkedA="";
            $checkedI="checked";
        }

        if($poa_recurso == 0){
            $recursoss = "none";
        }
        else{
            $recursoss = "block";
        }

        if($poa_plancompras == 1){
            $planCmpras = "checked";
        }
        else{
            $planCmpras = "";
        }

        $url_guardar="crudupdatepoai";
        $codigo_formulario = $poa_codigo;
        $tarea = "MODIFICAR";
    }
    else{
        $url_guardar="crudregistroplanaccion";
        $codigo_formulario = $codigo_actividad;
        $tarea = "REGISTRAR";
        $poa_vigencia = 2022;
        $checkedA="checked";
        $checkedI="";
        $recursoss = "block";
        $planCmpras = "";
    }
?>

<form id="planAccionform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title"><strong><?php echo $tarea; ?> ETAPAS</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <p class="font-weight-bold">* Campos obligatorios &nbsp;&nbsp;&nbsp; <a href="<?php echo $enlace; ?>help/planAccion.pdf" title='Ayuda' alt='Ayuda' target='_blank' style="text-decoration: none;">  <strong style="color:#BC0D04; ">Ayuda</strong> <i class="fas fa-question fa-lg" style="color: #BC0D04;"></i> </a> </p>
        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 113%;"><strong>Actividad <?php echo $referenciaActividad."</strong> <br>".$descripcionActividad; ?></p>
                <input type="hidden" class="form-control caja_texto_sizer" id="referenciaActividad" name="referenciaActividad" aria-describedby="textHelp" data-rule-required="true" readonly value="<?php echo $referenciaActividad; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="objetoAccion" class="font-weight-bold">Etapa *</label>
                    <textarea class="form-control caja_texto_sizer" name="objetoAccion" id="objetoAccion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $poa_objeto; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="recursoAccion" class="font-weight-bold">Recursos *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="recursoAccion" name="recursoAccion" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $poa_recurso;?>" required>
                    <span class="help-block" style="color:#a70e06; font-size: 14 px; font-family: Arial, Helvetica, sans-serif; font-weight: bold" id="error_etapa"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="logroAccion" class="font-weight-bold">Peso de la Etapa % *</label>
                    <input type="number" class="form-control caja_texto_sizer"  id="logroAccion" name="logroAccion" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $poa_logro; ?>" required>
                    <span class="help-block" style="color:#a70e06; font-size: 14 px; font-family: Arial, Helvetica, sans-serif; font-weight: bold" id="error_valor"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="logroEjecutado" class="font-weight-bold">Avance Inicial de la Etapa % *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="logroEjecutado" name="logroEjecutado" aria-describedby="textHelp" data-rule-required="false" value="<?php echo $poa_logroejecutado; ?>" >
                    <span class="help-block" id="error"></span>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vigenciaActividad" class="font-weight-bold"> Vigencia*</label>
                    <select name="vigenciaActividad" id="vigenciaActividad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <?php
                        for ($vigencia = $anio_start; $vigencia <= $anio_stop; $vigencia++) {
                            if($poa_vigencia==$vigencia){
                                $select_vigencia="selected";
                            }
                            else{
                                $select_vigencia="";
                            }
                            echo "<option value=".$vigencia." ".$select_vigencia."> ".$vigencia."</option>";
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-md-4">  
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> <?php echo $sololectura; ?> required/>
                    <label for="ractivo">&nbsp; Activo &nbsp;&nbsp;</label>

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> <?php echo $sololectura; ?> required />
                    <label for="rinactivo">&nbsp; Inactivo</label>

                    </div>

                    <span class="help-block" id="error"></span>

                </div>
            </div>           
        </div>      

    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_formulario" id="codigo_formulario" value="<?php echo $codigo_formulario; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" name="avacanceActividad" id="avacanceActividad" value="<?php echo $poa_logro; ?>">
        
        <input type="hidden" name="codigo_sede" id="codigo_sede" value="<?php echo $codigo_sede; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="codigoActividad" id="codigoActividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_formregistroactividad();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroPlanAccion.js"></script>

<script type="text/javascript">

    $('.fuente_clasificador').change(function(){
        var fuente = $(this).find(':selected').data('fuente');

        if(fuente == 0){

        }
        else{
            $.ajax({
                url: "codigoclasificadorpresuestal",
                type:"POST",
                data: "fuente="+fuente,
                async:true,

                success: function(message){
                    $(".clasificador_codigo").empty().append(message);
                }
            });
        }
    });

    $('.selectpickerfuente').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerclasificador').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

</script>