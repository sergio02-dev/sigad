<?php
    
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/plnDsrrllo.php');

    $codigo_nivel = $_REQUEST['codigo_nivel'];
    $nivel = $_REQUEST['nivel'];
    //echo "codigo nivel ".$codigo_nivel;

    $list_responsables = $objRsPlanDesarrollo->list_responsables($codigo_nivel, $nivel);

?>

<!-- **********************          Inicio Modal Forma    *********************************** -->
<div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            Cargando...
        </div>
    </div>
</div>
<!-- **********************          Fin Modal Forma       *********************************** -->

<table claas="table table-sm table-striped table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Oficina Responsable</th>
            <th>Cargo</th>
            <th>Estado</th>
            <th>::</th>
        </tr>
    </thead>

    <tbody>
        <?php
            if($list_responsables){
                $num = 1;
                foreach ($list_responsables as $dta_lsta_responsables) {
                    $res_codigo = $dta_lsta_responsables['res_codigo'];
                    $res_nivel = $dta_lsta_responsables['res_nivel'];
                    $res_codigonivel = $dta_lsta_responsables['res_codigonivel'];
                    $res_codigocargo = $dta_lsta_responsables['res_codigocargo'];
                    $res_codigooficina = $dta_lsta_responsables['res_codigooficina'];
                    $res_estado = $dta_lsta_responsables['res_estado'];

                    if($res_estado == 1){
                        $nombre_estado = "ACTIVO";
                    }

                    if($res_estado == 0){
                        $nombre_estado = "INACTIVO";
                    }

                    $nombre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                    $nombre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);
                
        ?>
        <tr>
            <td><?php echo $num; ?></td>
            <td><?php echo strtoupper(tildes($nombre_oficina)); ?></td>
            <td><?php echo strtoupper(tildes($nombre_cargo)); ?></td>
            <td><?php echo $nombre_estado; ?></td>
            <td>
                <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_responsable('<?php echo $codigo_nivel ?>','<?php echo $nivel; ?>','<?php echo $res_codigo; ?>');"></i></div>
            </td>
        </tr>
        <?php
                    $num++;
                }
            }

        ?>
    </tbody>
</table>

<script type="text/javascript">
    function editar_responsable(codigo_nivel, nivel, codigo_responsable){
        var codigo_nivel = codigo_nivel;
        var nivel = nivel;
		var codigo_responsable = codigo_responsable;
        var tipo_responsable = 1;
        
		$('#frmModal').modal({
			keyboard: true
		});

        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+"&nivel="+nivel+"&codigo_responsable="+codigo_responsable+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
</script>