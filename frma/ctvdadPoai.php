<?php
include('crud/rs/ctvdadPoai.php');
$codigo_actividad=$_REQUEST['codigo_actividad'];
$codigo_subsistema=$_REQUEST['codigo_subsistema'];
$codigo_proyecto=$_REQUEST['codigo_proyecto'];
$codigo_accion=$_REQUEST['codigo_accion'];
$referenciaAccion=$_REQUEST['referenciaAccion'];


list($anio_start, $anio_stop) = $objActividadPaoi->list_anios_plan($codigo_accion);

$list_sedes = $objActividadPaoi->list_sedes($codigo_accion);

$descripcion=$objActividadPaoi->descripcion_accion($codigo_accion);
$trimestre= Array('Seleccione...','1','2','3','4');
$tarea=$_REQUEST['tarea'];

if($codigo_actividad){
    $actividadRealiza=$objActividadPaoi->formActividadPoai($codigo_actividad);
    foreach($actividadRealiza as $dataformActividadPoai){
        $acp_codigo = $dataformActividadPoai['acp_codigo'];
        $acp_descripcion = $dataformActividadPoai['acp_descripcion'];
        $acp_estado = $dataformActividadPoai['acp_estado'];
        $acp_vigencia = $dataformActividadPoai['acp_vigencia'];
        $acp_objetivo = $dataformActividadPoai['acp_objetivo'];
        $acp_sedeindicador = $dataformActividadPoai['acp_sedeindicador'];
        $acp_unidad = $dataformActividadPoai['acp_unidad'];
    }

    if($acp_estado=='1'){
        $checkedA="checked";
        $checkedI="";
    }

    if($acp_estado=='0') {
        $checkedA="";
        $checkedI="checked";
    }

    $url_guardar="crudupdateactividadpoai";
    $tarea = "MODIFICAR";
}
else{
    $url_guardar="crudregistroactividadpoai";
    $checkedA = "checked";
    $tarea = "REGISTRAR";
    $acp_vigencia = 2022;
}

 ?>

<form id="actividaPoaiform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $tarea; ?> ACTIVIDAD</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 110%;"><strong>Acción <?php echo $referenciaAccion."</strong> <br>".$descripcion; ?></p>
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
                    <label for="textActividad" class="font-weight-bold"> Actividad *</label>
                    <textarea class="form-control caja_texto_sizer" name="textActividad" id="textActividad" aria-describedby="textHelp" data-rule-required="true" required><?php echo $acp_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="textObjetivo" class="font-weight-bold"> Objetivo *</label>
                    <textarea class="form-control caja_texto_sizer" name="textObjetivo" id="textObjetivo" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $acp_objetivo; ?></textarea>
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
                            if($acp_vigencia==$vigencia){
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
            
            
        </div>
        <div class="bg">
                <table class="table table-sm">
                    <tr>
                        <th>Sede - Indicador</th>
                        <th>Unidad</th>
                    </tr>
                        <?php
                        foreach ($list_sedes as $data_sede) {
                            $ind_codigo = $data_sede['ind_codigo'];
                            $ind_unidadmedida = $data_sede['ind_unidadmedida'];
                            $sed_nombre = $data_sede['sed_nombre'];

                            $dscrpcion = $sed_nombre . " - " . $ind_unidadmedida;

                    

                        ?>
                        <tr>
                            <td>
                                <div class="chiller_cb">
                                    <input id="selSedes<?php echo $ind_codigo;?>" name="selSedes[]" type="checkbox" value="<?php echo $ind_codigo; ?> " data-rule-required="true" required >
                                    <label for="selSedes<?php echo $ind_codigo; ?>" class="caja_texto_sizer"> <?php echo $dscrpcion;?></label>    
                                    <span></span>
                                   
                                </div>
                            </td>
                            <td>
                                    <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="number" min="1" class="form-control caja_texto_sizer" name="<?php echo $ind_codigo; ?>" aria-describedby="textHelp"  value="<?php echo $acp_unidad;?>" >
                                                <span class="help-block" id="error"></span>
                                            </div>
                                    </div>
                            </td>
                        </tr>
                        <?php
                            }//if Menu
                        ?>

                </table>


        <div class="col-md-4">
                
            </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                    <label for="ractivo"><span></span> Activo</label>

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                    <label for="rinactivo"><span></span> Inactivo</label>

                    </div>

                    <span class="help-block" id="error"></span>
                    <span class="help-block" style="color:#F90909 " id="error_valor"></span>
                </div>
            </div>
        </div>
        
    </div>
    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="referenciaAccion" name="referenciaAccion" value="<?php echo $referenciaAccion; ?>">
        <input type="hidden" name="codigoActividad" id="codigoActividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="codigo_subsistema" id="codigo_subsistema" value="<?php echo $codigo_subsistema; ?>">
        <input type="hidden" name="codigo_proyecto" id="codigo_proyecto" value="<?php echo $codigo_proyecto; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_formActividadPoai();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroPoai.js"></script>

<script>
    $('.selectpicker').selectpicker({
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
