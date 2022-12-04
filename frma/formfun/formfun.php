<?php
    include('crud/rs/formfun/formfun.php');

    $visibilidad=$_SESSION['visibilidadBotones']; 
    $codigo_formfun = $_REQUEST['codigo_formfun'];

    $list_sedes = $objRsFuncionamiento->list_sedes(); 
   
    
   
?>

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






<!-- ******************** INICIO FORMULARIO ************************* -->

<form id="plancomprasFUNCIONAMIENTOform" role="form">
    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="informacionInstitucional" class="font-weight-bold ">INFORMACION INSTITUCIONAL</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                <div class="form-group p-3">
                    <label for="selSede" class="font-weight-bold">Sede</label>
                    <select name="selSede" id="selSede" class="form-control caja_texto_sizer" data-rule-required="true" required>
                            <option value="0" data-codigo_sede="0">Seleccione...</option>
                            <?php
                                foreach ($list_sedes as $dat_sede) {
                                    $sed_codigo = $dat_sede['sed_codigo'];
                                    $sed_nombre = $dat_sede['sed_nombre'];
                            ?>
                                <option value="<?php echo  $sed_codigo; ?>" data-codigo_sede="<?php echo  $sed_codigo; ?>"><?php echo $sed_nombre; ?></option>
                            <?php
                                }
                            ?>
                    </select>
                    <span class="help-block" id="error"></span>    
                </div>
            </div>
            <script type="text/javascript">
                $('#selSede').change(function(){
                    var codigo_sede=$(this).find(':selected').data('codigo_sede');
        
                    $.ajax({
                        url:"vicerrectorialist",
                        type:"POST",
                        data:"codigo_sede="+codigo_sede,
                        async:true,
                        success: function(message){
                            $(".listVice").empty().append(message);
                        }
                    });
                });
            </script>
            <div class="col-sm-4">
                <div class="form-group p-3 listVice">
                    <label for="textTipoVicerrectoria" class="font-weight-bold"> Vicerrectoria</label>
                    <select name="selTipoVicerrectoria" id="selTipoVicerrectoria" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione la sede..</option>
                     
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group p-3 listFac">
                        <label for="textTipoFacultad" class="font-weight-bold"> Facultad</label>
                        <select name="selTipoFacultad" id="selTipoFacultad" class="form-control caja_texto_sizer" data-rule-required="true" required>
                            <option value="0">Seleccione Vicerrectoria</option>
                            
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group p-3 listDep">
                    <label for="textDependencia" class="font-weight-bold">Dependencia</label>
                    <select name="selDependencia" id="selDependencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione la facultad</option>
                       
                    </select>
                    <span class="help-block" id="error"></span>       
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="form-group p-3 listArea">
                        <label for="selTipoArea" class="font-weight-bold">Area</label>
                        <select name="selTipoArea" id="selTipoArea" class="form-control caja_texto_sizer" data-rule-required="true" required>
                            <option value="0">Seleccione una Dependencia...</option>
                        
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
            <button type="submit" class="btn btn-danger" style="width:120px; height:50px ;" onclick="validar_formfun();"><i class="far fa-save"></i>&nbsp;<strong> Guardar</strong></button>
        </div>

        <div class="row">
                <div class="col-sm-12">&nbsp;</div>
        </div>
    </div>

<!-- ******************** FIN FORMULARIO ************************* -->
    <div class="modal-footer ">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_dependencia" id="codigo_dependencia" value="<?php echo $codigo_formfun; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
         
     
        
    </div>
</form> 
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/formfun/vldar_formfun.js"></script>

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

<!-- #region <script type="text/javascript"> 
    $('#selSede').change(function(){
        var codigo_sede=$(this).find(':selected').data('codigosede');
        var nombreVice=$(this).find(':selected').data('nombrevice');
        //alert(codigo_nivelUno+'  '+nombreNivelDos);
        if(codigo_sede==0){

        }
        else{
        $.ajax({
            url:"selectvice",
            type:"POST",
            data:"codigo_sede="+codigo_sede+'&nombreVice='+nombreVice,
            async:true,

            success: function(message){
            //$(".modal-body").empty().append(message);
            $("#selSede").empty().append(message);
            }
        });

        }
    });
</script>    <-->


    
   
    
    




    
   
    
    

