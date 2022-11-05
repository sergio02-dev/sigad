<?php

   include('crud/rs/plnDsrrllo.php');

  

   $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];   
   $actoAdministrativo=$_REQUEST['actoAdministrativo'];   
   $codigo_NivelTres=$_REQUEST['codigo_NivelTres'];
// echo "----> ".$codigo_NivelTres;
   $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
   $nombreNivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
   $nombreNivelDos=$objRsPlanDesarrollo->nivelDosNombre();
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
       }
       $refrencia=$acc_referencia;
    $url_guardar="crudupdateniveltres";
   }
   else{
    $url_guardar="crudniveltres";
   }
  // echo "Año Inicio : ".$pde_yearinicio." Acto Administrativo ".$pde_actoadmin;
?>
<form id="niveldosform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title">Registro Nivel Tres</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">


        <p class="font-weight-bold">* Campos obligatorios</p>
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="form-group">
            <label for="selNivelUno" class="font-weight-bold"> <?php echo $nombreNivelUno; ?> *</label>
            <select name="selNivelUno" id="selNivelUno" class="form-control" data-rule-required="true" required>
                <option value="0">Seleccione...</option>
                <?php
                 foreach ($rs_nivelUno as $data_nivelUno) {

                    $sub_codigoNvlUno=$data_nivelUno['sub_codigo'];
                    $sub_nombre=$data_nivelUno['sub_nombre'];

                    if($sub_codigoNvlUno==$sub_codigo){
                        $select_nivelUno="selected";
                    }
                    else{
                        $select_nivelUno="";
                    }
                ?>
                    <option value="<?php echo  $sub_codigoNvlUno; ?>"  <?php echo $select_nivelUno; ?> data-codigouno="<?php echo $sub_codigoNvlUno; ?>" data-nombreniveldos="<?php echo $nombreNivelDos; ?>" ><?php echo $sub_nombre; ?></option>
                <?php
                    }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group" id="selectNivelDos">
            <label for="selNivelDos" class="font-weight-bold"> <?php echo $nombreNivelDos; ?> *</label>
            <select name="selNivelDos" id="selNivelDos" class="form-control" data-rule-required="true" required>
                <option value="0">Seleccione...</option>
                <?php
                if($sub_codigo){

                   $rs_nivelDos=$objRsPlanDesarrollo->nivelDos($sub_codigo);
                   foreach ($rs_nivelDos as $data_nivelDos) {

                    $pro_codigo=$data_nivelDos['pro_codigo'];
                    $pro_referencia=$data_nivelDos['pro_referencia'];
                    $pro_descripcion=$data_nivelDos['pro_descripcion'];
                    $pro_numero=$data_nivelDos['pro_numero'];
            
                    if($pro_codigo==$acc_proyecto){
                        $selected_proyecto="selected";
                    }
                    else{
                        $selected_proyecto="";
                    }
                ?>
                    <option value="<?php echo  $pro_codigo; ?>" <?php echo $selected_proyecto; ?> data-referencia="<?php echo $pro_referencia; ?>" data-numero="<?php echo $pro_numero; ?>"><?php echo $pro_referencia." ".$pro_descripcion; ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="selTipoComportamiento" class="font-weight-bold"> Tipo de Comportamiento *</label>
            <select name="selTipoComportamiento" id="selTipoComportamiento" class="form-control" data-rule-required="true" required>
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
            <select name="selTendencia" id="selTendencia" class="form-control" data-rule-required="true" required>
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
        </div>

       


        <div class="form-group">
            <label for="txtReferencia" class="font-weight-bold">Referencia *</label>
            <input type="hidden" class="form-control" id="txtReferencia" name="txtReferencia" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $refrencia; ?>" required readonly>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="txtNombre" class="font-weight-bold">Descripci&oacute;n *</label>
            <textarea class="form-control" rows="5" id="txtNombre" name="txtNombre" data-rule-required="true" required><?php echo $acc_descripcion; ?></textarea>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="txtLineaBase" class="font-weight-bold">Linea Base *</label>
            <input type="number" class="form-control" id="txtLineaBase" name="txtLineaBase" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $acc_metaresultado; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="txtMetaResultado" class="font-weight-bold">Meta Resultado *</label>
            <input type="number" class="form-control" id="txtMetaResultado" name="txtMetaResultado" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $acc_metaresultado; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="txtUnidadMedida" class="font-weight-bold">Unidad de Medida *</label>
            <input type="text" class="form-control" id="txtUnidadMedida" name="txtUnidadMedida" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $acc_indicador; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        

        


    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
         <input type="hidden" name="numero" value="<?php echo $acc_numero; ?>">
        <input type="hidden" name="actoAdministrativo" id="actoAdministrativo" value="<?php echo $actoAdministrativo; ?>">
        <input type="hidden" name="codigoNivelTres" id="codigoNivelTres" value="<?php echo $acc_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_nivelTres();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script type="text/javascript">
 $('#selNivelUno').change(function(){
        var codigo_nivelUno=$(this).find(':selected').data('codigouno');
        var nombreNivelDos=$(this).find(':selected').data('nombreniveldos');
        //alert(codigo_nivelUno+'  '+nombreNivelDos);
        if(codigo_nivelUno==0){

        }
        else{
        $.ajax({
            url:"selectniveldos",
            type:"POST",
            data:"codigo_nivelUno="+codigo_nivelUno+'&nombreNivelDos='+nombreNivelDos,
            async:true,

            success: function(message){
            //$(".modal-body").empty().append(message);
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
</script>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelTres.js"></script>
