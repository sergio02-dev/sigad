<?php
    $trimestre= Array('Seleccione...','1','2','3','4'); 

    include('crud/rs/plnDsrrllo.php');
    $rs_responsable=$objRsPlanDesarrollo->responsable();

    $list_oficina = $objRsPlanDesarrollo->list_oficina();

    $list_cargo = $objRsPlanDesarrollo->list_cargo();

    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];   
    if($codigo_planDesarrollo){

        $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
        $rs_PlanDesarrolloForm=$objRsPlanDesarrollo->PlanDesarrolloForm();

        foreach($rs_PlanDesarrolloForm as $dataPlanDesarrolloForm){
            $pde_codigo = $dataPlanDesarrolloForm['pde_codigo'];
            $pde_nombre = $dataPlanDesarrolloForm['pde_nombre'];
            $pde_yearinicio = $dataPlanDesarrolloForm['pde_yearinicio'];
            $pde_yearfin = $dataPlanDesarrolloForm['pde_yearfin'];
            $pde_actoadmin = $dataPlanDesarrolloForm['pde_actoadmin'];
            $pde_niveluno = $dataPlanDesarrolloForm['pde_niveluno'];
            $pde_niveldos = $dataPlanDesarrolloForm['pde_niveldos'];
            $pde_niveltres = $dataPlanDesarrolloForm['pde_niveltres'];
            $pde_referencianiveluno = $dataPlanDesarrolloForm['pde_referencianiveluno'];
            $pde_referencianiveldos = $dataPlanDesarrolloForm['pde_referencianiveldos'];
            $pde_responsable = $dataPlanDesarrolloForm['pde_responsable'];
            $pde_oficina = $dataPlanDesarrolloForm['pde_oficina'];
        }
        $url_guardar="crudupdateplandesarrollo";
        $task = "MODIFICAR";
    }
    else{
        $url_guardar="crudregistroplandesarrollo";
        $task = "REGISTRAR";

    }

?>
<form id="plandesarrolloform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task;?> PLAN DE DESARROLLO INSTITUCIONAL</strong></h4>
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
                        for ($yinicio = 2015; $yinicio < 2030; $yinicio++) {
                            if($pde_yearinicio==$yinicio){
                                $select_yinicio="selected";
                            }
                            else{
                                $select_yinicio="";
                            }
                            
                            echo "<option value=".$yinicio." ".$select_yinicio."> ".$yinicio."</option>";
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
                        for ($yfin = 2015; $yfin < 2030; $yfin++) {
                            if($pde_yearfin==$yfin){
                                $select_yfin="selected";
                            }
                            else{
                                $select_yfin="";
                            }
                            
                            echo "<option value=".$yfin." ".$select_yfin."> ".$yfin."</option>";
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

                            $aad_codigo=$dataActoAdministrativo['aad_codigo'];
                            $add_nombre=$dataActoAdministrativo['add_nombre'];

                            if($pde_actoadmin==$aad_codigo){
                                $selected_actoAdminstrativo="selected";
                            }
                            else{
                                $selected_actoAdminstrativo="";
                            }
                        ?>
                            <option value="<?php echo  $aad_codigo; ?>" <?php echo $selected_actoAdminstrativo; ?>><?php echo substr($add_nombre,0,100); ?> ...</option>
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

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="txtNivelUno" class="font-weight-bold">Nivel Uno *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNivelUno" name="txtNivelUno" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_niveluno; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtReferenciaNivelUno" class="font-weight-bold">Refenercia Nivel Uno *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtReferenciaNivelUno" name="txtReferenciaNivelUno" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_referencianiveluno; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="txtNivelDos" class="font-weight-bold">Nivel Dos *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNivelDos" name="txtNivelDos" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_niveldos; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtReferenciaNivelDos" class="font-weight-bold">Referencia Nivel Dos *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtReferenciaNivelDos" name="txtReferenciaNivelDos" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_referencianiveldos; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="txtNivelTres" class="font-weight-bold">Nivel Tres *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNivelTres" name="txtNivelTres" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $pde_niveltres; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>


        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $pde_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_formplandesarrollo();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroPlanDesarrollo.js"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerOficina').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
