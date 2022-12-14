<?php
    include('crud/rs/formfun/formfun.php');

    $visibilidad=$_SESSION['visibilidadBotones']; 
    $codigo_formfun = $_REQUEST['codigo_formfun'];

    $list_oficina = $objRsPersona->list_oficina();
    $list_cargo = $objRsPersona->list_cargo();
    $nombre_persona = $objRsPersona->nombre_persona($codigo_persona);

    if($codigo_vinculacion){
        $vinculacionForm = $objRsPersona->vinculacion_form($codigo_vinculacion);
        foreach ($vinculacionForm as $dta_vnclacion) {
            $vin_codigo = $dta_vnclacion['vin_codigo'];
            $vin_persona = $dta_vnclacion['vin_persona'];
            $vin_oficina = $dta_vnclacion['vin_oficina'];
            $vin_cargo = $dta_vnclacion['vin_cargo'];
            $vin_estado = $dta_vnclacion['vin_estado'];
        }


        if($vin_estado == 1){
            $checkedA="checked";
            $checkedI="";
        }
        if($vin_estado == 0){
            $checkedA="";
            $checkedI="checked";
        }

        $url_direccion = "infoprsona?codigo_persona=".$codigo_persona;
        $capa_direccion = "#infoPersona".$codigo_persona;
        $url_proceso="modificarvinculacion";
        $task = "MODIFICAR";
    }
    else{
        $url_direccion = "datapersona";
        $capa_direccion = "#persona";
        $url_proceso="registrovinculacion";
        $task = "REGISTRAR";
        $checkedA="checked";
    }
   
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
                    ?>
                </select>
                <span class="help-block" id="error"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-11">
            <div class="form-group">
                <label for="selCargo" class="font-weight-bold"> Cargo </label>
                <select name="selCargo" id="selCargo" class="form-control caja_texto_sizer selectpickerCargo" data-rule-required="true" required>
                    <option value="0">Seleccione...</option>
                    <?php
                        foreach ($list_cargo as $data_list_cargo) {
                            $car_codigo = $data_list_cargo['car_codigo'];
                            $car_nombre = $data_list_cargo['car_nombre'];

                        if($vin_cargo == $car_codigo){
                            $select_cargo = "selected";
                        }
                        else{
                            $select_cargo = "";
                        }
                    ?>
                        <option value="<?php echo $car_codigo; ?>" <?php echo $select_cargo; ?>><?php echo $car_nombre; ?></option>
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
                <label for="chkestado" class="font-weight-bold">Estado *</label>
                <div class="radio tipo1">
                    <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> <?php echo $sololectura; ?> required/>
                    <label for="ractivo"><span></span> &nbsp;Activo</label> &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> <?php echo $sololectura; ?> required />
                    <label for="rinactivo"><span></span> &nbsp;Inactivo</label>
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
        <input type="hidden" name="codigo_dependencia" id="codigo_dependencia" value="<?php echo $codigo_formfun; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
         
     
        
    </div>
</form> 
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/formfun/vldar_formfun.js"></script>

<script type="text/javascript">
    $('.selectpickerOficina').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });

    $('.selectpickerCargo').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });
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


    
   
    
    




    
   
    
    

