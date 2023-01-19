<?php 
    include('crud/rs/prsna.php');
    $rs_tipoIdentificacion=$objRsPersona->selectIdentificacion();
    $rs_entidades=$objRsPersona->selectEntidad();
    $rs_facultades=$objRsPersona->selectFacultad();

    $codigo_persona=$_REQUEST['codigo_persona'];

    if($codigo_persona){
        $objRsPersona->setCodigoPersona($codigo_persona);
        $personaFrm=$objRsPersona->personaForm();
        foreach ($personaFrm as $data_personaFrm) {
            $per_codigo=$data_personaFrm['per_codigo'];
            $per_nombre=$data_personaFrm['per_nombre'];
            $per_primerapellido=$data_personaFrm['per_primerapellido'];
            $per_segundoapellido=$data_personaFrm['per_segundoapellido'];
            $per_tipoidentificacion=$data_personaFrm['per_tipoidentificacion'];
            $per_identificacion=$data_personaFrm['per_identificacion'];
            $per_estado=$data_personaFrm['per_estado'];
            $per_genero=$data_personaFrm['per_genero'];
           // $per_entidad=$data_personaFrm['per_entidad'];
        }

        $per_entidad=$objRsPersona->entidad($per_codigo);
        $per_facultad=$objRsPersona->facultad($per_codigo);

        

        if($per_estado==1){
            $checkedI="";
            $checkedA="checked";
        }
        else{
            $checkedI="checked";
            $checkedA="";
        }

        if($per_genero=='H'){
            $checkedH="checked";
            $checkedM="";
        }
        else{
            $checkedH="";
            $checkedM="checked";
        }
        $url_proceso="crudupdatepersona";
        $task = "MODIFICAR";
    }
    else{
        $url_proceso="crudregistropersona";
        $task = "REGISTRAR";
    }
   
?>
<form id="personaform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> PERSONA</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="textIdentificacion" class="font-weight-bold">Identificaci&oacute;n *</label>
                <input type="number" class="form-control caja_texto_sizer" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" value="<?php echo $per_identificacion; ?>" data-rule-required="true" required>
                <span class="help-block" id="error"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="selTipoIdentificacion" class="font-weight-bold"> Tipo Identificaci&oacute;n *</label>
                <select name="selTipoIdentificacion" id="selTipoIdentificacion" class="form-control caja_texto_sizer" data-rule-required="true" required>
                    <option value="0">Seleccione...</option>
                    <?php
                        foreach ($rs_tipoIdentificacion as $data_tipoIdentificacion) {
                            $tid_codigo=$data_tipoIdentificacion['tid_codigo'];
                            $tid_nombre=$data_tipoIdentificacion['tid_nombre'];

                        if($per_tipoidentificacion==$tid_codigo){
                            $select_tipoIdentificacion="selected";
                        }
                        else{
                            $select_tipoIdentificacion="";
                        }
                    ?>
                        <option value="<?php echo  $tid_codigo; ?>"  <?php echo $select_tipoIdentificacion; ?>><?php echo $tid_nombre; ?></option>
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
                <label for="textNombres" class="font-weight-bold">Nombres *</label>
                <input type="text" class="form-control caja_texto_sizer" id="textNombres" name="textNombres" aria-describedby="textHelp" value="<?php echo $per_nombre; ?>" data-rule-required="true" required>
                <span class="help-block" id="error"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="textPrimerApellido" class="font-weight-bold">Primer Apellido *</label>
                <input type="text" class="form-control caja_texto_sizer" id="textPrimerApellido" name="textPrimerApellido" value="<?php echo $per_primerapellido; ?>" data-rule-required="true" required>
                <span class="help-block" id="error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="textSegundoApellido" class="font-weight-bold">Segundo Apellido</label>
                <input type="text" class="form-control caja_texto_sizer" id="textSegundoApellido" name="textSegundoApellido" value="<?php echo $per_segundoapellido; ?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="selEntidad" class="font-weight-bold"> Vicerrectoria </label>
                <select name="selEntidad" id="selEntidad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                    <option value="0">Seleccione...</option>
                    <?php
                        foreach ($rs_entidades as $data_entidad) {
                            $ent_codigo=$data_entidad['ent_codigo'];
                            $ent_nombre=$data_entidad['ent_nombre'];

                        if($per_entidad==$ent_codigo){
                            $select_entidadpersona="selected";
                        }
                        else{
                            $select_entidadpersona="";
                        }
                    ?>
                        <option value="<?php echo $ent_codigo; ?>"  <?php echo $select_entidadpersona; ?>><?php echo $ent_nombre; ?></option>
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
                    <label for="selFacultad" class="font-weight-bold"> Facultad </label>
                    <select name="selFacultad" id="selFacultad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                            foreach ($rs_facultades as $data_fac) {
                                $fac_codigo=$data_fac['ent_codigo'];
                                $fac_nombre=$data_fac['ent_nombre'];

                            if($per_facultad==$fac_codigo){
                                $select_entidadpersona="selected";
                            }
                            else{
                                $select_entidadpersona="";
                            }
                        ?>
                            <option value="<?php echo $fac_codigo; ?>"  <?php echo $select_entidadpersona; ?>><?php echo $fac_nombre; ?></option>
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
                <label for="textNumeroVeces" class="font-weight-bold">Genero *</label>
                <div class="radio tipo1">
                    <input type="radio"   id="rhombre" name="chkgenero"  aria-describedby="textHelp" data-rule-required="true" value="H" <?php echo $checkedH; ?> <?php echo $sololectura; ?> required/>
                    <label for="rhombre"><span></span> Masculino</label>

                    <input type="radio"   id="rMujer" name="chkgenero"  aria-describedby="textHelp" data-rule-required="true" value="M" <?php echo $checkedM; ?> <?php echo $sololectura; ?> required />
                    <label for="rMujer"><span></span> Femenino</label>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> <?php echo $sololectura; ?> required/>
                    <label for="ractivo"><span></span> Activo</label>

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> <?php echo $sololectura; ?> required />
                    <label for="rinactivo"><span></span> Inactivo</label>
                </div>
            </div>
        </div>
    </div>
    
    
   
    
    


    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="url_proceso" name="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" id="per_codigo" name="per_codigo" value="<?php echo $per_codigo; ?>">
        <button type="button" class="btn btn-secondary caja_texto_sizer" data-dismiss="modal"><strong>Cerrar</strong></button>
        <button type="submit" class="btn btn-danger caja_texto_sizer" onClick="validar_formpersona();"><i class="far fa-save"></i> <strong>Guardar</strong> </button>
    </div> 
</form>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/persona.js"></script>