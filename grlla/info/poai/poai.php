<?php
    include('crud/rs/poai/poai.php');

    $codigo_plan = $_REQUEST['codigo_plan'];

    $codigo_poai = $_REQUEST['codigo_poai'];

    $list_adicion_poai = $objPoai->list_adicion_poai($codigo_poai)
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

<table class="table table-striped table-bordered table-sm">
    <tr>
        <th>Fecha</th>
        <th>Vigencia</th>
        <th>Fuente de Financiaci&oacute;n</th>
        <th>Valor</th>
        <th>Estado</th>
        <th>::</th>
    </tr>
    <?php
        if($list_adicion_poai){
            foreach($list_adicion_poai as $dta_adcion){
                $apoai_codigo = $dta_adcion['apoai_codigo'];
                $apoai_poai = $dta_adcion['apoai_poai'];
                $apoai_saldo = $dta_adcion['apoai_saldo'];
                $apoai_valor = $dta_adcion['apoai_valor']; 
                $apoai_estado = $dta_adcion['apoai_estado'];
                $apoai_fechacreo = $dta_adcion['apoai_fechacreo'];
                $sff_vigencia = $dta_adcion['sff_vigencia'];
                $ffi_nombre = $dta_adcion['ffi_nombre'];

                if($apoai_estado == 1){
                    $estado = "Activo";
                }

                if($apoai_estado == 0){
                    $estado = "Inactivo";
                }
    ?>
    <tr>
        <td><?php echo substr($apoai_fechacreo,0,10); ?></td>
        <td><?php echo $sff_vigencia; ?></td>
        <td><?php echo $ffi_nombre; ?></td>
        <td><?php echo "$".number_format($apoai_valor,0,'','.'); ?></td>
        <td><?php echo $estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" style="color: #BB0900;" title="Modificar Adición" onclick="mod_adicion('<?php echo $codigo_plan; ?>','<?php echo $codigo_poai; ?>','<?php echo $apoai_codigo; ?>');"></i></div>
        </td>
    </tr>
    <?php
            }
        }
    ?>
    
</table>

<script type="text/javascript">
    function mod_adicion(codigo_plan, codigo_poai, codigo_adicion){
		var codigo_plan = codigo_plan;
		var codigo_poai = codigo_poai;
        var codigo_adicion = codigo_adicion;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formadicionpoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan+'&codigo_poai='+codigo_poai+'&codigo_adicion='+codigo_adicion,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}
</script>