<?php
    include('crud/rs/rprteActvdadPoai.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_plan = $_REQUEST['codigo_plan'];

    $list_reporte_actividad = $rsReporteActvdadPoai->list_reporte_actividad($codigo_actividad);
    //echo "holaaa";
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
<table class="table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>T&iacute;tulo / Nombre </th>
            <th>Acto Administrativo</th>
            <th>N&uacute;mero Acuerdo / Resoluci&oacute;n </th>
            <th>Logro </th>
            <th>::</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($list_reporte_actividad){
                $nmro_rprte = 1;
                foreach ($list_reporte_actividad as $dta_lsta_rprte) {
                    $rac_codigo = $dta_lsta_rprte['rac_codigo'];
                    $rac_codigoactividadpoai = $dta_lsta_rprte['rac_codigoactividadpoai'];
                    $rac_logro = $dta_lsta_rprte['rac_logro'];
                    $rac_acto = $dta_lsta_rprte['rac_acto'];
                    $rac_vigencia = $dta_lsta_rprte['rac_vigencia'];
                    $rac_numero = $dta_lsta_rprte['rac_numero'];
                    $rac_titulo = $dta_lsta_rprte['rac_titulo'];
                    $tac_nombre = $dta_lsta_rprte['tac_nombre'];
                
        ?>
        <tr>
            <td><?php echo $nmro_rprte; ?></td>
            <td><?php echo $rac_titulo; ?></td>
            <td><?php echo $tac_nombre; ?></td>
            <td><?php echo $rac_numero; ?></td>
            <td><?php echo $rac_logro; ?></td>
            <td>
                <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Registro de Actividades" onclick="editar_reporte('<?php echo $codigo_actividad ?>','<?php echo $codigo_accion; ?>','<?php echo $codigo_plan; ?>', '<?php echo $rac_codigo; ?>');"></i></div>
            </td>
        </tr>
        <?php
                    $nmro_rprte++;
                }
            }
        ?>
    </tbody>
   
    
</table>

<script>
    function editar_reporte(codigo_actividad, codigo_accion, codigo_plan, codigo_reporte){
        var codigo_actividad = codigo_actividad;
        var codigo_accion = codigo_accion;
		var codigo_plan = codigo_plan;
		var codigo_reporte = codigo_reporte;
        
        
		$('#frmModal').modal({
				keyboard: true
		});
        $.ajax({
				url:"formreporteactivdadreportada",
				type:"POST",
				data:"codigo_actividad="+codigo_actividad+"&codigo_accion="+codigo_accion+"&codigo_plan="+codigo_plan+"&codigo_reporte="+codigo_reporte,
				async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }
</script>