<?php
    include('crud/rs/oficinafuente/oficinafuente.php'); 

    $list_oficina = $objOficinafuente->list_oficina(); 
    $list_cargo = $objOficinafuente->list_cargo();
    $list_fuente = $objOficinafuente->list_fuente(); 

 

    $codigo_oficina= $_REQUEST['codigo_oficina'];
    $codigo_cargo= $_REQUEST['codigo_cargo'];


    if($codigo_vicerrectoria){
        $url_guardar="modificarfuenteoficina";
        $task = "MODIFICAR FUENTE OFICINA";

        $form_vicerrectoria = $objVicerrectoria->form_vicerrectoria($codigo_vicerrectoria);

        foreach ($form_ as $dat_vcrtrias) {
            $ent_codigo = $dat_vcrtrias['ent_codigo'];
            $ent_nombre = $dat_vcrtrias['ent_nombre'];
            $ent_estado = $dat_vcrtrias['ent_estado'];
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
        $url_guardar="registrooficinafuente";
        $task = "REGISTRAR OFICINA FUENTE";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaOficinafuente";
    $url_direccion = "dtaoficinafuente";
    
?>
<form id="oficinafuentefrm" role="form">
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
                    <label for="txtOficina" class="font-weight-bold">Oficina</label>
                    <select name="selOficina" class="form-control caja_texto_sizer" id="selOficina" aria-describedby="textHelp" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                            foreach ($list_oficina as $dat_oficina) {
                                $ofi_codigo = $dat_oficina['ofi_codigo'];
                                $ofi_nombre = $dat_oficina['ofi_nombre'];
                        ?>
                            <option value="<?php echo  $ofi_codigo; ?>"><?php echo $ofi_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span> 
                
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txtCargo" class="font-weight-bold">Cargo</label>
                        <select name="selCargo" class="form-control caja_texto_sizer" id="selCa" aria-describedby="textHelp" data-rule-required="true" required>
                            <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($list_cargo as $dat_cargo) {
                                        $codigo_cargo = $dat_cargo['car_codigo'];
                                        $nombre_cargo = $dat_cargo['car_nombre'];
                                ?>
                                    <option value="<?php echo  $codigo_cargo; ?>"><?php echo $nombre_cargo; ?></option>
                                <?php
                                    }
                                ?>
                            
                        </select>
                        <span class="help-block" id="error"></span> 
                    
                    </div>
                </div>
            </div>

        <div class="row">
            <strong>Fuentes</strong>
      
            <div class="col-sm-12">
                <div class="bg">
                    <div>
                    <?php
                        if($list_fuente){
                            foreach ($list_fuente as $data_fuente) {
                                $ffi_codigo=$data_fuente['ffi_codigo'];
                                $ffi_nombre=$data_fuente['ffi_nombre'];


                    ?>
                        <div class="chiller_cb">
                            <input id="fuente<?php echo $ffi_codigo; ?>" name="fuente[]" type="checkbox" value="<?php echo $ffi_codigo; ?>" data-rule-required="true" required >
                            <label for="fuente<?php echo $ffi_codigo; ?>" class="caja_texto_sizer"><?php echo $ffi_nombre; ?></label>
                            <span></span>
                        </div>
                        <?php
                                    
                               
                            }//Foreach Menu
                        }//if Menu
                        ?>
                    </div>
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
        <input type="hidden" name="codigo_vicerrectoria" id="codigo_vicerrectoria" value="<?php echo $codigo_oficina; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_oficinafuente();"><i class="far fa-save"></i> Guardar</button>
    </div> 
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/oficinafuente/vldar_oficinafuente.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


