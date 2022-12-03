<!-- **********************          Inicio Modal Forma    *********************************** -->
<!-- Large modal -->
<div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            Cargando...
        </div>
    </div>
</div>
<!-- **********************          Fin Modal Forma       *********************************** -->

<?php 
    $visibilidad=$_SESSION['visibilidadBotones']; 

    $codigo_formpdi = $_REQUEST['codigo_formpdi'];

    if($codigo_dependencia){
        $url_guardar="modificardependencia";
        $task = "MODIFICAR DEPENDENCIA";

        $form_dependencia = $objDependencias->form_dependencia($codigo_dependencia);

        foreach ($form_dependencia as $dat_dpndncias) {
            $ofi_codigo = $dat_dpndncias['ofi_codigo'];
            $ofi_nombre = $dat_dpndncias['ofi_nombre'];
            $ofi_estado = $dat_dpndncias['ofi_estado'];
        }
        
        if($ofi_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }
    else{
        $url_guardar="rgstroformulariopdi";
        $task = "REGISTRAR PLAN COMPRAS PDI";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaFormpdi";
    $url_direccion = "dtaformpdi";
    
?>




<!-- ******************** INICIO FORMULARIO ************************* -->

<form id="plancomprasPDIform" role="form">
    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="informacionInstitucional" class="font-weight-bold ">INFORMACION INSTITUCIONAL</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                    
                <div class="form-group p-3">
                    <label for="textSede" class="font-weight-bold">Sede</label>
                    <select name="selSede" id="selSede" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="textTipoVicerrectoria" class="font-weight-bold"> Vicerrectoria</label>
                        <select name="selTipoVicerrectoria" id="selTipoVicerrectoria" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="textTipoFacultad" class="font-weight-bold"> Facultad</label>
                        <select name="selTipoFacultad" id="selTipoFacultad" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
                <div class="form-group p-3">
                    <label for="textDependencia" class="font-weight-bold">Dependencia</label>
                    <select name="selDependencia" id="selDependencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-6">
                    <div class="form-group p-3">
                        <label for="textTipoArea" class="font-weight-bold">Area</label>
                        <select name="selTipoArea" id="selTipoArea" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
    </div>

    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="tipodeGasto" class="font-weight-bold ">TIPO DE GASTO</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                    
                <div class="form-group p-3">
                    <label for="textTipoGasto" class="font-weight-bold">Tipo de gasto</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textTipoGasto" name="textTipoGasto" aria-describedby="textHelp" value="FUNCIONAMIENTO" data-rule-required="true" disabled>   
                </div>
            </div>
            
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="textAccion" class="font-weight-bold"> Accion</label>
                        <select name="selTipoAccion" id="selTipoAccion" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
                <div class="form-group p-3">
                    <label for="textPlantaFisica" class="font-weight-bold">Caracteristicas Planta Fisica </label> <i class="fas fa-info-circle" style="color: #BB0900"></i>
                    <textarea type="text" class="form-control caja_texto_sizer" id="inputPlantaFisica" name="inputPlantaFisica" aria-describedby="textHelp" data-rule-required="true" ></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="productos" class="font-weight-bold ">PRODUCTOS</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                    
                <div class="form-group p-3">
                    <label for="textLineaEquipo" class="font-weight-bold">Linea de equipo</label>
                    <select name="selLineaEquipo" id="selLineaEquipo" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-3">
                    <div class="form-group p-3">
                        <label for="textSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
                        <select name="selSublineaEquipo" id="selSublineaEquipo" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-4">
                    <div class="form-group pt-3 pl-1">
                        <label for="textEquipo" class="font-weight-bold"> Equipo</label> 
                        <select name="selEquipo" id="selEquipo" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
           <div class="col-sm-1 pt-5 pl-auto">
                <i class="fas fa-plus-circle" style=" display: <?php echo $visibilidad; ?> color: #BB09002"  onclick="agregarEquipo();"></i>          
           </div> 
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="form-group p-3">
                    <label for="textCaracteristicas" class="font-weight-bold">Caracteristicas</label>
                    <select name="selCaracteristicas" id="selCaracteristicas" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            <div class="col-sm-2">
                    <div class="form-group p-3">
                        <label for="selCantidad" class="font-weight-bold">Cantidad</label>
                        <input type="number" name="selCantidad" id="selCantidad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
            <div class="col-sm-5">
                    <div class="form-group p-3">
                        <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                        <input type="number" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer" data-rule-required="true" disabled>
                                
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="selValorTotal" class="font-weight-bold">Valor Total</label>
                        <input type="number" name="selValorTotal" id="selValorTotal" class="form-control caja_texto_sizer" data-rule-required="true" disabled>
                    </div>
            </div>
        </div>
        <div class="m-0 row justify-content-center">
            <button type="submit" class="btn btn-danger" style="width:120px; height:50px ;" onclick="validar_formpdi();"><i class="far fa-save"></i>&nbsp;<strong> Guardar</strong></button>
        </div>

        <div class="row">
                <div class="col-sm-12">&nbsp;</div>
        </div>
    </div>

<!-- ******************** FIN FORMULARIO ************************* -->
    <div class="modal-footer ">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_dependencia" id="codigo_dependencia" value="<?php echo $codigo_formpdi; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
         
     
        
    </div>
</form> 
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/formpdi/vldar_formpdi.js"></script>

<script>
    function agregarEquipo(){

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"form",
            type:"POST",
            data:"",
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
</script>


    
   
    
    




    
   
    
    

