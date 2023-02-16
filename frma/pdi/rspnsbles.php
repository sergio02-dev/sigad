<?php
    include('crud/rs/plnDsrrllo.php');

    $codigo_nivel = $_REQUEST['codigo_nivel'];
    $nivel = $_REQUEST['nivel'];
    $codigo_responsable = $_REQUEST['codigo_responsable']; 
    $codigo_plan = $_REQUEST['codigo_plan'];
    $tipo_responsable = $_REQUEST['tipo_responsable'];


    $list_responsbles = $objRsPlanDesarrollo->list_responsbles($codigo_nivel, $nivel);
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    if($nivel == 1){
        $tpo = "RESPONSABLE";
        $nombre_form = $objRsPlanDesarrollo->nombre_uno($codigo_nivel);
    }

    if($nivel == 2){
        $tpo = "RESPONSABLE";
        $nombre_form = $objRsPlanDesarrollo->nombre_dos($codigo_nivel);
    }
    if ($nivel == 3) {
        $tpo = "RESPONSABLE";
    }

    if($nivel == 3){
        if($tipo_responsable == 1){
            $tpo = "RESPONSABLE";
        }
        else if($tipo_responsable == 2){
           $tpo = "ORDENADOR DEL GASTO";
        }
        else if ($tipo_responsable == 3){
            $tpo = "AUTORIZA EL GASTO";
        }
        else {
            $tpo = "ASIGNACION DE RECURSOS";
        }
        
        $nombre_form = $objRsPlanDesarrollo->nombre_tres($codigo_nivel);
        
    }

    $list_clasificacion = $objRsPlanDesarrollo->list_clasificacion();

    $list_oficina = $objRsPlanDesarrollo->list_oficina();

    $list_cargo = $objRsPlanDesarrollo->list_cargo();

    if($codigo_responsable){

        $rs_form_responsable = $objRsPlanDesarrollo->form_responsable($codigo_responsable);

        foreach($rs_form_responsable as $dta_form_responsable){
            $res_codigo = $dta_form_responsable['res_codigo'];
            $res_nivel = $dta_form_responsable['res_nivel'];
            $res_codigonivel = $dta_form_responsable['res_codigonivel'];
            $res_codigocargo = $dta_form_responsable['res_codigocargo'];
            $res_codigooficina = $dta_form_responsable['res_codigooficina'];
            $res_estado = $dta_form_responsable['res_estado'];
            $res_clasificacion = $dta_form_responsable['res_clasificacion'];

            if($res_estado == 1){
                $checkedA = "checked";
                $checkedI = "";
            }

            if($res_estado == 0){
                $checkedA = "";
                $checkedI = "checked";
            }
        }
        $url_guardar="modificarresponsable";
        $task = "MODIFICAR";

        if($nivel == 2){
            $capa_direccion = "#rsponsables_info".$codigo_nivel;
            $url_direccion = "inforesponsable?codigo_nivel=".$codigo_nivel."&nivel=".$nivel;;
        }
        if($nivel == 3){
            $capa_direccion = "#tabla_indicador";
            $url_direccion = "dataindicador?codigo_planDesarrollo=".$codigo_plan."&codigo_accion=".$codigo_nivel;
        }
        
    }
    else{
        $url_guardar="registroresponsable";
        $task = "REGISTRAR";
        $checkedA = "checked";
        $checkedI = "";

        if($nivel == 2){
            $capa_direccion = "#rsponsables_info".$codigo_nivel;
            $url_direccion = "inforesponsable?codigo_nivel=".$codigo_nivel."&nivel=".$nivel;;
        }
        if($nivel == 3){
            $capa_direccion = "#registroIndicador".$codigo_nivel;
            $url_direccion = "indicador?codigo_planDesarrollo=".$codigo_plan."&codigo_accion=".$codigo_nivel;
        }
    }
?>
<form id="rsponsableform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task." ".$tpo; ?> - <?php echo strtoupper(tildes($nombre_form)); ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selOficina" class="font-weight-bold"> Oficina *</label>
                    <select name="selOficina" id="selOficina" class="form-control caja_texto_sizer selectpickerOficina" data-size="8" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($list_oficina as $data_oficina) {
                            $ofi_codigo = $data_oficina['ofi_codigo'];
                            $ofi_nombre = $data_oficina['ofi_nombre'];

                            if($res_codigooficina == $ofi_codigo){
                                $selectOficina = "selected";
                            }
                            else{
                                $selectOficina = "";
                            }
                        ?>
                            <option value="<?php echo  $ofi_codigo; ?>" <?php echo $selectOficina; ?>><?php echo substr($ofi_nombre,0,100); ?> ... </option>
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
                    <label for="selResponsable" class="font-weight-bold"> Responsable *</label>
                    <select name="selResponsable" id="selResponsable" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($list_cargo as $data_cargo) {
                            $car_codigo = $data_cargo['car_codigo'];
                            $car_nombre = $data_cargo['car_nombre'];

                            if($res_codigocargo == $car_codigo){
                                $selectRsponsable="selected";
                            }
                            else{
                                $selectRsponsable="";
                            }
                        ?>
                            <option value="<?php echo  $car_codigo; ?>" <?php echo $selectRsponsable; ?>><?php echo substr($car_nombre,0,100); ?> ... </option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <?php 
            if($tipo_responsable == 1){
        ?>
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selRegistroOrdenador" class="font-weight-bold"> Ordenador del gasto*</label>
                    <select name="selRegistroOrdenador" id="selRegistroOrdenador" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        $ror_ordenador = $objRsPlanDesarrollo->codigo_registro_ordenador($res_codigo);
                        foreach ($list_responsbles as $data_responsbles_gastos) {
                            $res_codigo = $data_responsbles_gastos['res_codigo'];
                            $res_codigooficina = $data_responsbles_gastos['res_codigooficina'];
                            $res_codigocargo = $data_responsbles_gastos['res_codigocargo'];
                            
                     

                            if($ror_ordenador == $res_codigo){
                                $selectOrdenador="selected";
                            }
                            else{
                                $selectOrdenador="";
                            }
                                        
                            $nbre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                            $nbre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);

                            $ordenador = $nbre_oficina.'-'.$nbre_cargo;
                        ?>
                            <option value="<?php echo  $res_codigo; ?>" <?php echo $selectOrdenador; ?>><?php echo $ordenador; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <?php 
            }
        ?>
        <?php 
            if($tipo_responsable == 3){
        ?>

        
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selClasificacion" class="font-weight-bold"> Clasificacion*</label>
                    <select name="selClasificacion" id="selClasificacion" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($list_clasificacion as $data_clasificacion) {
                            $cla_codigo = $data_clasificacion['cla_codigo'];
                            $cla_nombre = $data_clasificacion['cla_nombre'];

                            if($res_clasificacion == $cla_codigo){
                                $selectClasificacion="selected";
                            }
                            else{
                                $selectClasificacion="";
                            }
                        ?>
                            <option value="<?php echo  $cla_codigo; ?>" <?php echo $selectClasificacion; ?>><?php echo $cla_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio" id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span>&nbsp;Activo&nbsp;&nbsp;</span> </label>

                        <input type="radio" id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span>&nbsp;Inactivo</span> </label>
                    </div>
                </div>
            </div>
        </div>
       

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="tipo_responsable" id="tipo_responsable" value="<?php echo $tipo_responsable; ?>">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="nivel" id="nivel" value="<?php echo $nivel; ?>">
        <input type="hidden" name="codigo_nivel" id="codigo_nivel" value="<?php echo $codigo_nivel; ?>">
        <input type="hidden" name="codigo_responsable" id="codigo_responsable" value="<?php echo $codigo_responsable; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar" class="btn btn-danger" onClick="validar_responsable();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_responsable.js"></script>
<script type="text/javascript">

    $('.selectpickerOficina').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

</script>
