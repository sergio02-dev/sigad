<?php 

include('crud/rs/equipopdi/equipopdi.php');

$list_linea = $objEquipoPdi->list_linea();




$cantidad = 0;
$valor_uni = 0;


$url_guardar="registroequipopdi";
$capa_direccion = "#dtaFormpdi";
$url_direccion = "dtaformpdi";

?>




<form id="equipopdifrm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>CREAR EQUIPO</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        
            <div class="row ">
                     
                <div class="col-sm-12" >
                        
                    <div class="form-group pr-4 p-2 pl-4">
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
            </div>
            <div class="row">
                <div class="col-sm-12">
                        <div class="form-group pr-4 p-2 pl-4 subLinea">
                            <label for="textSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
                            <select name="selSublineaEquipo" id="selSublineaEquipo" value = "<?php echo $selSublineaEquipo; ?>" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option  value="0">Seleccione...</option>
                             
                                <?php
                                     
                                    $list_sublinea = $objEquipoPdi->list_sublinea($selSublineaEquipo);
                                    foreach ($list_sublinea as $data_sublinea) {
                                        $slin_codigo=$data_sublinea['slin_codigo'];
                                        $slin_nombre=$data_sublinea['slin_nombre'];
                                ?>
                                    <option value="<?php echo  $slin_codigo; ?>"<?php echo $select_sublinea; ?>><?php echo $slin_nombre; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <span class="help-block" id="error"></span>
                        </div>
                </div>   
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group pr-4 pl-4">
                        <label for="selEquipo" class="font-weight-bold">Equipo</label>
                        <input type="text" class="form-control caja_texto_sizer sma" id="selEquipo" name="selEquipo" aria-describedby="textHelp" data-rule-required="true" required>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group pr-4 pl-4">
                        <label for="selCaracteristicas" class="font-weight-bold">Caracteristicas Equipo</label>
                        <input type="text" class="form-control caja_texto_sizer sma" id="selCaracteristicas" name="selCaracteristicas" aria-describedby="textHelp" data-rule-required="true" required>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                        <div class="form-group pr-4 pl-4">
                            <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                            <input type="number" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer" data-rule-required="true" aria-describedby="textHelp"  required>  
                        </div>
                </div>
            </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_fuentepresupuesto" id="codigo_fuentepresupuesto" value="<?php echo $codigo_fuentepresupuesto; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_equipopedi();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>

<script src="vjs/equipopdi/vldar_equipopdi.js"></script>

<script>
    
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('#selLineaEquipo').change(function(){
        var codigo_linea = $(this).find(':selected').data('codigo_linea');

        $('#selSublineaEquipo').val(codigo_linea);
    });
</script>