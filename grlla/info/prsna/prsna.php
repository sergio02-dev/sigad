<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/prsna.php');

    $visibilidad = $_SESSION['visibilidadBotones'];

    $codigo_persona = $_REQUEST['codigo_persona'];

    $list_vinculacion_persona = $objRsPersona->list_vinculacion_persona($codigo_persona);
    
?>

<table class="table table-striped table-bordered table-sm">
    <tr>
        <th>NO.</th>
        <th>OFICINA</th>
        <th>CARGO</th>
        <th>ESTADO</th>
        <th>::</th>
    </tr>
    <?php
        if($list_vinculacion_persona){
            $num_datos = 1;
            foreach($list_vinculacion_persona as $dta_list_vinculacion_persona){
                $vin_codigo = $dta_list_vinculacion_persona['vin_codigo'];
                $vin_persona = $dta_list_vinculacion_persona['vin_persona'];
                $vin_oficina = $dta_list_vinculacion_persona['vin_oficina']; 
                $vin_cargo = $dta_list_vinculacion_persona['vin_cargo'];
                $vin_estado = $dta_list_vinculacion_persona['vin_estado']; 
                $ofi_nombre = $dta_list_vinculacion_persona['ofi_nombre'];
                $car_nombre = $dta_list_vinculacion_persona['car_nombre'];

                if($vin_estado == 1){
                    $estado = "ACTIVO";
                }

                if($vin_estado == 0){
                    $estado = "INACTIVO";
                }

    ?>
    <tr>
        <td><?php echo $num_datos; ?></td>
        <td><?php echo strtoupper(tildes($ofi_nombre)); ?></td>
        <td><?php echo strtoupper(tildes($car_nombre)); ?></td>
        <td><?php echo $estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Vinculación" style="display:<?php echo $visibilidad; ?>" onclick="editar_vinculacion('<?php echo $codigo_persona ?>','<?php echo $vin_codigo; ?>');"></i> </div>
        </td>
    </tr>
    <?php
                $num_datos++;
            }
        }
    ?>
</table><br>

    <?php
            include('crud/rs/resolucionpersona/resolucionpersona.php');
            $list_resolucion_persona = $objResolucionpersona->list_resolucion_persona($codigo_persona);
    ?>


<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">ORDENADOR DEL GASTO  </strong> 
        <i class="fas fa-plus-circle color_icono" title="Agregar Resolucion Persona" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="resolucion_persona('<?php echo $codigo_persona;?>')"></i>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>

<table claas="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 40%">Resolucion</th>
        <th style="width: 40%">Fecha</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 5%">::</th>
    </tr>

    <?php
        if($list_resolucion_persona){
            $num = 1;
            foreach ($list_resolucion_persona as $dta_lsta_resolucion) {
                $rep_codigo = $dta_lsta_resolucion['rep_codigo'];
                $rep_resolucion = $dta_lsta_resolucion['rep_resolucion'];
                $rep_fecharesolucion = $dta_lsta_resolucion['rep_fecharesolucion'];
                $rep_estado = $dta_lsta_resolucion['rep_estado'];

                if($rep_estado == 1){
                    $nombre_estado = "ACTIVO";
                }

                if($rep_estado == 0){
                    $nombre_estado = "INACTIVO";
                }

            
    ?>
    <tr>
        <td><?php echo $num; ?></td>
        <td><?php echo $rep_resolucion; ?></td>
        <td><?php echo $rep_fecharesolucion; ?></td>
        <td><?php echo $nombre_estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_resolucion_persona('<?php echo $codigo_persona; ?>','<?php echo $rep_codigo;?>');"></i></div>
        </td>
    </tr>
    <?php
                $num++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="5">No hay Respsolucion</td>
    </tr>
    <?php
        }

    ?>
</table></br>

<script type="text/javascript">
    function editar_vinculacion(codigo_persona, codigo_vinculacion){
        var codigo_persona = codigo_persona;
        var codigo_vinculacion = codigo_vinculacion;
        
        
		$('#frmModal').modal({
			keyboard: true
		});
        $.ajax({
            url:"formvinculacion",
            type:"POST",
            data:"codigo_persona="+codigo_persona+"&codigo_vinculacion="+codigo_vinculacion,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


    function resolucion_persona(codigo_persona){
        var codigo_persona = codigo_persona;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresolucionpersona",
            type:"POST",
            data:"codigo_persona="+codigo_persona,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar_resolucion_persona(codigo_persona, codigo_resolucion){
        var codigo_persona = codigo_persona;
        var codigo_resolucion = codigo_resolucion;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresolucionpersona",
            type:"POST",
            data:"codigo_persona="+codigo_persona+"&codigo_resolucion="+codigo_resolucion,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    
</script>