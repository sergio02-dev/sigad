<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/prsna.php');

    $codigo_persona = $_REQUEST['codigo_persona'];
    $codigo_vinculacion = $_REQUEST['codigo_vinculacion'];

    $list_oficina = $objRsPersona->list_oficina();
    $list_cargo = $objRsPersona->list_cargo();
    $nombre_persona = $objRsPersona->nombre_persona($codigo_persona);

    if($codigo_vinculacion){
        $vinculacionForm = $objRsPersona->vinculacion_form($codigo_vinculacion);
        foreach ($vinculacionForm as $dta_vnclacion) {
            $vin_codigo = $dta_vnclacion['vin_codigo'];
            $vin_persona = $dta_vnclacion['vin_persona'];
            $vin_oficina = $dta_vnclacion['vin_oficina'];
            $vin_cargo = $dta_vnclacion['vin_cargo'];
            $vin_estado = $dta_vnclacion['vin_estado'];
        }


        if($vin_estado == 1){
            $checkedA="checked";
            $checkedI="";
        }
        if($vin_estado == 0){
            $checkedA="";
            $checkedI="checked";
        }

        $url_direccion = "infoprsona?codigo_persona=".$codigo_persona;
        $capa_direccion = "#infoPersona".$codigo_persona;
        $url_proceso="modificarvinculacion";
        $task = "MODIFICAR";
    }
    else{
        $url_direccion = "datapersona";
        $capa_direccion = "#persona";
        $url_proceso="registrovinculacion";
        $task = "REGISTRAR";
        $checkedA="checked";
    }
   
?>
<form id="vinculacionform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> VINCULACI&Oacute;N <?php echo strtoupper(tildes($nombre_persona)); ?> </strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
    
    <div class="row">
        <div class="col-sm-11">
            <div class="form-group">
                <label for="selOficina" class="font-weight-bold"> Oficina *</label>
                <select name="selOficina" id="selOficina" class="form-control caja_texto_sizer selectpickerOficina" data-size="10" data-rule-required="true" required>
                    <option value="0">Seleccione...</option>
                    <?php
                        foreach ($list_oficina as $data_list_oficina) {
                            $ofi_codigo = $data_list_oficina['ofi_codigo'];
                            $ofi_nombre = $data_list_oficina['ofi_nombre'];

                        if($vin_oficina == $ofi_codigo){
                            $select_oficina = "selected";
                        }
                        else{
                            $select_oficina = "";
                        }
                    ?>
                        <option value="<?php echo  $ofi_codigo; ?>"  <?php echo $select_oficina; ?>><?php echo substr($ofi_nombre,0,80); ?> ...</option>
                    <?php
                        }
                    ?>
                </select>
                <span class="help-block" id="error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-11">
            <div class="form-group">
                <label for="selCargo" class="font-weight-bold"> Cargo </label>
                <select name="selCargo" id="selCargo" class="form-control caja_texto_sizer selectpickerCargo" data-rule-required="true" required>
                    <option value="0">Seleccione...</option>
                    <?php
                        foreach ($list_cargo as $data_list_cargo) {
                            $car_codigo = $data_list_cargo['car_codigo'];
                            $car_nombre = $data_list_cargo['car_nombre'];

                        if($vin_cargo == $car_codigo){
                            $select_cargo = "selected";
                        }
                        else{
                            $select_cargo = "";
                        }
                    ?>
                        <option value="<?php echo $car_codigo; ?>" <?php echo $select_cargo; ?>><?php echo $car_nombre; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <span class="help-block" id="error"></span>
            </div>
        </div>        
    </div>

    <div class="row">
        
        <div class="col-sm-6">
            <div class="form-group">
                <label for="chkestado" class="font-weight-bold">Estado *</label>
                <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> <?php echo $sololectura; ?> required/>
                    <label for="ractivo"><span></span> &nbsp;Activo</label> &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> <?php echo $sololectura; ?> required />
                    <label for="rinactivo"><span></span> &nbsp;Inactivo</label>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
    <input type="hidden" id="codigo_vinculacion" name="codigo_vinculacion" value="<?php echo $codigo_vinculacion; ?>">
        <input type="hidden" id="url_proceso" name="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" id="codigo_persona" name="codigo_persona" value="<?php echo $codigo_persona; ?>">
        <input type="hidden" id="url_direccion" name="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" id="capa_direccion" name="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <button type="button" class="btn btn-secondary caja_texto_sizer" data-dismiss="modal"><strong>Cerrar</strong></button>
        <button type="submit" id="botonGuardar" class="btn btn-danger caja_texto_sizer" onclick="validar_vinculacion();"><i class="far fa-save"></i> <strong>Guardar</strong> </button>
    </div>
</form>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_vinculacion.js"></script>

<script type="text/javascript">
    $('.selectpickerOficina').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });

    $('.selectpickerCargo').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });
</script>