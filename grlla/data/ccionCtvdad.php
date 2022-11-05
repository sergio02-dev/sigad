<?php

    $codigo_accion=$_REQUEST['codigo_accion'];
	$codigo_subsistema=$_REQUEST['codigo_subsistema'];
	$codigo_plan =$_REQUEST['codigo_plan'];
	include('crud/rs/mtaPrdcto.php');
	$visibilidad=$_SESSION['visibilidadBotones']; 

	//echo "--> ".$codigo_plan;
     
?>

 <div class="col-sm-12">
    <strong>Unidad de Medida <?php echo $datosAccion; ?> | Linea Base 2018: <?php echo $valorEjecutado ?> | Meta 2019: <?php echo $valorEsperado ?></strong>
 </div>
 <br>
<input type="hidden" value="<?php echo $codigo_accion; ?>" id="accion_code">
<table id="dataActividad<?php echo $codigo_accion; ?>" class="table table-striped table-bordered">

<tfoot>
	<tr>
		<th colspan="4" style="text-align:right">Total Página:</th>
		<th colspan="3"></th>
	</tr>
</tfoot>
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
    var table =	$('#dataActividad<?php echo $codigo_accion; ?>').DataTable({
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
			url: 'jactividadaccion?<?php echo $codigo_accion; ?>',
			type: 'POST'
		},
		columns: [
			{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
			/*{ data: 'pro_descripcion', title: 'Proyecto'},
			{ data: 'acc_descripcion', title: 'Accion'},*/
			{ data: 'act_referencia', title: 'Codigo Actividad'},
			{ data: 'act_descripcion', title: 'Actividad'},
			{ data: 'act_certificado', title: 'Certficado'},
			{ data: 'act_fechaexpedicion', title: 'Fecha Exp.'},
			{ data: 'aco_valor', title: 'Valor'},
			{ 
				data: null, //'act_codigo', 
				//render: function (data, type, row){
				render: function (data, type, full, meta){
					return '<span class="d-inline-block" tabindex="0"  title="Registro de Actividades"><button type="button" style="display:none;" class="btn btn-danger btn-sm" onclick="editar(\''+full["act_codigo"]+'\',\''+full["acc_descripcion"]+'\',\''+<?php echo $codigo_accion; ?>+'\');"><i class="fas fa-list"></i></button></span>';
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
		"order": [[1, 'asc']],
		"footerCallback": function (row, data, start, end, display) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function (i) {
				return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
			};

			// Total over all pages
            total = api
                .column(5)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			// Update footer
			$(api.column(5).footer()).html(
			'$' + formatNumber(pageTotal) + ' <br/>( $' + formatNumber(total) + ' Sub total Accion)');
		}
	});

	function formatNumber(num) {
		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	}



	/* Formatting function for row details - modify as you need */
	function format(codigo_data) {
		// `d` is the original data object for the row

		//alert('entro');
		var accion_code=$('#accion_code').val();
		//alert(accion_code);
		var codigo_actividad=codigo_data.act_codigo;
		var dataenviar = { 
							"codigo_actividad" : codigo_data.act_codigo, 
							"proyecto" : codigo_data.pro_descripcion, 
							"accion" : codigo_data.acc_descripcion, 
							"pyaccion" : codigo_data.acc_referencia, 
							"actividad" : codigo_data.act_descripcion,
							"accion_code": accion_code
						}	
						

		$.ajax({
			url:"dataregactividad",
			type:"POST",
			data:dataenviar, //"codigo_actividad="+codigo_actividad,
			async:true,

			success: function(message){
				$("#registroActividad"+codigo_actividad).empty().append(message);
			}
		});

		return '<div id="registroActividad'+codigo_actividad+'"></div>';
	}

	// Add event listener for opening and closing details
	$('#dataActividad<?php echo $codigo_accion; ?> tbody').on('click', 'td.details-control', function(){
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

	function editar(codigo_actividad, acc_descripcion, codigo_accion){
		var codigo_actividad = codigo_actividad;
		var acc_descripcion = acc_descripcion;
		var codigo_accion = codigo_accion;
		//alert (codigo_actividad);

		$('#frmModal').modal({
				keyboard: true
		});

		$.ajax({
				url:"formregactividad",
				type:"POST",
				data:"codigo_actividad="+codigo_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion,
				async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
			
	}


</script>
