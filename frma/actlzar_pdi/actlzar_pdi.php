<?php
    include('crud/rs/plnDsrrllo.php');

    $rs_responsable=$objRsPlanDesarrollo->responsable();

    $list_oficina = $objRsPlanDesarrollo->list_oficina();

    $list_cargo = $objRsPlanDesarrollo->list_cargo();

    $codigo_plandesarrollo = $_REQUEST['codigo_plandesarrollo'];   
    if($codigo_plandesarrollo){

        $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_plandesarrollo);
        $rs_PlanDesarrolloForm=$objRsPlanDesarrollo->PlanDesarrolloForm();

        foreach($rs_PlanDesarrolloForm as $dat_plan_desarrollo){
            $pde_codigo = $dat_plan_desarrollo['pde_codigo'];
            $pde_yearinicio = $dat_plan_desarrollo['pde_yearinicio'];
            $pde_yearfin = $dat_plan_desarrollo['pde_yearfin'];
            $pde_actoadmin = $dat_plan_desarrollo['pde_actoadmin'];
        }

        $url_guardar="crudactualizarpdi";
        $task = "ACTUALIZAR";
    }

?>
<form id="actualizarplanform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task;?> PDI PLAN INDICATIVO</strong></h4>
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
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>    
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="vigenciaActividad" class="font-weight-bold"> Año Inicio *</label>
                    <select name="selYearInicio" id="selYearInicio" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        for ($yinicio = $pde_yearinicio; $yinicio <= $pde_yearfin; $yinicio++) {
                                                        
                            echo "<option value=".$yinicio."> ".$yinicio."</option>";
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-sm-6">       
                <div class="form-group">
                    <label for="selYearFin" class="font-weight-bold"> Año Fin *</label>
                    <select name="selYearFin" id="selYearFin" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        for ($yfin = $pde_yearinicio; $yfin <= $pde_yearfin; $yfin++) {
                                                    
                            echo "<option value=".$yfin."> ".$yfin."</option>";
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
                    <label for="selActoAdmin" class="font-weight-bold"> Acuerdo de Consejo Superior *</label>
                    <select name="selActoAdmin" id="selActoAdmin" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_ActoAdministrativo as $dataActoAdministrativo) {
                            $aad_codigo = $dataActoAdministrativo['aad_codigo'];
                            $add_nombre = $dataActoAdministrativo['add_nombre'];

                        ?>
                            <option value="<?php echo  $aad_codigo; ?>"><?php echo substr($add_nombre,0,50); ?> ...</option>
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
                    <label for="selOficina" class="font-weight-bold"> Oficina *</label>
                    <select name="selOficina" id="selOficina" class="form-control caja_texto_sizer selectpickerOficina" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($list_oficina as $data_oficina) {
                            $ofi_codigo = $data_oficina['ofi_codigo'];
                            $ofi_nombre = $data_oficina['ofi_nombre'];

                            if($pde_oficina == $ofi_codigo){
                                $selectOficina="selected";
                            }
                            else{
                                $selectOficina="";
                            }
                        ?>
                            <option value="<?php echo  $ofi_codigo; ?>" <?php echo $selectOficina; ?> title="<?php echo $ofi_nombre; ?>" ><?php echo substr($ofi_nombre,0,100); ?> ...</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div  class="col-sm-11">
                <div class="form-group">
                    <label for="selResponsable" class="font-weight-bold"> Responsable *</label>
                    <select name="selResponsable" id="selResponsable" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($list_cargo as $dta_list_cargos) {
                            $car_codigo = $dta_list_cargos['car_codigo'];
                            $car_nombre = $dta_list_cargos['car_nombre'];

                            if($pde_responsable == $car_codigo){
                                $selectResponsable="selected";
                            }
                            else{
                                $selectResponsable="";
                            }
                        ?>
                            <option value="<?php echo  $car_codigo; ?>" <?php echo $selectResponsable; ?>><?php echo $car_nombre; ?></option>
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
        <input type="hidden" name="codigo_plandesarrollo" id="codigo_plandesarrollo" value="<?php echo $pde_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_actualizar_plan();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/actlzar_pdi/vldar_actlzar_pdi.js"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
