<?php
$codigo_proyecto=$_REQUEST['codigo_proyecto'];  

?>

 <br>
<input type="hidden" value="<?php echo $codigo_proyecto; ?>" id="codigo_proyecto">
<table id="dataAccion<?php echo $codigo_proyecto; ?>" class="table table-striped table-bordered">

<!--<tfoot>
	<tr>
		<th colspan="4" style="text-align:right">Total Página:</th>
		<th colspan="3"></th>
	</tr>
</tfoot>-->
</table>

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



<script>
$(document).ready(function() {
    var table =	$('#dataAccion<?php echo $codigo_proyecto; ?>').DataTable({
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
			url: 'jaccionpc?<?php echo $codigo_proyecto; ?>',
			type: 'POST'
		},
		columns: [
			{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
			{ data: 'acc_referencia', title: 'Codigo Accion'},
			{ data: 'acc_descripcion', title: 'Accion'},
            { data: 'acc_indicador', title: 'Unidad de Medida'},
			{ 
				data: null, //'act_codigo', 
				//render: function (data, type, row){
				render: function (data, type, full, meta){
					return '<span class="d-inline-block" tabindex="0"  title="Registro de Certificados"><button type="button" class="btn btn-danger btn-sm" onclick="agregar(\''+full["acc_codigo"]+'\', \''+full["acc_proyecto"]+'\');"><i class="fas fa-list"></i></button></span>';
				}
			},
			
			
		],
		//dom:            "Bfrtip",
        scrollY:        "600px",
        //scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        buttons:        [ 'colvis' ],
        fixedColumns:   {
            leftColumns: 2
        },
		"order": [[1, 'asc']]
	});

	function formatNumber(num) {
		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	}



	/* Formatting function for row details - modify as you need */
	function format(codigo_data) {
		// `d` is the original data object for the row
		var codigo_proyecto=codigo_data.acc_proyecto;
		var codigo_actividad=codigo_data.acc_codigo;
		
		var dataenviar = { 
							"codigo_accion" : codigo_data.acc_codigo, 
							"unidad_medida" : codigo_data.acc_indicador, 
							"codigo_proyecto": codigo_data.acc_proyecto
						}	
						

		$.ajax({
			url:"dataplanaccion",
			type:"POST",
			data:dataenviar, 
			async:true,

			success: function(message){
				$("#registroPlanAccion"+codigo_proyecto).empty().append(message);
			}
		});

		return '<div id="registroPlanAccion'+codigo_proyecto+'"></div>';
	}

	// Add event listener for opening and closing details
	$('#dataAccion<?php echo $codigo_proyecto; ?> tbody').on('click', 'td.details-control', function(){
		var tr = $(this).closest('tr');
		var row = table.row(tr);

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			row.child(format(row.data())).show();
			tr.addClass('shown');
		}
	});
});

	function agregar(codigo_accion, codigo_proyecto){
		var codigo_accion = codigo_accion;
		var codigo_proyecto = codigo_proyecto;
		//alert (codigo_actividad);

		$('#frmModal').modal({
				keyboard: true
		});

		$.ajax({
				url:"formplanaccion",
				type:"POST",
				data:"codigo_accion="+codigo_accion+"&codigo_proyecto="+codigo_proyecto,
				async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
			
	}


</script>
