
<?php

	$codigo_subsistema=$_REQUEST['codigo_subsistema'];
	$visibilidad=$_SESSION['visibilidadBotones']; 

     
?>
<table id="dataAccion<?php echo $codigo_subsistema; ?>"></table>

<script>
	$('#dataAccion<?php echo $codigo_subsistema; ?>').DataTable({
		"processing": true,
		 "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
        },
		ajax: {
			url: 'jaccion?<?php echo $codigo_subsistema; ?>',
			type: 'POST',
            data: function (d) {
                    d.codigo_subsistema = <?php echo $codigo_subsistema; ?>;
                }
		},
		columns: [
			{ data: 'acc_referencia', title: 'Codigo Acción'},
			{ data: 'pro_descripcion', title: 'Proyecto'},
			{ data: 'acc_descripcion', title: 'Accion'},
			{ data: 'acc_lineabase', title: 'Linea Base'},
			{ data: 'acc_metaresultado', title: 'Meta de Resultado'},
			{ render: function () { return '<button style="display:<?php echo $visibilidad; ?>;" type="button" class="btn btn-danger btn-sm"><i class="fas fa-pen"></i></button>';}},
			
		]
	});

</script>