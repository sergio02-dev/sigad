<form id="personaform" role="form">
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
                        <label for="selTipoVicerrectoria" class="font-weight-bold"> Vicerrectoria</label>
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
                        <label for="selTipoFacultad" class="font-weight-bold"> Facultad</label>
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
                        <label for="selTipoArea" class="font-weight-bold">Area</label>
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
                    <input type="text" class="form-control caja_texto_sizer" id="textTipoGasto" name="textTipoGasto" aria-describedby="textHelp" value="PDI" data-rule-required="true" disabled>
                    <span class="help-block" id="error"></span>     
                </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="selCodigoPDI" class="font-weight-bold"> Codigo PDI</label>
                        <select name="selCodigoPDI" id="selCodigoPDI" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
                        <label for="selAccion" class="font-weight-bold"> Accion</label>
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
                    <label for="textPlantaFisica" class="font-weight-bold">Caracteristicas Planta Fisica </label> <i class="fas fa-info-circle"></i>
                    <textarea type="textPlantaFisica" class="form-control caja_texto_sizer" id="textPlantaFisica" name="textPlantaFisica" aria-describedby="textHelp" data-rule-required="true" ></textarea>
                        
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
                        <label for="selSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
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
                        <label for="selEquipo" class="font-weight-bold"> Equipo</label> 
                        
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
                <i class="fas fa-plus-circle" style="color: #BB0900"></i>          
           </div> 
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="form-group p-3">
                    <label for="textCaracteristicas" class="font-weight-bold">Caracteristicas</label>
                    <select name="selCaracteristicas" id="selCaracter" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
                    </div>
            </div>
            <div class="col-sm-5">
                    <div class="form-group p-3">
                        <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                        <input type="number" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer" data-rule-required="true" required>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="selValorTotal" class="font-weight-bold">Valor Total</label>
                        <input type="number" name="selValorTotal" id="selValorTotal" class="form-control caja_texto_sizer" data-rule-required="true" required>
                    </div>
            </div>
        </div>
        <div class="m-0 row justify-content-center">
                <div class="col-auto">
                    <?php $visibilidad=$_SESSION['visibilidadBotones']; ?>
                    <span class="d-inline-block" tabindex="0"  title="Guardar Formulario"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-md" onclick="agregar();"></i>&nbsp;<strong><i class="fas fa-save">&nbsp;</i>Guardar</strong></button></span>
                </div>
        </div>
        <div class="row">
                <div class="col-sm-12">&nbsp;</div>
        </div>
    </div>



    
   
    
    




    
   
    
    

