<?php

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $proyecto = $_REQUEST['proyecto'];
    $accion = $_REQUEST['accion'];
    $pyaccion = $_REQUEST['pyaccion'];
    $accion_code = $_REQUEST['accion_code'];
    $actividad = $_REQUEST['actividad'];
    // echo "Yuliana-----> ".$accion_code;
    
    
?>
<div>

<strong> Proyecto:  </strong> <?php echo $proyecto; ?> | <strong>Acción: </strong> <?php echo $pyaccion." ".$accion; ?>
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
<?php
//$codigo_actividad = $_REQUEST['codigo_actividad'];

include('crud/rs/rgstroctvdad.php');
?>




<table  style="padding-left:50px;">
    <tr>
        <th>No</th>
        <th>Actividad Realizada</th>
        <th>No de Veces</th>
        <th>Tipo de Avance</th>
        <th>Avance Logrado</th>
        <th>Acto Admin</th>
        <th>Nombre Acto Admin</th>
        <th>Título/Nombre</th>
        <th>::</th>
    </tr>
    <?php

        $numeroreg=1;
    //echo "----> ".$rs_RegistroActividad;
        if($rs_RegistroActividad){

        foreach ($rs_RegistroActividad as $dataRegistroActividad) {

            $are_codigo=$dataRegistroActividad['are_codigo'];
            $are_actividad=$dataRegistroActividad['are_actividad'];
            $are_numeroveces=$dataRegistroActividad['are_numeroveces'];
            $are_tipoavance=$dataRegistroActividad['are_tipoavance'];
            $are_avancelogrado=$dataRegistroActividad['are_avancelogrado'];
            $are_tipoactividad=$dataRegistroActividad['are_tipoactividad'];
            $tav_codigo=$dataRegistroActividad['tav_codigo'];
            $tav_nombre=$dataRegistroActividad['tav_nombre'];
            $tac_codigo=$dataRegistroActividad['tac_codigo'];
            $tac_nombre=$dataRegistroActividad['tac_nombre'];
            $are_acuerdo=$dataRegistroActividad['actoadmin'];
            $are_numeroacuerdoresolucion=$dataRegistroActividad['are_numeroacuerdoresolucion'];
            $are_titulonombre=$dataRegistroActividad['are_titulonombre'];
            $are_trimestre=$dataRegistroActividad['are_trimestre'];
            
            if($re_vigencia==$are_trimestre){
                $visibilidad="block";
                $visibilidad_numero="none";
                $visibilidad_agregar="none";
            }
            else{
                $visibilidad="none";
                $visibilidad_numero="block";
                if($tav_codigo==1){
                    $visibilidad_agregar="block";
                }
                else{
                    $visibilidad_agregar="none";
                }
            }
    ?>
    <tr>
        <td><center style="display:block"><?php echo $numeroreg; ?></center><button style="display:none;" onclick="editar_registroactividad('<?php echo $codigo_actividad; ?>','<?php echo $actividad; ?>','<?php echo $accion_code; ?>','<?php echo $are_codigo; ?>')"><?php echo $numeroreg; ?></button></td>
        <td><?php echo $tac_nombre; ?></td>
        <td><?php echo $are_numeroveces; ?></td>
        <td><?php echo $tav_nombre; ?></td>
        <td><?php echo $are_avancelogrado; ?></td>
        <td><?php echo $are_acuerdo; ?></td>
        <td><?php echo $are_numeroacuerdoresolucion; ?></td>
        <td><?php echo $are_titulonombre; ?></td>
        <td>
            <span class="d-inline-block" tabindex="0"  title="Eliminar Registro de Actividades"><button style="display:none;" type="button" class="btn btn-danger btn-sm" onclick="eliminar_registroactividad('<?php echo $are_codigo ?>','<?php echo $codigo_actividad; ?>','<?php echo $actividad; ?>','<?php echo $accion_code; ?>');"><i class="fas fa-trash-alt"></i></button></span>
            <span class="d-inline-block" tabindex="0"  title="Registro de Actividades"><button style="display:none;" type="button" class="btn btn-danger btn-sm" onclick="agregar('<?php echo $codigo_actividad; ?>','<?php echo $actividad; ?>','<?php echo $accion_code; ?>','<?php echo $are_codigo; ?>','1');"><i class="fas fa-plus"></i></button></span>
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
    function editar_registroactividad(codigo_actividad, acc_descripcion, codigo_accion, codigo_activida_realizada){
        var codigo_activida = codigo_activida;
       // var accion_actividad = accion_actividad;
		var acc_descripcion = acc_descripcion;
		var codigo_accion = codigo_accion;
        var codigo_activida_realizada = codigo_activida_realizada;
        
        
		$('#frmModal').modal({
				keyboard: true
		});
        $.ajax({
				url:"formregactividad",
				type:"POST",
				data:"codigo_actividad="+codigo_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion+"&codigo_activida_realizada="+codigo_activida_realizada,
				//data: "codigo_actividad="+codigo_actividad+"&codigo_activida_realizada="+codigo_activida_realizada,
                async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }
    function agregar(codigo_actividad,  acc_descripcion, codigo_accion, codigo_activida_realizada,tarea){
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
    }

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