<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('crud/rs/areas/areas.php'); 

    $codigo_areas = $_REQUEST['codigo_areas'];

    if($codigo_areas){
        $url_guardar="modificarareas";
        $task = "MODIFICAR AREAS";

        $form_areas = $objAreas->form_areas($codigo_areas);

        foreach ($form_areas as $dat_area) {
            $are_codigo = $dat_area['are_codigo'];
            $are_nombre = $dat_area['are_nombre'];
            $are_estado = $dat_area['are_estado'];
        }
        
        if($are_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }
    else{
        $url_guardar="registroareas";
        $task = "REGISTRAR AREAS";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaAreas";
    $url_direccion = "dtaareas";
    
?>
<form id="areasfrm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $are_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_areas" id="codigo_areas" value="<?php echo $codigo_areas; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_areas();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>

<script src="vjs/areas/vldar_areas.js"></script>



