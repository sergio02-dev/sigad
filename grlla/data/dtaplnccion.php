<?php
	include('crud/rs/plnDsrrllo.php');
	if($_REQUEST['codigo_planaccion']){
		$codigo_planaccion=$_REQUEST['codigo_planaccion'];
	}
	else{
		$codigo_planaccion = $objRsPlanDesarrollo->ultimo_plan();
	}
	
	$visibilidad=$_SESSION['visibilidadBotones']; 
	$infoPlan=$objRsPlanDesarrollo->infoPlan($codigo_planaccion);

	$years=explode("-",$infoPlan);
	$inicio=$years[0];
	$fin=$years[1];
	$actual=date("Y");

	if($actual<$fin){
		$finmostrar=$actual;
	}
	else{
		$finmostrar=$fin;
	}

	$personaSistema = $_SESSION['idusuario'];
	$perfil = $_SESSION['perfil'];

	if($personaSistema==201604281729001 || $perfil==1){
		$excel_vista="block";
		$excel_vista_responsables="none";
	}
	else{
		$excel_vista="none";
		$excel_vista_responsables="block";
	}

	include('crud/rs/plnccion.php');


?>		
<div class="row">
	<div class="col-sm-9" style=" display:block;">
        <!--<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="generarExcel();"><i class="fas fa-file-excel"></i>&nbsp;Excel Plan Acci&oacute;n</a></span>-->
		<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="rprte_rcrso_poai_etpa('<?php echo $codigo_planaccion; ?>');"><i class="fas fa-file-excel"></i>&nbsp;<strong>Recursos Poai Etapa</strong></a></span>
		<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="rprte_asgnacion_pln_accion('<?php echo $codigo_planaccion; ?>');"><i class="fas fa-file-excel"></i>&nbsp;<strong>Asignacion de Recursos Plan Acci&oacute;n</strong></a></span>
		<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="rprte_pln_accion('<?php echo $codigo_planaccion; ?>');"><i class="fas fa-file-excel"></i>&nbsp;<strong>Excel Plan Acci&oacute;n</strong></a></span>
		<!--<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="generarExcelReponsable();"><i class="fas fa-file-excel"></i>&nbsp;<strong>Excel Responsable Acci&oacute;n</strong></a></span>-->
	
	</div>
	<div class="col-sm-3" style=" display:none">
		<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF; " class="btn btn-danger btn-sm" onclick="generarExcelOtros();"><i class="fas fa-file-excel"></i>&nbsp;Excel Plan Acci&oacute;n</a></span>
	</div>
	

	
</div>

<div class="col-sm-12">

</div>

<input type="hidden" id="codigo_planDesarrollo" value="<?php echo $codigo_planaccion; ?>">
		
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
<br><br>

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataplanaccion" class="table table-striped table-bordered">

</table>

<script>
	$(document).ready(function() {
		var table =	$('#dataplanaccion').DataTable({
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
				url: 'jplanaccion?<?php echo $codigo_planaccion; ?>',
				type: 'POST'
			},
			columns: [
				{ data: 'referenciaAccion', title: 'Referencia'},
				{ data: 'sub_nombre', title: 'Subsistema'},
				{ data: 'pro_descripcion', title: 'Proyecto'},
				{ data: 'acc_descripcion', title: 'Acción'},
				{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{
					data: null, 
					render: function (data, type, full, meta){
						return '<div style="display:<?php echo $visibilidad; ?>;"><i class="fas fa-plus-circle" style="color: #BB0900;" title="Crear POAI" onclick="registrar(\''+full["pde_codigo"]+'\',\''+full["sub_codigo"]+'\',\''+full["pro_codigo"]+'\',\''+full["acc_codigo"]+'\',\''+full["referenciaAccion"]+'\');"></i></div>';
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
			"order": [[1, 'asc']],
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
		$('#dataplanaccion tbody').on('click', 'td.details-control', function(){
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


	function generarExcel(){
		var codigo_planDesarrollo=$('#codigo_planDesarrollo').val();

		window.location.href = 'excelplanaccion?codigo_planDesarrollo='+codigo_planDesarrollo;
	}



	function generarExcelOtros(){
		var codigo_planDesarrollo=$('#codigo_planDesarrollo').val();
		
		window.location.href = 'reporteplanaccionresponsable?codigo_planDesarrollo='+codigo_planDesarrollo;	
	}

	function generarExcelPoai(){
		var codigo_plandesarrollo=$('#codigo_planDesarrollo').val();
		var vigencia=$('#selYearInicio').val();
		
		if(vigencia==0){

		}
		else{
			window.location.href = 'reporteexcelpoai?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia;	
		}
	}

	

	function rprte_pln_accion(codigo_planaccion){
		var codigo_planaccion = codigo_planaccion;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formrprteplanaccionadmin",
			type:"POST",
			data:"plan_desarrollo="+codigo_planaccion,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	function rprte_asgnacion_pln_accion(codigo_planaccion){
		var codigo_planaccion = codigo_planaccion;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formresporteasignacionrecursos",
			type:"POST",
			data:"plan_desarrollo="+codigo_planaccion,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

	
	function rprte_rcrso_poai_etpa(codigo_planaccion){
		var codigo_planaccion = codigo_planaccion;
			
		$('#frmModal').modal({
			keyboard: true
		});
		$.ajax({
			url:"formreporterecursospoaietapa",
			type:"POST",
			data:"plan_desarrollo="+codigo_planaccion,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}
	

	
	function registrar(codigo_planaccion,codigo_subsistema,codigo_proyecto, codigo_accion,referenciaAccion){
		var codigo_planaccion=codigo_planaccion;
		var codigo_subsistema=codigo_subsistema;
		var codigo_proyecto=codigo_proyecto;
		var codigo_accion=codigo_accion;
		var referenciaAccion=referenciaAccion;
			
		$('#frmModal').modal({
				keyboard: true
		});
		$.ajax({
			url:"formactividadpoai",
			type:"POST",
			data:"codigo_planaccion="+codigo_planaccion+"&codigo_subsistema="+codigo_subsistema+"&codigo_proyecto="+codigo_proyecto+"&codigo_accion="+codigo_accion+'&referenciaAccion='+referenciaAccion,
			async:true,

			success: function(message){
				$(".modal-content").empty().append(message);
			}
		});
	}

</script>


<!-- *********************     Fin DataTable     *************************************** *-->
