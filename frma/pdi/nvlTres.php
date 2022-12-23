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
    $codigo_NivelTres=$_REQUEST['codigo_NivelTres'];
    $rs_responsable=$objRsPlanDesarrollo->responsable();
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
    $nombreNivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
    $nombreNivelDos=$objRsPlanDesarrollo->nivelDosNombre();
    $nombreNivelTres=$objRsPlanDesarrollo->nivelTresNombre();
    
    $rs_nivelUno=$objRsPlanDesarrollo->nivelUno(); 

    $tendencia=$objRsPlanDesarrollo->tendencia();

    $tipo_comportamiento=$objRsPlanDesarrollo->tipo_comportamiento();


    if($codigo_NivelTres){

        $rs_niveltres=$objRsPlanDesarrollo->updateNivelTres($codigo_NivelTres);

        foreach($rs_niveltres as $dataNivelTresForm){
            $acc_codigo=$dataNivelTresForm['acc_codigo'];
            $acc_referencia=$dataNivelTresForm['acc_referencia'];
            $acc_descripcion=$dataNivelTresForm['acc_descripcion'];
            $sub_codigo=$dataNivelTresForm['sub_codigo'];
            $acc_proyecto=$dataNivelTresForm['acc_proyecto'];
            $acc_comportamiento=$dataNivelTresForm['acc_comportamiento'];
            $acc_tendenciapositiva=$dataNivelTresForm['acc_tendenciapositiva'];
            $acc_indicador=$dataNivelTresForm['acc_indicador'];
            $acc_numero=$dataNivelTresForm['acc_numero'];
            $acc_lineabase=$dataNivelTresForm['acc_lineabase'];
            $acc_metaresultado=$dataNivelTresForm['acc_metaresultado'];
            $acc_responsable=$dataNivelTresForm['acc_responsable'];
        }

        $refrencia=$acc_referencia;
        $url_guardar="crudupdateniveltres";
        $task = "MODIFICAR";

        $plan_compras_accion = $objRsPlanDesarrollo->plan_compras_accion($codigo_NivelTres);
        if($plan_compras_accion){
            foreach ($plan_compras_accion as $dta_plan_compras) {
                $pca_codigo = $dta_plan_compras['pca_codigo'];
                $pca_accion = $dta_plan_compras['pca_accion'];
                $pca_plantafisica = $dta_plan_compras['pca_plantafisica'];
            }
            $checkedPlanCompras = "checked";
            $ver_plan_compras = "block";

            if($pca_plantafisica == 1){
                $checkedPlantaFisica = "checked";
            }
            else{
                $checkedPlantaFisica = "";
            }
        }
        else{
            $checkedPlanCompras = "";
            $checkedPlantaFisica = "";
            $ver_plan_compras = "none";
        }

    }
    else{
        $url_guardar="crudniveltres";
        $acc_proyecto=$_REQUEST['codigoNivelDos'];
        $sub_codigo=$_REQUEST['codigoNivelUno'];
        $refrencia=$_REQUEST['ref'];
        $task = "REGISTRAR";
        $ver_plan_compras = "none";
    }

?>
<form id="niveldosform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> NIVEL TRES: <?php echo strtoupper(tildes($nombreNivelTres)); ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="selNivelUno" class="font-weight-bold"> <?php echo $nombreNivelUno; ?> *</label>
                    <select name="selNivelUno" id="selNivelUno" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_nivelUno as $data_nivelUno) {

                            $sub_codigoNvlUno=$data_nivelUno['sub_codigo'];
                            $sub_nombre=$data_nivelUno['sub_nombre'];
                            $sub_referencia=$data_nivelUno['sub_referencia'];
                            $sub_ref=$data_nivelUno['sub_ref'];

                            if($sub_codigoNvlUno==$sub_codigo){
                                $select_nivelUno="selected";
                            }
                            else{
                                $select_nivelUno="";
                            }
                        ?>
                            <option value="<?php echo  $sub_codigoNvlUno; ?>"  <?php echo $select_nivelUno; ?> data-codigouno="<?php echo $sub_codigoNvlUno; ?>" data-nombreniveldos="<?php echo $nombreNivelDos; ?>" ><?php echo $sub_referencia.$sub_ref.". ".$sub_nombre;; ?></option>
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
                <div class="form-group" id="selectNivelDos">
                    <label for="selNivelDos" class="font-weight-bold"> <?php echo $nombreNivelDos; ?> *</label>
                    <select name="selNivelDos" id="selNivelDos" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        if($sub_codigo){

                        $rs_nivelDos=$objRsPlanDesarrollo->nivelDos($sub_codigo);
                        foreach ($rs_nivelDos as $data_nivelDos) {

                            $pro_codigo=$data_nivelDos['pro_codigo'];
                            $pro_referencia=$data_nivelDos['pro_referencia'];
                            $pro_descripcion=$data_nivelDos['pro_descripcion'];
                            $pro_numero=$data_nivelDos['pro_numero'];
                    
                            $referencialDos=$pro_referencia.".".$pro_numero;
                            if($pro_codigo==$acc_proyecto){
                                $selected_proyecto="selected";
                            }
                            else{
                                $selected_proyecto="";
                            }
                        ?>
                            <option value="<?php echo  $pro_codigo; ?>" <?php echo $selected_proyecto; ?>><?php echo substr($referencialDos.". ".$pro_descripcion,0,100); ?> ...</option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        
        <!--<div class="form-group">
            <label for="selTipoComportamiento" class="font-weight-bold"> Tipo de Comportamiento *</label>
            <select name="selTipoComportamiento" id="selTipoComportamiento" class="form-control caja_texto_sizer" data-rule-required="true" required>
                <option value="0">Seleccione...</option>
                <?php
                 foreach ($tipo_comportamiento as $data_tipoComportamiento) {

                    $tco_codigo=$data_tipoComportamiento['tco_codigo'];
                    $tco_nombre=$data_tipoComportamiento['tco_nombre'];

                    if($acc_comportamiento==$tco_codigo){
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

        <div class="form-group">
            <label for="selTendencia" class="font-weight-bold"> Tendencia *</label>
            <select name="selTendencia" id="selTendencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
                <option value="0">Seleccione...</option>
                <?php
                 foreach ($tendencia as $data_tendencia) {

                    $ten_codigo=$data_tendencia['ten_codigo'];
                    $ten_nombre=$data_tendencia['ten_nombre'];

                    if($acc_tendenciapositiva==$ten_codigo){
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
        </div>-->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Descripci&oacute;n <?php echo $nombreNivelTres; ?>*</label>
                    <textarea class="form-control caja_texto_sizer" rows="5" id="txtNombre" name="txtNombre" data-rule-required="true" required><?php echo $acc_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="radio tipo1">
                        <input type="checkbox"   id="checkplandecompras" name="checkplandecompras" aria-describedby="textHelp"  value="1" <?php echo $checkedPlanCompras; ?> />
                        <label for="checkbox"><span></span> Plan de compras</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group planCompras" style="display: <?php echo $ver_plan_compras;?> ;">
                    <div class="radio tipo1">
                        <input type="checkbox"  id="checkplantafisica" name="checkplantafisica"  aria-describedby="textHelp"  value="1" <?php echo $checkedPlantaFisica; ?> />
                        <label for="checkplantafisica"><span></span> Planta fisica</label>
                    </div>
                </div>
            </div>
        </div> 
        <!--<div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selResponsable" class="font-weight-bold"> Responsable *</label>
                    <select name="selResponsable" id="selResponsable" class="form-control caja_texto_sizer selectpickerRespo" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_responsable as $dataResponsable) {

                            $per_codigo=$dataResponsable['per_codigo'];
                            $responsable=$dataResponsable['responsable'];

                            if($per_codigo==$acc_responsable){
                                $selectRsponsable="selected";
                            }
                            else{
                                $selectRsponsable="";
                            }
                        ?>
                            <option value="<?php echo  $per_codigo; ?>" <?php echo $selectRsponsable; ?>><?php echo $responsable; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>-->


    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="selResponsable" name="selResponsable" value="0">
        <input type="hidden" id="txtReferencia" name="txtReferencia" value="<?php echo $refrencia; ?>" required readonly>
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="numero" value="<?php echo $acc_numero; ?>">
        <input type="hidden" name="actoAdministrativo" id="actoAdministrativo" value="<?php echo $actoAdministrativo; ?>">
        <input type="hidden" name="codigoNivelTres" id="codigoNivelTres" value="<?php echo $acc_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar" class="btn btn-danger" onClick="validar_nivelTres();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script type="text/javascript">
    $('#checkplandecompras').change(function(){
        var plan_compras = $('input:checkbox[name=checkplandecompras]:checked').val();
        if(plan_compras == 1){
            $('.planCompras').fadeIn(1);
        }
        else{
            $('.planCompras').fadeOut(1);
        }
    });



    $('#selNivelUno').change(function(){
        var codigo_nivelUno=$(this).find(':selected').data('codigouno');
        var nombreNivelDos=$(this).find(':selected').data('nombreniveldos');
        
        if(codigo_nivelUno==0){

        }
        else{
        $.ajax({
            url:"selectniveldos",
            type:"POST",
            data:"codigo_nivelUno="+codigo_nivelUno+'&nombreNivelDos='+nombreNivelDos,
            async:true,

            success: function(message){
                $("#selectNivelDos").empty().append(message);
            }
        });

        }
    });

    $('#selNivelDos').change(function(){
        var referencianiveldos=$(this).find(':selected').data('referencia');
        var numero=$(this).find(':selected').data('numero');
        
        var referencianiveltres=referencianiveldos+'.'+numero;

        $('#txtReferencia').val(referencianiveltres);
    });

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerRespo').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelTres.js"></script>
