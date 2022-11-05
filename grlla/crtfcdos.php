
<!------ Include the above in your HEAD tag ---------->
<?php
    //include('data/sbsstma.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('prncpal/hd.php'); ?>
    <link rel="stylesheet" href="DataTables/datatables.min.css" />
    <script src="DataTables/datatables.min.js"></script>

	<style>
		div#selectvigencia {
			position: absolute;
			margin-top: 4px;
			margin-left: 68%;
			height: 24px;
			z-index: 1000;
		}
	</style>
</head>

<body>

<style>
.modal-body {
	max-height: calc(100vh - 210px);
	overflow-y: auto;
}
</style>
	<!-- *************** Inicio de page container ************************************************ -->
	<div class="page-container" style='padding:0; margin:0;'>

		<div  class="container-fluid">
			<div class="row">
				<div class="col-sm-3">

				<!-- INICIO MENU -->
					<?php include('prncpal/mnu.php') ?>
				<!--..........................................FIN MENU..................................................-->

				</div>

				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>CERTIFICADOS</strong> </h2></div>

					<div class="col-sm-12">&nbsp;</div>
					<?php $visibilidad=$_SESSION['visibilidadBotones']; ?>
					<span class="d-inline-block" tabindex="0"  title="Registro de Certificados"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="agregar();"><i class="fas fa-plus"></i>&nbsp;<strong>Crear Certificado</strong></button></span>

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
					

						<div class="col-sm-12" id="tablaCertificados">
						<!-- **********************     Inicio Tabla Datatable     *********************************** -->
							<div id='selectvigencia'>
								<label>Subsistema</label>
								<select id="table-filter-sbs">
									<option value="">Todos</option>
									<option value="SA">SA</option>
									<option value="SB">SB</option>
									<option value="SF">SF</option>
									<option value="SP">SP</option>
									<option value="SI">SI</option>
									<!-- <option>Engineer</option>
									<option>Developer</option> -->
								</select>
								
								
								<label>Vigencia</label>
								<select id="table-filter">
									<option value="">Todos</option>
									<option value="2020">2020</option>
									<option value="2019">2019</option>
									<!-- <option>Engineer</option>
									<option>Developer</option> -->
								</select>
							</div>
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
										
										
									$('#table-filter').on('change', function(){
										var valorselect=$("#table-filter").val();
										filterColumn();
									});	
									$('#table-filter-sbs').on('change', function(){
										var valorselectsbs=$("#table-filter-sbs").val();
										filterColumn_sbs();
									});	
									
								});

								function filterColumn() {
									$('#certificados').DataTable().column(5).search($('#table-filter').val()).draw();
								}
								function filterColumn_sbs() {
									$('#certificados').DataTable().column(2).search($('#table-filter-sbs').val()).draw();
								}
								
								function agregar(){

									var valor=1;
									$('#frmModal').modal({
										keyboard: true
									});
									$.ajax({
										url:"formcertificados",
										type:"POST",
										data:"variable",
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

								function certificado_hijo(codigo_certificado, certificado){
									var codigo_certificado = codigo_certificado;
									var certificado = certificado;

									$('#frmModal').modal({
										keyboard: true
									});

									$.ajax({
										url:"eliminarcertificado",
										type:"POST",
										data:"codigo_certificado="+codigo_certificado+'&certificado='+certificado,
										async:true,

										success: function(message){
											$(".modal-content").empty().append(message);
										}
									});
								}



									
							
							</script>
							<!-- *********************     Fin DataTable     *************************************** *-->
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- *********************** fin de page container ************************************************ -->

</body>

</html>
