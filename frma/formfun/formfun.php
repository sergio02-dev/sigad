<?php
    include('crud/rs/formfun/formfun.php');

    $visibilidad=$_SESSION['visibilidadBotones']; 
    $codigo_formfun = $_REQUEST['codigo_formfun'];

    $list_sedes = $objRsFuncionamiento->list_sedes(); 
    $list_linea = $objRsFuncionamiento->list_linea(); 
    $cantidad = 0;
    $valor_uni = 0;

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
        $url_guardar="rgtroformulariofun";
        $task = "REGISTRAR PLAN COMPRAS FUNCIONAMIENTO";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = "#dtaFormfun";
    $url_direccion = "dtaformfun";
    
   
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
                        <label for="selArea" class="font-weight-bold">Area</label>
                        <select name="selArea" id="selArea" class="form-control caja_texto_sizer" data-rule-required="true" required>
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
            
                <div class="col-sm-6" >
                    
                    <div class="form-group p-3">
                        <label for="selLineaEquipo" class="font-weight-bold">Linea de equipo</label>
                        <select name="selLineaEquipo" id="selLineaEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                                <option value="0" data-codigo_linea="0">Seleccione la linea</option>
                                <?php
                                    foreach ($list_linea as $data_listlinea) {
                                        $lin_codigo=$data_listlinea['lin_codigo'];
                                        $lin_nombre=$data_listlinea['lin_nombre'];
    
                                   
                                ?>
                                    <option value="<?php echo  $lin_codigo; ?>" data-codigo_linea="<?php echo $lin_codigo; ?>"><?php echo $lin_nombre; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <span class="help-block" id="error"></span>    
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group p-3 subLinea">
                        <label for="textSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
                        <select name="selSublineaEquipo" id="selSublineaEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option value="0">Seleccione la sublinea</option>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group p-3 equipo">
                            <label for="textEquipo" class="font-weight-bold"> Equipo</label> 
                            <select name="selEquipo" id="selEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                                <option value="0">Seleccione...</option>
                            </select>
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-sm-2 pt-5">
                        <i class="fas fa-plus-circle" style=" display: <?php echo $visibilidad; ?> color: #BB09002"  onclick="agregarEquipo();"></i>          
                    </div>
                </div>
        

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group p-3 caracteristicas">
                    <label for="selCaracteristicas" class="font-weight-bold">Caracteristicas</label>
                    <select name="selCaracteristicas" id="selCaracteristicas" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                    </select>
                    <span class="help-block" id="error"></span>       
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                    <div class="form-group p-3">
                        <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                        <input type="number" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer" data-rule-required="true" aria-describedby="textHelp" value="<?php echo $valor_uni;?> " disabled>
                                
                    </div>
            </div>
            <div class="col-sm-3">
                    <div class="form-group p-3">
                        <label for="selCantidad" class="font-weight-bold">Cantidad</label>
                        <input type="number" name="selCantidad" id="selCantidad" class="form-control caja_texto_sizer sma" data-rule-required="true" required aria-describedby="textHelp" value="<?php echo $cantidad;?>">
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group p-3">
                        <label for="selValorTotal" class="font-weight-bold">Valor Total</label>
                        <input type="text" name="selValorTotal" id="selValorTotal" class="form-control caja_texto_sizer" data-rule-required="false" aria-describedby="textHelp" readonly>
                        <span class="help-block" id="error"></span>
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
        <input type="hidden" id="valor_unitario" name="valor_unitario" value=""> 
     
        
    </div>
</form> 
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/formfun/vldar_formfun.js"></script>

<script>
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    $('#selLineaEquipo').change(function(){
        var codigo_linea = $(this).find(':selected').data('codigo_linea');
       
        if(codigo_linea==0){

        }
        else{
            $.ajax({
                url:"sublinea",
                type:"POST",
                data:"codigo_linea="+codigo_linea,
                async:true,

                success: function(message){
                    $(".subLinea").empty().append(message);
                }
            });
        }
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('.sma').change(function(){
        var undades = $('#selCantidad').val();
        var str = $('#selValorUnitario').val();
        var valor_unidades = 0;

        valor_unidades = str.toString().replace(/\./g,'');
        
        var total = undades * valor_unidades;

        $('#selValorTotal').val(numberWithCommas(total));
    });

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




    
   
    
    




    
   
    
    

