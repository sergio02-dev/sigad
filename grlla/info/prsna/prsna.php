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
</table>
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
</script>