
<!------ Include the above in your HEAD tag ---------->
<?php
    include('data/sbsstma.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('prncpal/hd.php'); ?>
    <link rel="stylesheet" href="DataTables/datatables.min.css" />
    <script src="DataTables/datatables.min.js"></script>
</head>

<body>

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
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>REGISTRO APERTURA REPORTE</strong></h2></div>

                    <div class="col-sm-12">&nbsp;</div>
					<?php $visibilidad=$_SESSION['visibilidadBotones']; ?>
                    <span class="d-inline-block" tabindex="0"  title="Registro Apertura Reporte"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="agregar();"><i class="fas fa-plus"></i>&nbsp;<strong>Crear Apertura Reporte</strong></button></span>
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
				

            		<div class="col-sm-8" id="tablaAperturaReporte">
						<!-- **********************     Inicio Tabla Datatable     *********************************** -->
						<table id="dataAperturaReporte" class="table table-striped table-bordered">

						</table>

						<script>
							$(document).ready(function() {
								var table =	$('#dataAperturaReporte').DataTable({
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
										url: 'japerturareporte',
										type: 'POST'
									},
									columns: [
										{ data: 'apr_fechainicio', title: 'Fecha Inicio'},
										{ data: 'apr_fechafin', title: 'Fecha Fin'},
										{ data: 'apr_trimestres', title: 'Trimestre'},
										{
											data: null,
											render: function (data, type, full, meta){
												return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Apertura Reporte" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["apr_codigo"]+'\');"></i> </div>';
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
								});


								function formatNumber(num) {
									return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
								}

									// Add event listener for opening and closing details
									$('#dataAperturaReporte tbody').on('click', 'td.details-control', function(){
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
										url:"formaperturareporte",
										type:"POST",
										data:"valor="+valor,
										async:true,

										success: function(message){
											$(".modal-content").empty().append(message);
										}
									});
							}
							function editar(codigo_apertura){
								var codigo_apertura=codigo_apertura;

								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
										url:"formaperturareporte",
										type:"POST",
										data:"codigo_apertura="+codigo_apertura,
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

