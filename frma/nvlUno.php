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
    }
    else{
        $referencia_nivelUno=$_REQUEST['referencia_nivelUno'];
        $url_guardar="crudniveluno";
        $task = "REGISTRAR";
    }

    echo "--A".$codigo_planDesarrollo;
?>
<form id="nivelunoform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> NIVEL UNOoooo: <?php echo strtoupper(tildes($nivelUnoNombre)); ?></strong></h4>

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
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selResponsable" class="font-weight-bold"> Responsable *</label>
                    <select name="selResponsable" id="selResponsable" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
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
       

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="tipo_responsable" id="tipo_responsable" value="2">
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="actoAdministrativo" id="actoAdministrativo" value="<?php echo $actoAdministrativo; ?>">
        <input type="hidden" name="codigoNivelUno" id="codigoNivelUno" value="<?php echo $sub_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" id="botonGuardar" onClick="validar_niveluno();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelUno.js"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
