<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/plnDsrrllo.php');

    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];   
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];   
    $codigo_niveluno=$_REQUEST['codigo_niveluno'];
    
    $rs_responsable=$objRsPlanDesarrollo->responsable();

    $list_oficina = $objRsPlanDesarrollo->list_oficina();

    $list_cargo = $objRsPlanDesarrollo->list_cargo();

   $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
   $nivelUnoNombre=$objRsPlanDesarrollo->nivelUnoNombre();

    if($codigo_niveluno){
        $rs_nivelUno=$objRsPlanDesarrollo->updateNivelUno($codigo_niveluno);

        foreach($rs_nivelUno as $data_nivelUno){
            $sub_nombre=$data_nivelUno['sub_nombre'];
            $sub_referencia=$data_nivelUno['sub_referencia'];
            $sub_codigo=$data_nivelUno['sub_codigo'];
            $sub_ref =$data_nivelUno['sub_ref'];
            $res_codigo=$data_nivelUno['res_codigo'];
        }
        $url_guardar="crudupdateniveluno";

        $referencia_nivelUno=$sub_referencia;
        $task = "MODIFICAR";

        $responsable_level_one = $objRsPlanDesarrollo->responsable_level_one($codigo_niveluno);
        if($responsable_level_one){
            foreach ($responsable_level_one as $dta_responsable_level_one) {
                $res_level_codigo = $dta_responsable_level_one['res_codigo'];
                $res_codigocargo = $dta_responsable_level_one['res_codigocargo'];
                $res_codigooficina = $dta_responsable_level_one['res_codigooficina'];

            }
        }
    }
    else{
        $referencia_nivelUno=$_REQUEST['referencia_nivelUno'];
        $url_guardar="crudniveluno";
        $task = "REGISTRAR";
    }
?>
<form id="nivelunoform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> NIVEL UNO: <?php echo strtoupper(tildes($nivelUnoNombre)); ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $sub_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
    

        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="txtReferenciaUno" class="font-weight-bold">Referencia *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtReferenciaUno" name="txtReferenciaUno" aria-describedby="textHelp" data-rule-required="true"  value="<?php echo $referencia_nivelUno; ?>" readonly >
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="txtReferenciaCompleta" class="font-weight-bold">&nbsp;</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtReferenciaCompleta" name="txtReferenciaCompleta" aria-describedby="textHelp"  data-rule-required="true" value="<?php echo $sub_ref; ?>" >
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

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
                    <label for="selCargo" class="font-weight-bold"> Responsable *</label>
                    <select name="selCargo" id="selCargo" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
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
       

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="tipo_responsable" id="tipo_responsable" value="1">
        <input type="hidden" name="res_level_codigo" id="res_level_codigo" value="<?php echo $res_level_codigo; ?>">
        <input type="hidden" name="selResponsable" id="selResponsable" value="0">
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="actoAdministrativo" id="actoAdministrativo" value="<?php echo $actoAdministrativo; ?>">
        <input type="hidden" name="codigoNivelUno" id="codigoNivelUno" value="<?php echo $sub_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_niveluno();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelUno.js"></script>
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
