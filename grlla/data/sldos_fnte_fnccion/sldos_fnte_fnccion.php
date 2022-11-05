<?php
	include('crud/rs/plnDsrrllo.php');


	$visibilidad=$_SESSION['visibilidadBotones'];
?>		
<span class="d-inline-block" tabindex="0"  title="Registrar Recursos de Balance"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="agregar();"><i class="fas fa-plus"></i>&nbsp;<strong>Registrar Recursos de Balance</strong></button></span>

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

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dtasaldosfuente" class="table table-striped table-bordered">

</table>

<script>
	$(document).ready(function() {
		var table =	$('#dtasaldosfuente').DataTable({
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
				url: 'jsaldosfuentefinanciacion',
				type: 'POST'
			},
			columns: [
				{ data: 'sff_vigencia', title: 'VIGENCIA'},
				{ data: 'nombre_acto', title: 'ACUERDO'},
				{ data: 'nombre_fuente', title: 'FUENTE DE FINANCIACIÓN'},
				{ data: 'sff_saldo', title: 'VALOR'},
				{ data: 'estado', title: 'ESTADO'},
				{
					data: null, 
					render: function (data, type, full, meta){
						return '<div style="display:<?php echo $visibilidad; ?>;"><i class="fas fa-edit fa-lg color_icono" style="color: #BB0900;" title="Modificar Recursos de Balance" onclick="modificar(\''+full["sff_codigo"]+'\');"></i></div>';
					}
				},


			],
			scrollY:        "600px",
			scrollCollapse: true,
			paging:         false,
			buttons:        [ 'colvis' ],
			fixedColumns:   {
				leftColumns: 2
			},
			"order": [[0, 'asc']],
            "columnDefs": [
                { "width": "8%", "targets": 0 },
				{ "width": "24%", "targets": 1 },
                { "width": "38%", "targets": 2 },
                { "width": "15%", "targets": 3 },
				{ "width": "10%", "targets": 4 },
                { "width": "5%", "targets": 5 },
            ],
		});


		function formatNumber(num) {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
		}
		/////Inicio Mas primera columna
		function format(codigo_data) {
			var codigo_accion=codigo_data.acc_codigo;
			var dataenviar = {
								"codigo_accion": codigo_accion
							}

			$.ajax({
				url:"datainfoaccion",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#registroActividad"+codigo_accion).empty().append(message);
				}
			});

			return '<div id="registroActividad'+codigo_accion+'"></div>';
		}
		// Fin Mas primera columna
		// Add event listener for opening and closing details
		$('#dtasaldosfuente tbody').on('click', 'td.details-control', function(){
			var tr = $(this).closest('tr');
			var row = table.row(tr);

			if (row.child.isShown()) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else{
				// Open this row
				row.child(format(row.data())).show();
				tr.addClass('shown');
			}
		});
	});
	
	function agregar(){
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formsaldofuentefinanciacion",
			type:"POST",
			data:"data",
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function modificar(codigo_saldo_fuente){
		var codigo_saldo_fuente = codigo_saldo_fuente;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formsaldofuentefinanciacion",
			type:"POST",
			data:"codigo_saldo_fuente="+codigo_saldo_fuente,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

</script>


<!-- *********************     Fin DataTable     *************************************** *-->
