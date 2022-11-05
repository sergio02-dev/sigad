<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/rsDlgdo.php');

    $codigo_planDesarrollo=$_REQUEST['codigo_planDesarrollo'];    
    $codigo_NivelTres=$_REQUEST['codigo_NivelTres'];
    
    $rsTipoIdentificacion=$objDlgdo->TipoIdentificacion();
   

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
        $task = "MODIFICAR";
    }
?>
<form id="nivelunoform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><?php echo $task; ?> NIVEL UNO: <?php echo strtoupper(tildes($nivelUnoNombre)); ?></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">


        <p class="font-weight-bold">* Campos obligatorios</p>
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selTipoIdentificacion" class="font-weight-bold"> Tipo Identificaci&oacute;n *</label>
                    <select name="selTipoIdentificacion" id="selTipoIdentificacion" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        foreach ($rsTipoIdentificacion as $data_tipoIdentificacion) {

                            $tid_codigo=$data_tipoIdentificacion['tid_codigo'];
                            $tid_nombre=$data_tipoIdentificacion['tid_nombre'];

                            if($tid_nombre==$per_tipoidentificacion){
                                $selectTipoIdentificacion="selected";
                            }
                            else{
                                $selectTipoIdentificacion="";
                            }
                        ?>
                            <option value="<?php echo  $tid_codigo; ?>" <?php echo $selectTipoIdentificacion; ?>><?php echo $tid_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textIdentificacion" class="font-weight-bold">Identificación *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" data-rule-required="true" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textNombre" name="textNombre" aria-describedby="textHelp" data-rule-required="true" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textPrimeroApellido" class="font-weight-bold">Primer Apellido *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textPrimeroApellido" name="textPrimeroApellido" aria-describedby="textHelp" data-rule-required="true" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textSegundoApellido" class="font-weight-bold">Segundo Apellido *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textSegundoApellido" name="textSegundoApellido" aria-describedby="textHelp" data-rule-required="true" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="radioGenero" class="font-weight-bold">Genero *</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioGenero" id="inlineRadio1" value="M" aria-describedby="textHelp" data-rule-required="true" <?php echo $checkedA; ?> <?php echo $sololectura; ?> required/>
                        <label class="form-check-label" for="inlineRadio1">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioGenero" id="inlineRadio2" value="F" aria-describedby="textHelp" data-rule-required="true" <?php echo $checkedI; ?> <?php echo $sololectura; ?> required/>
                        <label class="form-check-label" for="inlineRadio2">Femenino</label>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>

        <div class="form-group">
            <label for="txtNombre" class="font-weight-bold">Nombre *</label>
            <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $sub_nombre; ?>" required>
            <span class="help-block" id="error"></span>
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
        <input type="hidden" name="codigoPlanDesarrollo" id="codigoPlanDesarrollo" value="<?php echo $codigo_planDesarrollo; ?>">
        <input type="hidden" name="codigoNivelUno" id="codigoNivelUno" value="<?php echo $sub_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_niveluno();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroNivelUno.js"></script>
