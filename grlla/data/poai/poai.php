<?php
	include('crud/rs/plnDsrrllo.php');
	if($_REQUEST['codigo_plandesarrollo']){
		$codigo_plandesarrollo=$_REQUEST['codigo_plandesarrollo'];
	}
	else{
		$codigo_plandesarrollo = $objRsPlanDesarrollo->ultimo_plan();
	}
	
	$list_poais = $objRsPlanDesarrollo->list_poais($codigo_plandesarrollo);

	$visibilidad=$_SESSION['visibilidadBotones'];
?>		
<div class="row">
	<div class="col-sm-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<br>
		&nbsp;<span class="d-inline-block" tabindex="0"  title="Registrar POAI"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="agregar('<?php echo $codigo_plandesarrollo; ?>');"><i class="fas fa-plus"></i>&nbsp;<strong>REGISTRAR POAI</strong></button></span>
		<!--&nbsp;<span class="d-inline-block" tabindex="0"  title="Registrar POAI"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="trasladar('<?php echo $codigo_plandesarrollo; ?>');"><i class="fas fa-file-export"></i>&nbsp;<strong>TRASLADAR POAI</strong></button></span>-->
		&nbsp;<span class="d-inline-block" tabindex="0"  title="Reporte POAI"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="generarExcel('<?php echo $codigo_plandesarrollo; ?>');"><i class="fas fa-file-excel"></i>&nbsp;<strong>REPORTE POAI</strong></button></span>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label for="selVigencia" class="font-weight-bold">Vigencia Reporte *</label>
			<select name="selVigencia" id="selVigencia"  class="form-control caja_texto_sizer" data-size="8" data-rule-required="true" required>
				<?php
					foreach ($list_poais as $dta_vgncia_poai){
						$poav_vigencia = $dta_vgncia_poai['vigencia'];	
						$acuerdo = $dta_vgncia_poai['acuerdo'];					
						$descripcion = $dta_vgncia_poai['descripcion'];
						
				?>
					<option value="<?php echo $poav_vigencia."-".$acuerdo; ?>"><?php echo $descripcion; ?></option>
				<?php
					}
				?>
			</select>
			<span class="help-block" id="error"></span>
		</div>
	</div>
	
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

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dtatablepoai" class="table table-striped table-bordered">

</table>

<script>
	$(document).ready(function() {
		var table =	$('#dtatablepoai').DataTable({
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
				url: 'jpoai?<?php echo $codigo_plandesarrollo; ?>',
				type: 'POST'
			},
			columns: [
				{ data: 'referencia', title: 'REFERENCIA'},
				{ data: 'poav_vigencia', title: 'VIGENVIA'},
				{ data: 'descripcion', title: 'DESCRIPCIÓN NIVEL TRES'},
				{ data: 'nombre_fuente', title: 'FUENTE DE FINANCIACIÓN'},
				{ data: 'acuerdo_poai', title: 'ACUERDO'},
				{ data: 'nombre_sede', title: 'SEDE'},
				{ data: 'recursos', title: 'RECURSOS'},
				{ data: 'nombre_indicador', title: 'INDICADOR'},
				{ data: 'estado', title: 'ESTADO'},
				{
					data: null, 
					render: function (data, type, full, meta){
						if(full["tipo"] == 1){
							return '<div style="display:<?php echo $visibilidad; ?>;"><div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" style="color: #BB0900;" title="Modificar Saldo Fuente de Financiación" onclick="modificar(\''+full["pde_codigo"]+'\',\''+full["poav_codigo"]+'\');"></i></div>&nbsp;<div class="d-inline-block"><i class="fas fa-plus-circle fa-lg color_icono" style="color: #BB0900;" title="Adicionar" onclick="agg_adicion(\''+full["pde_codigo"]+'\',\''+full["poav_codigo"]+'\');"></i></div>&nbsp;<div class="d-inline-block"><div style="display: '+full["boton_traslado"]+'"><i class="fas fa-file-export fa-lg color_icono" title="Trasladar" onclick="trasladar(\''+full["pde_codigo"]+'\',\''+full["poav_codigo"]+'\');"></i></div></div></div>';
						}
						else{
							return '<div style="display:<?php echo $visibilidad; ?>;"><div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" style="color: #BB0900;" title="Modificar Saldo Fuente de Financiación" onclick="traslado_modificar(\''+full["pde_codigo"]+'\',\''+full["codigo_traslado"]+'\',\''+full["poav_codigo"]+'\');"></i></div></div>';
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
			scrollY:        "600px",
			scrollCollapse: true,
			paging:         false,
			buttons:        [ 'colvis' ],
			fixedColumns:   {
				leftColumns: 2
			},
			"order": [[0, 'asc'], [1, 'asc']],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
				{ "width": "4%", "targets": 1 },
                { "width": "19%", "targets": 2 },
                { "width": "15%", "targets": 3 },
				{ "width": "12%", "targets": 4 },
				{ "width": "10%", "targets": 5 },
                { "width": "13%", "targets": 6 },
				{ "width": "10%", "targets": 7 },
				{ "width": "5%", "targets": 8 },
				{ "width": "5%", "targets": 9 },
				{ "width": "2%", "targets": 10 },
            ],
		});


		function formatNumber(num) {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
		}
		/////Inicio Mas primera columna
		function format(codigo_data) {
			var codigo_plan = codigo_data.pde_codigo;
			var codigo_poai = codigo_data.poav_codigo;
			var dataenviar = {
								"codigo_plan": codigo_plan,
								"codigo_poai": codigo_poai
							}

			$.ajax({
				url:"infopoai",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#info_poai"+codigo_poai).empty().append(message);
				}
			});

			return '<div id="info_poai'+codigo_poai+'"></div>';
		}
		// Fin Mas primera columna
		// Add event listener for opening and closing details
		$('#dtatablepoai tbody').on('click', 'td.details-control', function(){
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
	
	function agregar(codigo_plan){
		var codigo_plan = codigo_plan;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formpoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function trasladar(codigo_plan, codigo_poai){
		var codigo_plan = codigo_plan;
		var codigo_poai = codigo_poai;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formtrasladospoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan+'&codigo_poai='+codigo_poai,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function traslado_modificar(codigo_plan, codigo_poai, codigo_traslado){
		var codigo_plan = codigo_plan;
		var codigo_poai = codigo_poai;
		var codigo_traslado = codigo_traslado;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formtrasladospoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan+'&codigo_poai='+codigo_poai+'&codigo_traslado='+codigo_traslado,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function modificar(codigo_plan, codigo_poai){
		var codigo_plan = codigo_plan;
		var codigo_poai = codigo_poai;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formpoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan+'&codigo_poai='+codigo_poai,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function agg_adicion(codigo_plan, codigo_poai){
		var codigo_plan = codigo_plan;
		var codigo_poai = codigo_poai;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formadicionpoai",
			type:"POST",
			data:"codigo_plan="+codigo_plan+'&codigo_poai='+codigo_poai,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}
	

	function generarExcel(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
		var datos = $('#selVigencia').val();
		var data_imp = datos.split('-');
		var vigencia = data_imp[0];
		var acuerdo = data_imp[1];

		if(vigencia){
			if(acuerdo == 0){
				window.location.href = 'excelreportepoai?codigo_plan='+codigo_plandesarrollo+'&vigencia='+vigencia;        
			}
			else{
				window.location.href = 'excelreportepoaiacuerdo?codigo_plan='+codigo_plandesarrollo+'&vigencia='+vigencia+'&acuerdo='+acuerdo;        
			}
		}
        
    }

</script>


<!-- *********************     Fin DataTable     *************************************** *-->
