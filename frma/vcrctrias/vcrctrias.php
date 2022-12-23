<?php
    include('crud/rs/vcrctrias/vcrctrias.php'); 

    //$list_sedes= $objVicerrectoria->list_sedes();

    $codigo_vicerrectoria = $_REQUEST['codigo_vicerrectoria'];

    if($codigo_vicerrectoria){
        $url_guardar="modificarvicerectoria";
        $task = "MODIFICAR VICERRECTORIA";

        $form_vicerrectoria = $objVicerrectoria->form_vicerrectoria($codigo_vicerrectoria);

        foreach ($form_vicerrectoria as $dat_vcrtrias) {
            $ent_codigo = $dat_vcrtrias['ent_codigo'];
            $ent_nombre = $dat_vcrtrias['ent_nombre'];
            $ent_estado = $dat_vcrtrias['ent_estado'];
        }
        
        if($ent_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }
    else{
        $url_guardar="registrovicerectoria";
        $task = "REGISTRAR VICERRECTORIA";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaVicerrectoria";
    $url_direccion = "dtavicerectoria";
    
?>
<form id="vicerrectoriafrm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

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
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ent_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <!--<div class="row">
            <div class="col-sm-12">
                <div class="bg">
                    <div>
                    <?php
                        /*if($list_sedes){
                            foreach ($list_sedes as $data_sede) {
                                $sed_codigo=$data_sede['sed_codigo'];
                                $sed_nombre=$data_sede['sed_nombre'];
                        */

                    ?>
                        <div class="chiller_cb">
                            <input id="sedes<?php /*echo $sed_codigo; */?>" name="sedes[]" type="checkbox" value="<?php/* echo $sed_codigo;*/ ?>" data-rule-required="true" required <?php /*echo $chckdPdre; */?>>
                            <label for="sedes<?php /* echo $sed_codigo; */?>" class="caja_texto_sizer"><?php/* echo $sed_nombre;*/ ?></label>
                            <span></span>
                        </div>
                    <?php
                                
                        
                    ?>

                    </div>
                </div>
            </div>
        </div>
                    -->

        <div class="row">  
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_vicerrectoria" id="codigo_vicerrectoria" value="<?php echo $codigo_vicerrectoria; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_vicerrectoria();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vcrctrias/vldar_vcrctria.js"></script>



