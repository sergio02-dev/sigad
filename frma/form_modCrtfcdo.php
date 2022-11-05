
<?php
include('crud/rs/crtfcdos.php');

include('prcsos/plnccion/plnccion.php');

$objPlanAccion = new PlnCcion();

$codigo_actividad=$_REQUEST['codigo_actividad'];
$trimestre= Array('Seleccione...','1','2','3','4');
$tarea=$_REQUEST['tarea'];


$estado_certificado=$objRscrtfcdo->estado_certificado();
$plan_desarrollo = $objRscrtfcdo->plan_desarrollo();
$resoluciones = $objRscrtfcdo->resoluciones();
$responsable=$objRscrtfcdo->responsable();


if($codigo_actividad){
    $actividadRealiza=$objRscrtfcdo->updateActividad($codigo_actividad);
    foreach($actividadRealiza as $dataacividad){
        $act_codigo = $dataacividad['act_codigo'];
        $act_descripcion = $dataacividad['act_descripcion'];
        $act_fechaexpedicion = $dataacividad['act_fechaexpedicion'];
        $act_accion = $dataacividad['act_accion'];
        $act_proyecto = $dataacividad['act_proyecto'];
        $act_dependencia = $dataacividad['act_dependencia'];
        $act_referencia = $dataacividad['act_referencia'];
        $act_estado = $dataacividad['act_estado'];
        $act_certificado = $dataacividad['act_certificado'];
        $act_vigencia = $dataacividad['act_vigencia'];
        $act_trimestre = $dataacividad['act_trimestre'];
        $act_proyecto = $dataacividad['act_proyecto'];
        $aco_valor = $dataacividad['aco_valor'];
        $sub_codigoA = $dataacividad['sub_codigo'];
        $act_certificadomod = $dataacividad['act_certificadomod'];
        $act_estadoactividad = $dataacividad['act_estadoactividad'];
        $act_certificadopadre = $dataacividad['act_certificadopadre'];
        $act_resolucion = $dataacividad['act_resolucion'];
        $aco_controotrovalor = $dataacividad['aco_controotrovalor'];

        $certif = $act_certificadomod;
    }

    //echo "valor ".$aco_controotrovalor;
    if($aco_controotrovalor == 0){
        $ver_otroValor = "none";
        $checkOtroVal = "";
    }
    else{
        $ver_otroValor = "block";
        $checkOtroVal = "checked";
    }
     

    if($act_estado=='1'){

        $checkedA="checked";
        $checkedI="";
    }
    if($act_estado=='0') {
        $checkedA="";
        $checkedI="checked";
    }

    if($act_estadoactividad=='1'){
        $verSelect="none";
        $visibilidad="none";
    }
    if($act_estadoactividad=='2') {
        $verSelect="block";
        $visibilidad="block";
    }

    if($act_estadoactividad=='3') {
        $verSelect="block";
        $visibilidad="block";
     }

    if($act_estadoactividad==''){
        $visibilidad="none";
    }

    $verCajaTexto="block";

    $codigo_plan = $objRscrtfcdo->codigo_plan($sub_codigoA);

    $subsistema_plan = $objRscrtfcdo->subsistema_plan($codigo_plan);
    $proyecto = $objRscrtfcdo->selectProyecto($sub_codigoA);
    $accion = $objRscrtfcdo->selectAccion($act_proyecto);

    if($codigo_plan == 1){
        $mostrar_campo_valor = "block";
        $caja_texto = "block";
        $actividadeslista = "none";
        $etapaslist = "none";
        $look_caja_codigo = "block";
        $vgncia  = "block";
        $trmstre = "block";
    }
    else{
        $look_caja_codigo = "none";
        $mostrar_campo_valor = "none";
        $caja_texto  = "none";
        $actividadeslista = "block";
        $etapaslist = "block";
        $vgncia  = "none";
        $trmstre = "none";
    }


    $url_guardar="crudcertificadosupdate";

    $tarea="modificar";

}


?>

<form id="formcertificados" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>MODIFICAR CERTIFICADO</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Fecha Expedición*</label>
                    <input type="date" class="form-control caja_texto_sizer" id="fechaExpedicion" name="fechaExpedicion" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo substr($act_fechaexpedicion,0,10) ; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selResolucion" class="font-weight-bold">Resoluci&oacute;n * </label> </a>
                    <select name="selResolucion" id="selResolucion"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0" >Seleccione...</option>
                        <?php
                            
                            foreach ($resoluciones as $dta_rslucion) {

                                $aad_codigo = $dta_rslucion['aad_codigo'];
                                $add_nombre = $dta_rslucion['add_nombre'];
                                $add_tipoactoadmin = $dta_rslucion['add_tipoactoadmin'];

                                if($aad_codigo==$act_resolucion){
                                    $selcet_resolu="selected";
                                }
                                else{
                                    $selcet_resolu="";
                                }
                        ?>      
                            <option value="<?php echo  $aad_codigo; ?>" <?php echo $selcet_resolu; ?> ><?php echo $add_nombre; ?></option>
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
                    <label for="selPlanDesarrollo" class="font-weight-bold">Plan de Desarrollo * </label> </a>
                    <select name="selPlanDesarrollo" id="selPlanDesarrollo"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0" data-codigo_plan='0'>Seleccione...</option>
                        <?php
                            
                            foreach ($plan_desarrollo as $dta_plandsrrollo) {

                                $pde_codigo = $dta_plandsrrollo['pde_codigo'];
                                $pde_nombre = $dta_plandsrrollo['pde_nombre'];
                                $add_nombre = $dta_plandsrrollo['add_nombre'];

                                $nmbre_pln = $pde_nombre." ".$add_nombre;

                                if($pde_codigo==$codigo_plan){
                                    $selected_pland="selected";
                                }
                                else{
                                    $selected_pland="";
                                }
                        ?>      
                            <option value="<?php echo  $pde_codigo; ?>" <?php echo $selected_pland; ?> data-codigo_plan="<?php echo $pde_codigo; ?>"><?php echo $nmbre_pln; ?></option>
                        <?php
                            }
                            

                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group" id="sub_sstma">
                    <label for="selTipoActividad" class="font-weight-bold">Subsistema * </label> <a href="Javascript:modalInfo();"></a>
                    <select name="selSubsistema" id="selSubsistema"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0" data-codigosub='0'>Seleccione...</option>
                        <?php
                            if($act_codigo){
                                foreach ($subsistema_plan as $datasubsistema) {

                                    $sub_codigo=$datasubsistema['sub_codigo'];
                                    $sub_nombre=$datasubsistema['sub_nombre'];
                                    $sub_referencia=$datasubsistema['sub_referencia'];

                                    if($sub_codigo==$sub_codigoA){
                                        $select_subsistema="selected";
                                    }
                                    else{
                                        $select_subsistema="";
                                    }

                            ?>      
                                <option value="<?php echo  $sub_codigo; ?>" <?php echo $select_subsistema; ?> data-codigosub="<?php echo $sub_codigo; ?>" data-referencia="<?php echo $sub_referencia; ?>"><?php echo $sub_nombre; ?></option>
                            <?php
                                }
                            }

                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            $('#selPlanDesarrollo').change(function(){
                var codigo_plan=$(this).find(':selected').data('codigo_plan');

                if(codigo_plan==0){

                }
                else{
                    if(codigo_plan == 1){
                        $('#txto_actividad').fadeIn(1);
                        $('#campoValor').fadeIn(1);
                        $('#actvdades_lista').fadeOut(1);
                        $('#etpas_lista').fadeOut(1);
                        $('#cetfff').fadeIn(1);
                        $('#vgncia').fadeIn(1);
                        $('#trmstre').fadeIn(1);                    
        
                        //alert(codigo_plan);
                    }
                    else{
                        $('#txto_actividad').fadeOut(1);
                        $('#campoValor').fadeOut(1);
                        $('#actvdades_lista').fadeIn(1);
                        $('#etpas_lista').fadeIn(1);
                        $('#cetfff').fadeOut(1);
                        $('#vgncia').fadeOut(1);
                        $('#trmstre').fadeOut(1);   
                    }

                    $.ajax({
                        url:"selsubsistema",
                        type:"POST",
                        data:"codigo_plan="+codigo_plan,
                        async:true,

                        success: function(message){
                            $("#sub_sstma").empty().append(message);
                        }
                    });

                }
            });

            $('#selSubsistema').change(function(){
                var codigo_subsistema=$(this).find(':selected').data('codigosub');
                var referencia_subsistema=$(this).find(':selected').data('referencia');
                var codigo_plan = $('#selPlanDesarrollo').val();
                if(codigo_subsistema==0){

                }
                else{
                    $.ajax({
                        url:"certificadoproyecto",
                        type:"POST",
                        data:"codigo_subsistema="+codigo_subsistema+"&referencia_subsistema="+referencia_subsistema+'&codigo_plan='+codigo_plan,
                        async:true,

                        success: function(message){
                            $("#id_proyecto").empty().append(message);
                        }
                    });

                }
            });
        </script>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group" id='id_proyecto'>
                    <label for="selProyecto" class="font-weight-bold">Proyecto * </label>
                    <select name="selProyecto" id="selProyecto"  class="form-control caja_texto_sizer selectpickerPrycto" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0" data-codigoPro='0'>Seleccione...</option>
                        <?php
                        if($act_proyecto){

                            foreach ($proyecto as $dataproyecto) {

                                $pro_codigo=$dataproyecto['pro_codigo'];
                                $pro_descripcion=$dataproyecto['pro_descripcion'];
                                $pro_referencia=$dataproyecto['pro_referencia'];
                                $sub_referencia = $dataproyecto['sub_referencia'];
                                $sub_ref = $dataproyecto['sub_ref'];
                                $pro_numero = $dataproyecto['pro_numero'];

                                if($pro_codigo==$act_proyecto){
                                    $select_proyecto="selected";
                                }
                                else{
                                    $select_proyecto="";
                                }

                                if($codigo_plan == 1){
                                    $referencia_subsistema = $sub_referencia;
                                    $rfrncia_proyecto = $referencia_subsistema.".".$pro_referencia;
                                }
                                else{
                                    $referencia_subsistema = "";
                                    $rfrncia_proyecto = $pro_referencia.".".$pro_numero;
                                }

                                $texto_proyecto = $rfrncia_proyecto." ".$pro_descripcion;
                        
                        ?>
                            <option value="<?php echo  $pro_codigo; ?>" <?php echo $select_proyecto; ?> data-codigoPro="<?php echo $pro_codigo; ?>" data-referenciapro="<?php echo $rfrncia_proyecto; ?>"><?php echo $texto_proyecto; ?></option>
                        <?php
                            }
                        }
                        else{

                        }
                        ?>
                        <input type="hidden" id="referencia_subsistema" value="<?php echo $referencia_subsistema; ?>">

                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group" id="id_accion">
                    <label for="selAccion" class="font-weight-bold">Acción * </label>
                    <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpickerAccion" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0">Seleccione...</option>
                        <?php

                        if($act_accion){

                            foreach ($accion as $dataaccion) {

                                $acc_codigo = $dataaccion['acc_codigo'];
                                $acc_descripcion = $dataaccion['acc_descripcion'];
                                $acc_referencia = $dataaccion['acc_referencia'];
                                $sub_referencia = $dataaccion['sub_referencia'];
                                $sub_ref = $dataaccion['sub_ref'];
                                $acc_numero= $dataaccion['acc_numero'];

                                if($acc_codigo == $act_accion){
                                    $select_accion = "selected";
                                }
                                else{
                                    $select_accion = "";
                                }

                                if($codigo_plan == 1){
                                    $referencia_subsistema = $sub_referencia;
                                    $rfrncia_accion = $referencia_subsistema.".".$acc_referencia;
                                }
                                else{
                                    $referencia_subsistema = "";
                                    $rfrncia_accion = $acc_referencia.".".$acc_numero;
                                }

                                $txto_accion = $rfrncia_accion." ".$acc_descripcion;
                    ?>
                            <option value="<?php echo  $acc_codigo; ?>" <?php echo $select_accion; ?> data-codigoref="<?php echo $rfrncia_accion; ?>" data-codigoacc="<?php echo $acc_codigo; ?>"><?php echo $txto_accion; ?></option>
                    <?php
                            }
                        }
                    ?>


                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('.selectpickerPrycto').selectpicker({
                liveSearch: true,
                maxOptions: 1
            });

            $('.selectpickerAccion').selectpicker({
                liveSearch: true,
                maxOptions: 1
            });

            $('#selProyecto').change(function(){
            var codigo_proyecto = $(this).find(':selected').data('codigopro');
            var referencia_proyecto = $(this).find(':selected').data('referenciapro');
            var referencia_subsistema = $('#referencia_subsistema').val();
            var codigo_plan = $('#selPlanDesarrollo').val();

            //alert('--->'+referencia_proyecto);
                if(codigo_proyecto==0){

                }
                else{
                    $.ajax({
                        url:"certificadoaccion",
                        type:"POST",
                        data:"codigo_proyecto="+codigo_proyecto+"&referencia_subsistema="+referencia_subsistema+"&referencia_proyecto="+referencia_proyecto+'&codigo_plan='+codigo_plan,
                        async:true,

                        success: function(message){
                            //$(".modal-body").empty().append(message);
                            $("#id_accion").empty().append(message);
                            $('#cetfff').fadeOut();
                        }
                    });

                }
            });

            $('#selAccion').change(function(){
                var codigo_accion=$(this).find(':selected').data('codigoacc');
                var referencia_accion=$(this).find(':selected').data('codigoref');
                var codigo_plan = $('#selPlanDesarrollo').val();

                if(codigo_plan==1){

                } 
                else{
                    $.ajax({
                        url:"listactvdadesplan",
                        type:"POST",
                        data:"codigo_plan="+codigo_plan+"&codigo_accion="+codigo_accion,
                        async:true,

                        success: function(message){
                            $("#actvdades_lista").empty().append(message);
                        }
                    });
                }

                var referencia_certificado = referencia_accion+'.';

                if(referencia_accion==0){

                }
                else{
                    $('#act_referencia').val(referencia_certificado);
                }
            });
        </script>


        <div class="form-group" id="cetfff" style="display: <?php echo $look_caja_codigo; ?>">
            <label for="act_referencia" class="font-weight-bold">Código Actividad*</label>
            <input type="text" class="form-control caja_texto_sizer" id="act_referencia" name="act_referencia" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $act_referencia; ?>" required>
            <span class="help-block" id="error"></span>
        </div>


        <div class="form-group" id="txto_actividad" style="display: <?php echo $caja_texto; ?>">
            <label for="textNumeroVeces" class="font-weight-bold">Actividad *</label>
            <textarea name="selActividad" class="form-control caja_texto_sizer" id="selActividad" aria-describedby="textHelp" data-rule-required="true" required><?php echo $act_descripcion; ?></textarea>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group" id="actvdades_lista" style="display: <?php echo $actividadeslista;?>">
            <?php
                $activity_list = $objPlanAccion->actividades_accion($act_accion);
            ?>
            <label class="font-weight-bold">Actividades * </label>
            <div class="bg">
                <div>
                <?php
                    if($activity_list){
                        foreach ($activity_list as $data_actvty_list) {
                            $acp_codigo = $data_actvty_list['acp_codigo'];
                            $acp_descripcion = $data_actvty_list['acp_descripcion'];
                            $acp_referencia = $data_actvty_list['acp_referencia'];
                            $acp_numero = $data_actvty_list['acp_numero'];
                            $acp_vigencia = $data_actvty_list['acp_vigencia'];

                            $referenciaActividad = $acp_referencia.".".$acp_numero;

                            $actividad_completa = $referenciaActividad." ".$acp_descripcion;

                            $checked_actividad = $objRscrtfcdo->checked_actividad($acp_codigo, $act_codigo);

                            if($checked_actividad == 0){
                                $chcked_actvdad = "";
                            }
                            else{
                                $chcked_actvdad = "checked";
                            }




                ?>
                    <div class="chiller_cb">
                        <input id="actvddes<?php echo $acp_codigo; ?>" class="actyvs" name="actvddes[]" type="checkbox" value="<?php echo $acp_codigo; ?>" data-rule-required="true" <?php echo $chcked_actvdad; ?> required>
                        <label for="actvddes<?php echo $acp_codigo; ?>"><?php echo $actividad_completa; ?></label>
                        <span></span>
                    </div>
                <?php
                        
                        }//Foreach Menu
                    }//if Menu
                    else{
                        echo "No hay Actividades";
                    }
                ?>

                </div>
                <span class="help-block" id="error"></span>
            </div>
        </div>

        <script type="text/javascript">

            $('.actyvs').change(function(){
                var codigo_accion = $('#selAccion').val();
                var codigo_plan = $('#selPlanDesarrollo').val();
                var codigo_actividad = new Array();
                var codigo_certificado = '<?php echo $act_codigo; ?>';
                //alert(codigo_certificado);

                $('[name="actvddes[]"]:checked').each(function() {
                    codigo_actividad.push($(this).val());
                });
                
                if(codigo_actividad){
                    $.ajax({
                        url:"listetapas",
                        type:"POST",
                        data:"codigo_accion="+codigo_accion+"&codigo_plan="+codigo_plan+'&codigo_actividad='+codigo_actividad+'&codigo_certificado='+codigo_certificado,
                        async:true,

                        success: function(message){
                            $("#etpas_lista").empty().append(message);
                        }
                    });
                }
                
            });

            
        </script>
   

        <div id="etpas_lista" style="display: <?php echo $etapaslist; ?>">
            <div class="form-group">
                <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
                <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
                <input type="hidden" name="cdigo_actividad" id="cdigo_actividad" value="<?php echo $cdigo_actividad; ?>">

                <label class="font-weight-bold">Etapas * </label>
                <div class="bg">
                    <table class="table table-sm">
                        <?php
                            $etapas_list = $objRscrtfcdo->etps_lista($act_codigo);
                            if($etapas_list){
                                foreach($etapas_list as $dta_etpas_list){
                                    $poa_codigo = $dta_etpas_list['poa_codigo'];
                                    $poa_referencia = $dta_etpas_list['poa_referencia'];
                                    $poa_objeto = $dta_etpas_list['poa_objeto']; 
                                    $poa_recurso = $dta_etpas_list['poa_recurso'];
                                    $poa_estado = $dta_etpas_list['poa_estado'];
                                    $poa_numero = $dta_etpas_list['poa_numero']; 
                                    $poa_vigencia = $dta_etpas_list['poa_vigencia'];
                                    $acp_codigo = $dta_etpas_list['acp_codigo'];
                                    $poa_logroejecutado = $dta_etpas_list['poa_logroejecutado'];

                                    $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                                    $checked_etapa = $objRscrtfcdo->checked_etapa($act_codigo, $poa_codigo);
                                    if($checked_etapa == 0){
                                        $checkear_etapa = "";
                                    }
                                    else{
                                        $checkear_etapa = "checked";
                                    }
                        ?>
                        <tr>
                            <td>
                                <div class="chiller_cb">
                                    <input id="actvddes<?php echo $poa_codigo; ?>" class="etapps" name="etpass[]" data-valor_etapa="<?php echo $poa_recurso; ?>" type="checkbox" value="<?php echo $poa_codigo; ?>" data-rule-required="true" <?php echo $checkear_etapa; ?> required>
                                    <label for="actvddes<?php echo $poa_codigo; ?>"><?php echo $etpa_nombre; ?></label>
                                    <span></span>
                                </div>
                            </td>
                            <td>&nbsp;<br><?php echo "$".number_format($poa_recurso,0,'','.'); ?></td>
                        </tr>
                        <?php
                                    $checkear_etapa = "";
                                }
                            }
                            else{
                        ?>
                        <tr>
                            <td colspan="2">No hay Etapas</td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    
                </div>
                <span class="help-block" id="error"></span>
            </div>
            <?php 
                $sma_etpas = $objRscrtfcdo->sma_etpas($act_codigo);
            ?>
            <div class="form-group">
                <label for="SumTotal" class="font-weight-bold">Total*</label>
                <input type="text" class="form-control caja_texto_sizer" id="SumTotal" name="SumTotal" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $sma_etpas; ?>" required readonly>
                <span class="help-block" id="error"></span>            
            </div>

            <div class="form-group">
                <div class="bg">
                    <div class="chiller_cb">
                        <input id="checkedOtroValor" name="checkedOtroValor"  type="checkbox" value="1" data-rule-required="true" <?php echo $checkOtroVal; ?> required>
                        <label for="checkedOtroValor">Otro Valor</label>
                        <span></span>
                    </div>
                </div>
                <input type="hidden" name="summaa" id="summaa" value="<?php echo $sma_etpas; ?>">
            </div>

            <script type="text/javascript">

                var valor_total = new Array();

                function numberWithCommas(formatoNumero) {
                    return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                $('.etapps').change(function(){

                    var suma_etapa = 0;

                    valor_etapa = $('[name="etpass[]"]:checked').map(function () {
                                            return $(this).data('valor_etapa')
                                }).get();

                    //alert("cantidad elementos: "+valor_etapa.length);

                    for (let index = 0; index < valor_etapa.length; index++) {
                        suma_etapa = parseInt(suma_etapa) + parseInt(valor_etapa[index]);   
                    }

                    $('#SumTotal').val(numberWithCommas(suma_etapa));
                    $('#summaa').val(suma_etapa);
                    
                });

                $('#checkedOtroValor').change(function(){
                    var valor_otro = $('input:checkbox[name=checkedOtroValor]:checked').val();

                    if(valor_otro==1){
                        $('#valorDiferente').fadeIn(100);
                    }
                    else{
                        $('#valorDiferente').fadeOut(100);
                    }
                });
            </script>

            <div class="form-group" id="valorDiferente" style="display: <?php echo $ver_otroValor; ?>">
                <label for="txtOtroValor" class="font-weight-bold">Otro Valor*</label>
                <input type="text" class="form-control caja_texto_sizer" id="txtOtroValor" name="txtOtroValor" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $aco_valor; ?>" required>
                <span class="help-block" id="error"></span>            
            </div>
        </div>



        <div class="form-group">
            <label for="estadoActividad" class="font-weight-bold">Estado Certificado * </label>
            <select name="estadoActividad" id="estadoActividad"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                <option value="0" data-codigoestado="0">Seleccione...</option>
                <?php
                    foreach ($estado_certificado as $data_estadocertificado) {

                        $ece_codigo=$data_estadocertificado['ece_codigo'];
                        $ece_nombre=$data_estadocertificado['ece_nombre'];
                        $ece_campocertificado=$data_estadocertificado['ece_campocertificado'];

                        if($ece_codigo==$act_estadoactividad){
                            $select_estado="selected";
                        }
                        else{
                            $select_estado="";
                        }
                    
                ?>
                    <option value="<?php echo  $ece_codigo; ?>" <?php echo $select_estado; ?> data-codigoestado="<?php echo $ece_codigo; ?>" data-tarea="<?php $tarea; ?>"><?php echo $ece_nombre; ?></option>
                <?php
                    
                    }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group" id="cajaTexto" style="display:<?php echo $verCajaTexto; ?>">
            <label for="textCertificado" class="font-weight-bold">N&uacute;mero Certificado *</label>
            <input type="number" class="form-control caja_texto_sizer" id="textCertificado" name="textCertificado" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $act_certificado; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group"  id="certificadoSelect" style="display:<?php echo $verSelect; ?>">
            <label for="selectCertificado" class="font-weight-bold">Certificado a Modificar* </label>
            <select name="selectCertificado" id="selectCertificado"  class="form-control caja_texto_sizer selectpicker"  data-size="10" data-rule-required="true" required <?php echo $disabled; ?> >
                <option value="0" data-cerfif="0">Seleccione...</option>
                <?php
                    $certificadosMod=$objRscrtfcdo->certificadoMod();
                    if($certificadosMod){
                        foreach ($certificadosMod as $data_certificadoMod) {
                            $act_codigo=$data_certificadoMod['act_codigo'];
                            $act_certificadoaccion=$data_certificadoMod['act_certificado'];

                            if($act_certificadoaccion==$act_certificadomod){
                                $select_certificadoaccion="selected";
                            }
                            else{
                                $select_certificadoaccion="";
                            }
                
                    ?>
                        <option value="<?php echo  $act_certificadoaccion; ?>" <?php echo $select_certificadoaccion; ?> data-cerfif="<?php echo $act_certificadoaccion; ?>"><?php echo $act_certificadoaccion; ?></option>
                    <?php
                        }
                    }
                    else{

                    }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>
        
        <div class="form-group" id="id_estadocer" style='display:<?php echo $visibilidad; ?>'>
            <?php 
                include('frma/objtfrm/mod_crtfcdo.php');
            ?>
        </div>
      
        <div class="form-group">
            <label for="dependenciaActibvidad" class="font-weight-bold">Responsable * </label>
            <select name="dependenciaActibvidad" id="dependenciaActibvidad"  class="form-control caja_texto_sizer" data-rule-required="true" required >
                <option value="0">Seleccione...</option>
                <?php
                    foreach ($responsable as $data_responsable) {

                        $per_codigo=$data_responsable['per_codigo'];
                        $per_nombre=$data_responsable['per_nombre'];
                        $per_primerapellido=$data_responsable['per_primerapellido'];
                        $per_segundoapellido=$data_responsable['per_segundoapellido'];

                        $dependencia=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

                        if($per_codigo==$act_dependencia){
                            $select_dependencia="selected";
                        }
                        else{
                            $select_dependencia="";
                        }
                ?>
                    <option value="<?php echo  $per_codigo; ?>" <?php echo $select_dependencia; ?>><?php echo $dependencia; ?></option>
                <?php
                    }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group" id="trmstre" style="display: <?php echo $trmstre; ?>">
            <label for="trimestreActividad" class="font-weight-bold">Trimestre *</label>
            <select name="trimestreActividad" id="trimestreActividad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                <?php
                for ($trim = 0; $trim < 5; $trim++) {
                    if($act_trimestre==$trim){
                        $select_trimestre="selected";
                    }
                    else{
                        $select_trimestre="";
                    }
                    echo "<option value=".$trim." ".$select_trimestre."> ".$trimestre[$trim]."</option>";
                }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>

   
        <script type="text/javascript">
            $('#estadoActividad').change(function(){
            var codigo_estadocer=$(this).find(':selected').data('codigoestado');
            var tarea=$(this).find(':selected').data('tarea');

                if(codigo_estadocer==0 || codigo_estadocer==1 ){
                    $('#id_estadocer').fadeOut(100);
                    $('#certificadoSelect').fadeOut(1);
                    $('#cajaTexto').fadeIn(1);
                }
                else{
                    if(tarea=="crear"){

                    }
                    else{
                        $('#id_estadocer').fadeIn(100);
                        $('#certificadoSelect').fadeIn(1);
                        $('#cajaTexto').fadeIn(1);
                    }
                }
            });
        </script>

        <div class="row">
            <div class="col-sm-4" id="vgncia" style="display: <?php echo $vgncia; ?>">
                <div class="form-group">
                    <label for="vigenciaActividad" class="font-weight-bold"> Vigencia*</label>
                    <select name="vigenciaActividad" id="vigenciaActividad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <?php
                        for ($vigencia = 2019; $vigencia < 2022; $vigencia++) {
                            if($act_vigencia==$vigencia){
                                $select_vigencia="selected";
                            }
                            else{
                                $select_vigencia="";
                            }
                            echo "<option value=".$vigencia." ".$select_vigencia."> ".$vigencia."</option>";
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4" id="campoValor" style="display: <?php echo $mostrar_campo_valor; ?>">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Valor *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="textValor" name="textValor" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $aco_valor; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                    <label for="ractivo"><span></span> Activo</label>

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?>required />
                    <label for="rinactivo"><span></span> Inactivo</label>
                    
                    </div>

                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoActividad" id="codigoActividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_formActividad();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/certificadoActividad.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });

    $('#selectCertificado').change(function(){
          var certif=$(this).find(':selected').data('cerfif');
          var recargar=1;
            //alert(certif);
            if(certif==0){
            }
            else{
            $.ajax({
              url:"formmodificarcertificado",
              type:"POST",
              data:"certif="+certif+'&recargar='+recargar,
              async:true,

              success: function(message){
              //$(".modal-body").empty().append(message);
              $("#id_estadocer").empty().append(message);
              }
            });

          }
        });
</script>
