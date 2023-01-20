<?php
    include('crud/rs/plnDsrrllo.php');

    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];   
    $codigo_NivelTres=$_REQUEST['codigo_NivelTres']; 
    $codigoIndicador=$_REQUEST['codigoIndicador'];

    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);

    $datosPlanDesarrollo=$objRsPlanDesarrollo->datosPlan();

    foreach($datosPlanDesarrollo as $data_datosPlan){
        $pde_yearinicio=$data_datosPlan['pde_yearinicio'];
        $pde_yearfin=$data_datosPlan['pde_yearfin'];
    }

    $totalInsert=($pde_yearfin-$pde_yearinicio)+1;
    $tendencia=$objRsPlanDesarrollo->tendencia();

    $list_sedes = $objRsPlanDesarrollo->list_sedes();

    $tipo_comportamiento=$objRsPlanDesarrollo->tipo_comportamiento();
    
    if($codigoIndicador){

        $rs_indicador=$objRsPlanDesarrollo->indicadorForm($codigoIndicador);

        foreach($rs_indicador as $dataIndicador){
            $ind_codigo=$dataIndicador['ind_codigo'];
            $ind_unidadmedida=$dataIndicador['ind_unidadmedida'];
            $ind_lineabase=$dataIndicador['ind_lineabase'];
            $ind_metaresultado=$dataIndicador['ind_metaresultado'];
            $ind_accion=$dataIndicador['ind_accion'];
            $ind_tipocomportamiento=$dataIndicador['ind_tipocomportamiento'];
            $ind_tendencia=$dataIndicador['ind_tendencia'];
            $ind_sede = $dataIndicador['ind_sede'];
        }
        $url_guardar="crudupdateindicador"; 
        $task = "MODIFICAR";   
    }
    else{
        $url_guardar="crudindicador";
        $task = "REGISTRAR";
    }

?>
<form id="indicadorform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> INDICADORES</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtUnidadMedida" class="font-weight-bold">Descripci&oacute;n del Indicador *</label>
                    <textarea class="form-control caja_texto_sizer" rows="2" id="txtUnidadMedida" name="txtUnidadMedida" data-rule-required="true" required><?php echo $ind_unidadmedida; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                     <label for="txtLineaBase" class="font-weight-bold">Linea Base *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtLineaBase" name="txtLineaBase" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ind_lineabase; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtMetaResultado" class="font-weight-bold">Meta Resultado *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtMetaResultado" name="txtMetaResultado" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ind_metaresultado; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selTipoComportamiento" class="font-weight-bold"> Tipo de Comportamiento *</label>
                    <select name="selTipoComportamiento" id="selTipoComportamiento" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($tipo_comportamiento as $data_tipoComportamiento) {

                            $tco_codigo=$data_tipoComportamiento['tco_codigo'];
                            $tco_nombre=$data_tipoComportamiento['tco_nombre'];

                            if($ind_tipocomportamiento==$tco_codigo){
                                $select_comportamiento="selected";
                            }
                            else{
                                $select_comportamiento="";
                            }
                        ?>
                            <option value="<?php echo  $tco_codigo; ?>"  <?php echo $select_comportamiento; ?>><?php echo $tco_nombre; ?></option>
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
                    <label for="selTendencia" class="font-weight-bold"> Tendencia *</label>
                    <select name="selTendencia" id="selTendencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($tendencia as $data_tendencia) {

                            $ten_codigo=$data_tendencia['ten_codigo'];
                            $ten_nombre=$data_tendencia['ten_nombre'];

                            if($ind_tendencia==$ten_codigo){
                                $select_ten="selected";
                            }
                            else{
                                $select_ten="";
                            }
                        ?>
                            <option value="<?php echo  $ten_codigo; ?>"  <?php echo $select_ten; ?> ><?php echo $ten_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selSedes" class="font-weight-bold"> Sede *</label>
                    <select name="selSedes" id="selSedes" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        if($list_sedes){
                            foreach ($list_sedes as $data_sedes) {

                                $sed_codigo = $data_sedes['sed_codigo'];
                                $sed_nombre = $data_sedes['sed_nombre'];

                                if($ind_sede==$sed_codigo){
                                    $select_sde="selected";
                                }
                                else{
                                    $select_sde="";
                                }
                        ?>
                            <option value="<?php echo  $sed_codigo; ?>"  <?php echo $select_sde; ?> ><?php echo $sed_nombre; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        

        

        <?php 
            for($inicioIndicadorVigencia=$pde_yearinicio; $inicioIndicadorVigencia<=$pde_yearfin; $inicioIndicadorVigencia++){

                if($codigoIndicador){
                    $indicador_vigencia=$objRsPlanDesarrollo->indicadorVigenciaForm($codigoIndicador, $inicioIndicadorVigencia);
                    foreach($indicador_vigencia as $data_indicadorVigencia){
                        $ivi_codigo=$data_indicadorVigencia['ivi_codigo'];
                        $ivi_valorlogrado=$data_indicadorVigencia['ivi_valorlogrado'];
                        $ivi_presupuesto=$data_indicadorVigencia['ivi_presupuesto'];
                    }
                }


        ?>
        <div class="form-group">
            <label for="txtVigencia" class="font-weight-bold"> <?php echo $inicioIndicadorVigencia; ?></label>
            <input type="hidden" class="form-control caja_texto_sizer" id="txtVigencia" name="txtVigencia[]" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $inicioIndicadorVigencia; ?>" required readonly>
            <hr>
        </div>
        

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtValorLogro<?php echo $inicioIndicadorVigencia; ?>" class="font-weight-bold">Unidad *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtValorLogro<?php echo $inicioIndicadorVigencia; ?>" name="txtValorLogro[]" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ivi_valorlogrado; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtPresupuesto<?php echo $inicioIndicadorVigencia; ?>" class="font-weight-bold">Presupuesto *</label>
                    <input type="text" class="form-control caja_texto_sizer pspsto" id="txtPresupuesto<?php echo $inicioIndicadorVigencia; ?>" name="txtPresupuesto[]" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($ivi_presupuesto,0,'','.'); ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        


        <?php
        
            }

        ?>

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="totalInsert" value="<?php echo $totalInsert; ?>">
        <input type="hidden" name="codigo_planDesarrollo" id="codigo_planDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="codigoAccion" id="codigoAccion" value="<?php echo $codigo_NivelTres; ?>">
        <input type="hidden" name="codigoIndicador" id="codigoIndicador" value="<?php echo $codigoIndicador; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="boton_guarda_modifica" class="btn btn-danger" onClick="validarIndicador();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>


<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroIndicadores.js"></script>
<script type="text/javascript">

$(".pspsto").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});
</script>
