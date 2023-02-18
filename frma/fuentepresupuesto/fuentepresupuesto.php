<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 * 24 de enero 2023 15:41pm
 * Clase Fuente presupuesto
 * cambio de formulario, excedente de facultad
 * hola 
 *
 */
    include('crud/rs/fuentepresupuesto/fuentepresupuesto.php'); 

    $codigo_fuentepresupuesto = $_REQUEST['codigo_fuentepresupuesto'];

    if($codigo_fuentepresupuesto){
        $url_guardar="modificarfuentepresupuesto";
        $task = "MODIFICAR FUENTE PRESUPUESTO";

        $form_fuente_presupuesto = $objFuentePresupuesto->form_fuente_presupuesto($codigo_fuentepresupuesto);

        foreach ($form_fuente_presupuesto as $dat_fuente_presupuesto) {
            $fup_codigo = $dat_fuente_presupuesto['fup_codigo'];
            $fup_linix = $dat_fuente_presupuesto['fup_linix'];
            $fup_nombre = $dat_fuente_presupuesto['fup_nombre'];
            $fup_estado = $dat_fuente_presupuesto['fup_estado'];
            $fup_excfacultad = $dat_fuente_presupuesto['fup_excfacultad'];  
        }
        
        if($fup_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        
        }

        

        if($fup_excfacultad == 1){
            $checkedFacultad = "checked";
        }
        else{
            $checkedFacultad = "";
        
        }
        
            
        
    }
    else{
        $url_guardar="registrofuentepresupuesto";
        $task = "REGISTRAR FUENTE PRESUPUESTO";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaFuentePresupuesto";
    $url_direccion = "dtafuentepresupuesto";
    
?>
<form id="fuentepresupuestofrm" role="form">
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
                    <label for="txtCodigoLinix" class="font-weight-bold">Codigo Linix *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtCodigoLinix" name="txtCodigoLinix" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $fup_linix; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $fup_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        
      
         
        <div class="row">
            <div class="col-sm-12">
                    <div class="radio tipo1">
                        <input type="checkbox"   id="check_facultad" name="checkFacultad" aria-describedby="textHelp"  data-rule-required="true" value="1" <?php echo $checkedFacultad; ?> />
                        <label for="check_facultad"><span></span>Excedentes de Facultad</label>
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
        <input type="hidden" name="codigo_fuentepresupuesto" id="codigo_fuentepresupuesto" value="<?php echo $codigo_fuentepresupuesto; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_fuentepresupuesto();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>

<script src="vjs/fuentepresupuesto/vldar_fuente_presupuesto.js"></script>

