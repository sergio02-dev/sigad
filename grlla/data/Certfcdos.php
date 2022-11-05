<?php $visibilidad=$_SESSION['visibilidadBotones'];  ?>
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
	<table id="certificados" class="table table-striped table-bordered">

	</table>

	<script>
		$(document).ready(function() {
			var table =	$('#certificados').DataTable({
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
					url: 'jcertifcadoactvdad',
					type: 'POST'
				},
				columns: [
					{ data: 'act_certificado', title: 'Certificado'},
					{ data: 'estado_certificado', title: 'Estado'},
					{ data: 'act_fechaexpedicion', title: 'Fecha Expedición'},
					{ data: 'act_referencia', title: 'Código'},
					{ data: 'acc_descripcion', title: 'Acción'},
					{ data: 'act_descripcion', title: 'Actividad'},
					{ data: 'act_vigencia', title: 'Vigencia'},
					{ data: 'act_valor', title: 'Costo'},
					{
						data: null, 
						render: function (data, type, full, meta){
							if(full['act_vigencia']==2019){
								return '';
							}
							else{
								if(full['cantidadactividades']==0){
									return '<div style="display: '+full["ver_edicion_eliminacion"]+'"><div class="d-inline-block"><i class="fas fa-list fa-lg color_icono" title="Editar Actividad" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["act_codigo"]+'\');"></i></div> &nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-trash-alt fa-lg color_icono" title="Eliminar Actividad" onclick="eliminar(\''+full["act_codigo"]+'\',\''+full["act_certificado"]+'\');"></i></div> &nbsp;&nbsp; <div class="d-inline-block"><i class="fas fa-plus-circle fa-lg color_icono" title="Agregar Actividad" onclick="certificado_hijo(\''+full["act_codigo"]+'\',\''+full["act_certificado"]+'\');"></i> </div>  </div>&nbsp;';
								}
								if(full['cantidadactividades']>0){
									return '<div style="display: '+full["ver_edicion_eliminacion"]+'"><div class="d-inline-block"><i class="fas fa-list  fa-lg color_icono" title="Editar Actividad" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["act_codigo"]+'\');"></i></div> &nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-plus-circle fa-lg color_icono" title="Agregar Actividad" onclick="eliminar(\''+full["act_codigo"]+'\',\''+full["act_certificado"]+'\');"></i></div>';
								}
							}											

						}
					},
					{
						"className":      'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
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
				"order": [[6, 'desc'], [0, 'asc']],
				"columnDefs": [
					{ "width": "4%", "targets": 0 },
					{ "width": "5%", "targets": 1 },
					{ "width": "13%", "targets": 2 },
					{ "width": "8%", "targets": 3 },
					{ "width": "20%", "targets": 4 },
					{ "width": "28%", "targets": 5 },
					{ "width": "2%", "targets": 6 },
					{ "width": "9%", "targets": 7 },
					{ "width": "9%", "targets": 8 },
					{ "width": "2%", "targets": 9 },
				],
			});

			function formatNumber(num) {
				return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			}

			/* Formatting function for row details - modify as you need */
			function format(codigo_data) {
				// `d` is the original data object for the row
				var codigo_certificado=codigo_data.act_codigo;
				
				var dataenviar = { 
									"codigo_certificado" : codigo_data.act_codigo, 
								}	
								

				$.ajax({
					url:"certificadoshijos",
					type:"POST",
					data:dataenviar, 
					async:true,

					success: function(message){
						$("#certificadosHijos"+codigo_certificado).empty().append(message);
					}
				});

				return '<div id="certificadosHijos'+codigo_certificado+'"></div>';
			}

			// Add event listener for opening and closing details
			$('#certificados tbody').on('click', 'td.details-control', function(){
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


		function agregar(){

			var valor=1;
		$('#frmModal').modal({
				keyboard: true
		});
				$.ajax({
				url:"formcertificados",
				type:"POST",
				data:"variable="+1,
				//data: "codigo_actividad="+codigo_actividad+"&codigo_activida_realizada="+codigo_activida_realizada,
								async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
		}

		function editar(codigo_actividad){
			var codigo_actividad=codigo_actividad;

			$('#frmModal').modal({
					keyboard: true
			});
			$.ajax({
					url:"formMdfcarCertfcdo",
					type:"POST",
					data:"codigo_actividad="+codigo_actividad,
					async:true,

					success: function(message){
						$(".modal-content").empty().append(message);
					}
				});
		}

		function eliminar(codigo_actividad, certificado_actividad){
			var codigo_actividad=codigo_actividad;
			var certificado_actividad=certificado_actividad;

			$('#frmModal').modal({
					keyboard: true
			});
			$.ajax({
					url:"eliminarcertificado",
					type:"POST",
					data:"codigo_actividad="+codigo_actividad+'&certificado_actividad='+certificado_actividad,
					async:true,

					success: function(message){
						$(".modal-content").empty().append(message);
					}
				});
		}


	</script>
	<!-- *********************     Fin DataTable     *************************************** *-->

