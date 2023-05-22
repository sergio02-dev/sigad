<?php
  
    $recargar = $_REQUEST['recarga'];
  
    if($recargar){
        
        
        include('crud/rs/formpdi/formpdi.php');

        if($_REQUEST['codigo_plan_compras']){
            $form_plancompraspdi = $objFormpdi->form_plancompraspdi($_REQUEST['codigo_plan_compras']);
         
            foreach ($form_plancompraspdi as $dat_plancompraspdi) {
                $pdi_codigo = $dat_plancompraspdi['pdi_codigo'];
                $pdi_linea = $dat_plancompraspdi['pdi_linea'];
                $pdi_sublinea = $dat_plancompraspdi['pdi_sublinea'];
                $pdi_equipo = $dat_plancompraspdi['pdi_equipo'];
                $pdi_equipodescripcion = $dat_plancompraspdi['pdi_equipodescripcion'];
                $pdi_valorunitario = $dat_plancompraspdi['pdi_valorunitario'];
                $pdi_cantidad = $dat_plancompraspdi['pdi_cantidad'];
                $pdi_estado= $dat_plancompraspdi['pdi_estado'];
                $total = $dat_plancompraspdi['total'];
            }
            $list_linea = $objFormpdi->list_linea();
            $list_sublinea = $objFormpdi->list_sublinea($pdi_linea);
            $list_equipo = $objFormpdi->list_equipo($pdi_sublinea);
            $list_caracteristicas = $objFormpdi->list_caracteristicas($pdi_equipo);  
        }
        else{
            $list_linea = $objFormpdi->list_linea();
        }   
    }
    else{
        if($_REQUEST['codigo_plan_compras']){
            $list_linea = $objFormpdi->list_linea();
            $list_sublinea = $objFormpdi->list_sublinea($pdi_linea);
            $list_equipo = $objFormpdi->list_equipo($pdi_sublinea);
            $list_caracteristicas = $objFormpdi->list_caracteristicas($pdi_equipo);
        }
        else{
            $list_linea = $objFormpdi->list_linea();
         

        }    
    }
?>


<div class="row">
   <div class="col-sm-6" >
        <div class="form-group p-3">
            <label for="selLineaEquipo" class="font-weight-bold">Linea de equipo</label>
            <select name="selLineaEquipo" id="selLineaEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                    <option value="0" data-codigo_linea="0">Seleccione la linea</option>
                    <?php
                        if($list_linea){
                        foreach ($list_linea as $data_listlinea) {
                            $lin_codigo=$data_listlinea['lin_codigo'];
                            $lin_nombre=$data_listlinea['lin_nombre'];

                        if($pdi_linea == $lin_codigo){
                            $select_linea = "selected";
                        }
                        else{
                            $select_linea = "";
                        }
                    ?>
                        
                        <option value="<?php echo $lin_codigo; ?>"<?php echo $select_linea; ?> data-codigo_linea="<?php echo $lin_codigo ?>"><?php echo $lin_nombre; ?></option>
                    <?php
                        }
                    }
                    else{
                        ?>
                        <strong>No hay Linea</strong>
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
                    <option value="0" data-codigo_sublinea="0">Seleccione...</option>
                    <?php
                        if($list_sublinea){
                        foreach ($list_sublinea as $data_sublinea) {
                            $slin_codigo=$data_sublinea['slin_codigo'];
                            $slin_nombre=$data_sublinea['slin_nombre'];

                        if($pdi_sublinea==$slin_codigo){
                            $select_sublinea="selected";
                        }
                        else{
                            $select_sublinea="";
                        }
                    ?>
                        <option value="<?php echo  $slin_codigo; ?>"<?php echo $select_sublinea; ?> data-codigo_sublinea="<?php echo $slin_codigo; ?>"><?php echo $slin_nombre; ?></option>
                    <?php
                        }
                    }else{
                        echo "No hay sublinea";
                    }
                    ?>
                </select>
                <span class="help-block" id="error"></span>
            </div>
    </div>
    
</div>
<div class ="row">
    <div class="col-sm-10">
                <div class="form-group p-3 equipo">
                    <div style="float: left; margin-bottom: 1px;">
                        <strong class="font-weight-bold" for="textEquipo">Equipo</strong> 
                        <i class="fas fa-plus-circle color_icono" title="Agregar Equipo" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="agregarEquipo('<?php echo $codigoPlanComprasPdi;?>')"></i>
                    </div>
                    
                    
                    <select name="selEquipo" id="selEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0" data-codigo_equipo="0">Seleccione el equipo</option>
                        <?php
                            
                            foreach ($list_equipo as $data_equipo) {
                                $equi_codigo=$data_equipo['equi_codigo'];
                                $equi_nombre=$data_equipo['equi_nombre'];

                            if($pdi_equipo==$equi_codigo){
                                $select_equipo="selected";
                            }
                            else{
                                $select_equipo="";
                            }
                        ?>
                            <option value="<?php echo  $equi_codigo; ?>"<?php echo $select_equipo; ?>><?php echo $equi_nombre; ?></option>
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
        <div class="form-group p-3 caracteristicas">
            <label for="selCaracteristicas" class="font-weight-bold">Caracteristicas</label>
            <select name="selCaracteristicas" id="selCaracteristicas" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                <option value="0"  data-codigo_caracteristicas="0">Seleccione la caracteristica</option>
                <?php

                    
                    foreach ($list_caracteristicas as $data_caracteristicas) {
                        $deq_codigo=$data_caracteristicas['deq_codigo'];
                        $deq_descripcion=$data_caracteristicas['deq_descripcion'];
                        $deq_valor = $data_caracteristicas["deq_valor"];

                        if($pdi_equipodescripcion==$deq_codigo){
                            $select_descripcion="selected";
                        }
                        else{
                            $select_descripcion="";
                        }

                ?>
                    <option value="<?php echo  $deq_codigo; ?>" <?php echo $select_descripcion; ?>><?php echo substr($deq_descripcion,0,120)."..."; ?></option>
                <?php
                    }
                ?>
            </select>
            <span class="help-block" id="error"></span>       
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 caracteristicasNombre"></div>
</div>
<div class="row">
    <div class="col-sm-5">
            <div class="form-group p-3">
                <label for="selValorUnitario" class="font-weight-bold">Valor Unitario</label>
                <input type="number" name="selValorUnitario" id="selValorUnitario" class="form-control caja_texto_sizer sma" data-rule-required="true" aria-describedby="textHelp" value="<?php echo $pdi_valorunitario;?>" readonly>
                <span class="help-block" id="error"></span>     
            </div>
    </div>
    <div class="col-sm-3">
            <div class="form-group p-3" >
                <label for="selCantidad" class="font-weight-bold">Cantidad</label>
                <input type="number" name="selCantidad" id="selCantidad" class="form-control caja_texto_sizer sma" data-rule-required="true" required aria-describedby="textHelp" value="<?php echo $pdi_cantidad;?>">
                <span class="help-block" id="error"></span>
            </div>
    </div>
    <div class="col-sm-4">
            <div class="form-group p-3">
                <label for="selValorTotal" class="font-weight-bold">Valor Total</label>
                <input type="text" name="selValorTotal" id="selValorTotal" class="form-control caja_texto_sizer" data-rule-required="false" aria-describedby="textHelp" value="<?php echo $total?>" readonly>
                <span class="help-block" id="error"></span>
            </div>
    </div>
</div>
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/mdfcarplancompras/mdfcarplandecomprasfun.js"></script>

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
                    $("")
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



    function agregarEquipo(codigo_plan_compras, productos_pdi){
        var codigo_plan_compras = codigo_plan_compras;
        $('#frmModal').modal({
            keyboard: true
        });
        
            $.ajax({
                    url:"agregarequipo",
                    type:"POST",
                    data:"codigo_plan_compras="+codigo_plan_compras+"&productos_pdi="+productos_pdi,
                    async:true,

                    success: function(message){
                        $(".modal-content").empty().append(message);
                        
                    }
            });
    
    };
    
</script>