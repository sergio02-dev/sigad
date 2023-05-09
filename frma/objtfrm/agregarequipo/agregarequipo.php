<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('crud/rs/formpdi/formpdi.php');
   

    $list_linea = $objFormpdi->list_linea();

    $codigo_plan_compras = $_REQUEST['codigo_plan_compras'];
    $productos_pdi = $_REQUEST['productos_pdi'];
  

    $task = "REGISTRAR EQUIPO";

    $url_guardar="registroequipo";

    if($productos_pdi==1){

        $capa_direccion = "#mdfcarproductospdi";
        $url_direccion = "mdfcarproductospdi?recarga=1&codigo_plan_compras=".$codigo_plan_compras;
        
    }

    $capa_direccion = "#mdfcarproductos";
    $url_direccion = "mdfcarproductos?recarga=1&codigo_plan_compras=".$codigo_plan_compras;

    
   
    
    
    
?>
<form id="equiposfrm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        
        <div class="row ">
            
            <div class="col-sm-11" >
                    
                <div class="form-group pl-3">
                    <label for="selLineaEquipo" class="font-weight-bold">Linea de equipo</label>
                    <select name="selLineaEquipo" id="selLineaEquipo" class="form-control caja_texto_sizer  selectpickerlineaequipo" data-rule-required="true"required>
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
        </div>
        <div class="row ">
            <div class="col-sm-11">
                    <div class="form-group pl-3 subLineagregarequipo">
                        <label for="textSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
                        <select name="selSublineaEquipo" id="selSublineaEquipo" class="form-control caja_texto_sizer selectpickersublineaequipo" data-rule-required="true" required>
                            <option value="0" >Seleccione la sublinea</option>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group pl-3 ">
                    <label for="txtNombre" class="font-weight-bold">Equipo</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtEquipo" name="txtEquipo" aria-describedby="textHelp" data-rule-required="true"  required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group pl-3 ">
                    <label for="txtNombre" class="font-weight-bold">Caracteristicas</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtCaracteristicas" name="txtCaracteristicas" aria-describedby="textHelp" data-rule-required="true"  required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-5">
                        <div class="form-group pl-3">
                            <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                            <input type="text" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer puntos_miles_etapa" data-rule-required="true" aria-describedby="textHelp" required>
                                    
                        </div>
                </div>
        </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_equipos();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="vjs/agregarequipo/vldar_equipos.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    
  
    $('.selectpickerlineaequipo').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    $('.selectpickersublineaequipo').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });


    $('#selLineaEquipo').change(function(){
        var codigo_linea = $(this).find(':selected').data('codigo_linea');
       
        if(codigo_linea==0){

        }
        else{
            $.ajax({
                url:"sublineagreagar",
                type:"POST",
                data:"codigo_linea="+codigo_linea,
                async:true,

                success: function(message){
                    $(".subLineagregarequipo").empty().append(message);
                   
                }
            });
        }
    });

    $(".puntos_miles_etapa").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                //return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            });
        }
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
 

    
</script>

