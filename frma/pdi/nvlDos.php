<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/plnDsrrllo.php');
    
    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];   
    $codigo_nivelDos=$_REQUEST['codigo_nivelDos'];
    $nombreNivelUno=$_REQUEST['nombre_niveluno'];
    $referencia_nivelDos=$_REQUEST['referencia_nivelDos'];

    
    $rs_responsable=$objRsPlanDesarrollo->responsable();
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
    $nombreNivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
    $nombrNivelDos=$objRsPlanDesarrollo->nivelDosNombre();
    $rs_nivelUno=$objRsPlanDesarrollo->nivelUno(); 
    $actoAdministrativo=$objRsPlanDesarrollo->actoAdminNombre();

    if($codigo_nivelDos){

        $rs_nivelDos=$objRsPlanDesarrollo->updateNivelDos($codigo_nivelDos);
       
        foreach($rs_nivelDos as $data_nivelDos){
           $pro_codigo=$data_nivelDos['pro_codigo'];
           $pro_descripcion=$data_nivelDos['pro_descripcion'];
           $sub_codigo=$data_nivelDos['sub_codigo'];
           $pro_referencia=$data_nivelDos['pro_referencia'];
           $pro_numero=$data_nivelDos['pro_numero'];
           $pro_objetivo=$data_nivelDos['pro_objetivo'];
           $res_codigo=$data_nivelDos['res_codigo'];
        }
        $url_guardar="crudupdateniveldos";
        $task = "MODIFICAR";
    }
    else{
        $sub_codigo=$_REQUEST['codigo_nivelUno'];
        $referencia_nivelUno=$_REQUEST['referencia_nivelUno'];
        $pro_referencia=$referencia_nivelUno.".".$referencia_nivelDos;
        $url_guardar="crudniveldos";
        $task = "REGISTRAR";
    }

?>
<form id="niveldosform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> NIVEL DOS: <?php echo strtoupper(tildes($nombrNivelDos)); ?></strong></h4>

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
                        foreach ($rs_nivelUno as $data_niveluno) {

                            $sub_codigoNvlUno=$data_niveluno['sub_codigo'];
                            $sub_nombre=$data_niveluno['sub_nombre'];
                            $sub_referencia=$data_niveluno['sub_referencia'];
                            $sub_ref=$data_niveluno['sub_ref'];

                            if($sub_codigoNvlUno==$sub_codigo){
                                $select_nivelUno="selected";
                            }
                            else{
                                $select_nivelUno="";
                            }
                        ?>
                            <option value="<?php echo  $sub_codigoNvlUno; ?>" data-refe="<?php echo $sub_referencia.$sub_ref; ?>" <?php echo $select_nivelUno; ?>><?php echo $sub_referencia.$sub_ref.". ".$sub_nombre; ?></option>
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
                    <label for="txtNombre" class="font-weight-bold">Descripci&oacute;n <?php echo $nombrNivelDos; ?>*</label>
                    <textarea class="form-control caja_texto_sizer" rows="5" id="txtNombre" name="txtNombre" data-rule-required="true" required><?php echo $pro_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtObjetivo" class="font-weight-bold">Objetivo <?php echo $nombrNivelDos; ?> *</label>
                    <textarea class="form-control caja_texto_sizer" rows="5" id="txtObjetivo" name="txtObjetivo" data-rule-required="true" required><?php echo $pro_objetivo; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <!--<div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selResponsable" class="font-weight-bold"> Responsable *</label>
                    <select name="selResponsable" id="selResponsable" class="form-control selectpicker" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rs_responsable as $dataResponsable) {

                            $per_codigo=$dataResponsable['per_codigo'];
                            $responsable=$dataResponsable['responsable'];

                            if($per_codigo==$res_codigo){
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
        </div>    -->   
        

    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="selResponsable" name="selResponsable" value="0">
        <input type="hidden" id="txtReferenciaUno" name="txtReferenciaUno" value="<?php echo $pro_referencia; ?>" required readonly>
        <input type="hidden" name="codigo_planDesarrollo" id="codigo_planDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="actoAdministrativo" id="actoAdministrativo" value="<?php echo $actoAdministrativo; ?>">
        <input type="hidden" name="codigoNivelDos" id="codigoNivelDos" value="<?php echo $pro_codigo; ?>">
        <input type="hidden" name="rfrnciaNvelDos" id="rfrnciaNvelDos" value="<?php echo $referencia_nivelDos; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar" class="btn btn-danger" onClick="validar_niveldos();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>


<script type="text/javascript">
    $('#selNivelUno').change(function(){
        var referneciaNivelUno=$(this).find(':selected').data('refe');
        var rfrnciaNvelDos=$('#rfrnciaNvelDos').val();
        var referenciaNivelDos=referneciaNivelUno+'.'+rfrnciaNvelDos;

        $('#txtReferenciaUno').val(referenciaNivelDos);
    
    });
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelDos.js"></script>
