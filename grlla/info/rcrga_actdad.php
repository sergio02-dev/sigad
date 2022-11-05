<?php

    include('crud/rs/rgstroctvdad.php');

    include('crud/rs/rsMtaPrdcto.php');

    $codigo_certificado = $_REQUEST['codigo_certificado'];
    $acc_descripcion = $_REQUEST['acc_descripcion'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_plan = $_REQUEST['codigo_plan'];
    $visibilidad = $_SESSION['visibilidadBotones'];


    $acc_descripcion = $objRsMtaPrdcto->descripcion_accion($codigo_accion);

    $descripcion_proyecto = $objRsRegistroActividad->descripcion_proyecto($codigo_accion);

    $reporte_x_etapa = $objRsRegistroActividad->reporte_x_etapa($codigo_certificado, $codigo_actividad, $codigo_etapa);
    
    $cantidad_rprtes = $objRsRegistroActividad->cantidad_rprtes($codigo_actividad);


    if($cantidad_rprtes == 0){
        $ver_opciones = "block";
    }   
    else{
        $ver_opciones = "none";
    }
?>
<div>

<strong> Proyecto:  </strong> <?php echo $descripcion_proyecto; ?> | <strong>Acción: </strong> <?php echo $acc_descripcion; ?>
<hr/>

</div>
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
<!-- **********************          Inicio Modal Forma    *********************************** -->
	<!-- Large modal -->
	<div class="modal fade" tabindex="-1" id="frmModalEliminar" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				Cargando...
			</div>
		</div>
	</div>
<!-- **********************          Fin Modal Forma       *********************************** -->
<div id="tabla_actividadRealizada<?php echo $codigo_actividad; ?>">

    <table  style="padding-left:50px;">
        <tr>
            <th>No</th>
            <th>Actividad Realizada</th>
            <th>No de Veces</th>
            <th>Avance Logrado</th>
            <th>::</th>
        </tr>
        <?php

            $numeroreg=1;
            if($reporte_x_etapa){

            foreach ($reporte_x_etapa as $data_reporte_x_etapa) {
                $rea_codigo = $data_reporte_x_etapa['rea_codigo'];
                $rea_codigocertificado = $data_reporte_x_etapa['rea_codigocertificado']; 
                $rea_codigoactividadpoai = $data_reporte_x_etapa['rea_codigoactividadpoai'];
                $rea_codigoetapa = $data_reporte_x_etapa['rea_codigoetapa']; 
                $rea_codigoactividad = $data_reporte_x_etapa['rea_codigoactividad'];
                $rea_numeroveces = $data_reporte_x_etapa['rea_numeroveces']; 
                $rea_logrado = $data_reporte_x_etapa['rea_logrado'];
                $rea_vigencia = $data_reporte_x_etapa['rea_vigencia'];
                $tac_nombre = $data_reporte_x_etapa['tac_nombre'];
                    
        ?>
        <tr>
            <td><?php echo $numeroreg; ?></td>
            <td><?php echo $tac_nombre; ?></td>
            <td><?php echo $rea_numeroveces; ?></td>
            <td><?php echo number_format($rea_logrado,2,',','')."%"; ?></td>
            <td>
                <div style="display:<?php echo $ver_opciones; ?>">
                    <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Registro de Actividades" style="display:<?php echo $visibilidad; ?>" onclick="editar_registroactividad('<?php echo $rea_codigo ?>','<?php echo $codigo_certificado; ?>','<?php echo $acc_descripcion; ?>','<?php echo $codigo_accion; ?>','<?php echo $codigo_etapa; ?>','<?php echo $codigo_actividad; ?>','<?php echo $codigo_plan; ?>');"></i> </div>
                    <div class="d-inline-block"><i class="fas fa-trash-alt fa-lg color_icono" title="Eliminar Registro de Actividades" style="display:<?php echo $visibilidad; ?>" onclick="eliminar_registroactividad('<?php echo $are_codigo ?>','<?php echo $codigo_actividad; ?>','<?php echo $actividad; ?>','<?php echo $accion_code; ?>');"></i></div>
                </div>
            </td>
        </tr>

        <?php
                $numeroreg++;
            }
        }
        else{
            echo "<strong>No ha realizado ninguna actividad</strong>";
        }
        ?>
        
    </table>
</div>

<script>
    function editar_registroactividad(codigo_activida_realizada, codigo_certificado, acc_descripcion, codigo_accion, codigo_etapa, codigo_actividad, codigo_plan){
        var codigo_activida_realizada = codigo_activida_realizada;
        var codigo_certificado = codigo_certificado;
		var acc_descripcion = acc_descripcion;
		var codigo_accion = codigo_accion;
        var codigo_etapa = codigo_etapa;
        var codigo_actividad = codigo_actividad;
        var codigo_plan = codigo_plan;
        
        
		$('#frmModal').modal({
				keyboard: true
		});
        $.ajax({
				url:"formrgstroactvdadetpa",
				type:"POST",
				data:"codigo_activida_realizada="+codigo_activida_realizada+"&codigo_certificado="+codigo_certificado+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion+"&codigo_etapa="+codigo_etapa+'&codigo_actividad='+codigo_actividad+'&codigo_plan='+codigo_plan,
				async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }

    /*function agregar(codigo_actividad,  acc_descripcion, codigo_accion, codigo_activida_realizada,tarea){
        var codigo_activida = codigo_activida;
        //var accion_actividad = accion_actividad;
		var acc_descripcion = acc_descripcion;
		var codigo_accion = codigo_accion;
        var codigo_activida_realizada = codigo_activida_realizada;
        var tarea=tarea;
       // alert(codigo_accion);
        
		$('#frmModal').modal({
				keyboard: true
		});
        $.ajax({
				url:"formregactividad",
				type:"POST",
				data:"codigo_actividad="+codigo_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion+"&codigo_activida_realizada="+codigo_activida_realizada+"&tarea="+tarea,
				//data: "codigo_actividad="+codigo_actividad+"&codigo_activida_realizada="+codigo_activida_realizada,
                async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }*/

    function eliminar_registroactividad(codigo_activida_realizada, codigo_actividad, acc_descripcion, codigo_accion){
        var codigo_activida_realizada = codigo_activida_realizada;
        var codigo_actividad = codigo_actividad;
        //var accion_actividad = accion_actividad;
        var acc_descripcion = acc_descripcion;
        var codigo_accion = codigo_accion;
        //alert(codigo_actividad);
        
		$('#frmModalEliminar').modal({
				keyboard: true
		});
        $.ajax({
            url:"eliminaractividadrealizada",
            type:"POST",
            data:"codigo_activida_realizada="+codigo_activida_realizada+"&codigo_actividad="+codigo_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion,               
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
</script>