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
            <div class="col-md-12 accordion-container">
                <div class="container">
                    <div id="accordion" class="accordion">
                        <div class="card mb-0">

                            <div class="card-header collapsed acoIndicadores" data-codigo_accion="<?php echo $codigo_accion; ?>" data-toggle="collapse" href="#collapse" >
                                <a class="card-title">
                                    <strong>INDICADORES </strong>
                                </a>
                            </div>
                            <div id="collapse" class="card-body collapse acccionactividad" data-parent="#accordion" >
                                <p>
                                    Cargando...
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
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
                    <input type="number" class="form-control caja_texto_sizer recursodisponible" id="recursoAccion" name="recursoAccion" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $poa_recurso;?>" required>
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

        <h6><strong>CLASIFICADOR PRESUPUESTAL</strong></h6><hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="codigoClasificador" class="font-weight-bold">Codigo </label>
                    <input type="number" class="form-control caja_texto_sizer" id="codigoClasificador" name="codigoClasificador" maxlength="35" aria-describedby="textHelp" data-rule-required="false" value="<?php echo $poa_codigoclasificadorpresupuestal; ?>" >
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtDescripcionClasificador" class="font-weight-bold">Descripción</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcionClasificador" id="txtDescripcionClasificador" aria-describedby="textHelp" data-rule-required="false"><?php echo $poa_descripcionclasificador; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>  
        </div>
        <!--<div class="row">
            <div class="col-md-11 rcrsos" style="display:<?php echo $recursoss; ?>">
                <div class="form-group">
                    <label for="selFuenteFinanciacion" class="font-weight-bold"> Fuente Financiación*</label>
                    <select name="selFuenteFinanciacion" id="selFuenteFinanciacion" class="form-control caja_texto_sizer fuente_clasificador selectpickerfuente" data-rule-required="true" >
                        <option value="0" data-fuente="0">Seleccione...</option>;

                        <?php
                        foreach($fuentes_inversion as $dta_fuents_inversion){
                            $ffi_codigo = $dta_fuents_inversion['ffi_codigo'];
                            $ffi_nombre = $dta_fuents_inversion['ffi_nombre'];
                            $ffi_referencialinix = $dta_fuents_inversion['ffi_referencialinix'];
                            $ffi_codigolinix = $dta_fuents_inversion['ffi_codigolinix'];

                            if($ffi_codigo == $poa_fuente){
                                $select_fuente  = "selected";
                            }
                            else{
                                $select_fuente = "";
                            }
                        ?>
                           
                            <option value="<?php echo $ffi_codigo; ?>" data-fuente="<?php echo $ffi_referencialinix; ?>" <?php echo $select_fuente; ?>><?php echo $ffi_nombre; ?></option>;
                        <?php
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11 rcrsos" style="display:<?php echo $recursoss; ?>">
                <div class="form-group clasificador_codigo">
                    <label for="codigoClasificador" class="font-weight-bold"> Codigo Clasificador Presupuestal *</label>
                    <select name="codigoClasificador" id="codigoClasificador" class="form-control caja_texto_sizer selectpickerclasificador" data-rule-required="true" required>
                        
                        <?php
                        if($codigo_poai){
                        ?>
                            <option value="0" >Seleccione...</option>
                        <?php
                            $ref_fuente = $objPlanAccion->ref_fuente($poa_fuente);
                            $codigos_presupuestales = $objPlanAccion->codigos_presupuestales($ref_fuente);
                            foreach($codigos_presupuestales as $dta_codgos_presupuestales){
                                $ccp_codigo = $dta_codgos_presupuestales['ccp_codigo'];
                                $ccp_code = $dta_codgos_presupuestales['ccp_code'];
                                $ccp_descripcion = $dta_codgos_presupuestales['ccp_descripcion'];
                                $ccp_fuente = $dta_codgos_presupuestales['ccp_fuente'];

                                if($ccp_codigo == $poa_codigoclasificadorpresupuestal){
                                    $select_codigo = "selected";
                                }
                                else{
                                    $select_codigo = "";
                                }
                            ?>
                               <option value="<?php echo $ccp_codigo; ?>" <?php echo $select_codigo; ?>><?php echo $ccp_code." - ".substr($ccp_descripcion,0,60); ?> ...</option>;
                            <?php
                            }
                        }
                        else{
                        ?>
                            <option value="0">Seleccione una Fuente de Financiación</option>;
                        <?php
                        }
                        
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>-->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtDane" class="font-weight-bold">DANE </label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtDane" name="txtDane" maxlength="34" aria-describedby="textHelp" data-rule-required="false" value="<?php echo $poa_dane; ?>" >
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


    $('.recursodisponible').change(function(){
        /*var rcso = $('#recursoAccion').val();

        if(rcso>0){
            $('.rcrsos').fadeIn(1);
        }
        else{
            $('.rcrsos').fadeOut(1);
        }*/
    });

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

    $(".acoIndicadores").click(function(){
        var codigo_accion = $(this).data("codigo_accion");

        $.ajax({
            url: "infoindicadoresetapa",
            type:"POST",
            data:{
                    codigo_accion:codigo_accion,
                },
            async:true,

            success: function(message){
                $(".acccionactividad").empty().append(message);
            }
        });

    });
</script>