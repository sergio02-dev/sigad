<?php
    include('crud/rs/fcltades/fcltades.php'); 

    $codigo_facultades = $_REQUEST['codigo_facultades'];

    if($codigo_facultades){
        $url_guardar="modificarfacultades";
        $task = "MODIFICAR FACULTADES";

        $form_facultades = $objFacultades->form_facultades($codigo_facultades);

        foreach ($form_facultades as $dat_fcltades) {
            $ent_codigo = $dat_fcltades['ent_codigo'];
            $ent_nombre = $dat_fcltades['ent_nombre'];
            $ent_estado = $dat_fcltades['ent_estado'];
        }
        
        if($ent_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }
    else{
        $url_guardar="registrofacultades";
        $task = "REGISTRAR FACULTADES";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaFacultades";
    $url_direccion = "dtafacultades";
    
?>
<form id="facultadesfrm" role="form">
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
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ent_nombre; ?>" required>
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
        <input type="hidden" name="codigo_facultades" id="codigo_facultades" value="<?php echo $codigo_facultades; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_facultades();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/fcltades/vldar_facultades.js"></script>



