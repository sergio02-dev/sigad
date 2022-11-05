<!------ Include the above in your HEAD tag ---------->
<?php
    include('data/sbsstma.php');
    $codigoPlanDesarrollo=$iduno;
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
                <?php
					$visibilidad=$_SESSION['visibilidadBotones'];
                    include('crud/rs/plnDsrrllo.php'); 
                    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigoPlanDesarrollo);
					$nombrePlanDesarrollo=$objRsPlanDesarrollo->nombrePlanDesarrollo();
					
					$datosPlanDesarrollo=$objRsPlanDesarrollo->datosPlan();

					foreach($datosPlanDesarrollo as $data_datosPlan){
						$pde_codigo=$data_datosPlan['pde_codigo'];
						$pde_actoadmin=$data_datosPlan['pde_actoadmin'];
						$pde_referencianiveluno=$data_datosPlan['pde_referencianiveluno'];
						$pde_niveluno=$data_datosPlan['pde_niveluno'];
						$pde_niveldos=$data_datosPlan['pde_niveldos'];
					}

                  
                ?>
				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>NIVEL UNO PLAN DE DESARROLLO <?php echo $nombrePlanDesarrollo; ?></strong> </h2></div>
                    <div class="col-sm-12">&nbsp;</div>
                
					<a href="plandesarrollo" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong> Regresar al Plan de Desarrollo</strong></a>
					<span class="d-inline-block" tabindex="0"  title="Agregar <?php echo $pde_niveluno; ?>"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="aggNivelUno('<?php echo $pde_codigo; ?>','<?php echo $pde_actoadmin; ?>', '<?php echo $pde_referencianiveluno; ?>');"><i class="fas fa-plus"> <strong>Agregar <?php echo $pde_niveluno; ?></strong></i></button></span>
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
			
      
					<div class="col-sm-12" id="tablaNivelUno">
						<!-- **********************     Inicio Tabla Datatable     *********************************** -->
						<table id="dataNivelUno" class="table table-striped table-bordered">

						</table>

						<script>
							$(document).ready(function() {
								var table =	$('#dataNivelUno').DataTable({
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
										url: 'jniveluno?<?php echo $codigoPlanDesarrollo;?>',
										type: 'POST'
									},
									columns: [
										{ data: 'sub_nombre', title: 'Nombre del Nivel'},
										{ data: 'sub_referencia', title: 'Referencia'},
										{ data: 'oficina', title: 'Oficina'},
										{ data: 'cargo', title: 'Responsable'},
										{
											data: null,
											render: function (data, type, full, meta){
												return '<div class="d-inline-block"> <i class="fas fa-plus fa-lg color_icono" title="Agregar '+full["pde_niveldos"]+'" style="display:<?php echo $visibilidad; ?>;" onclick="aggNivelDos(\''+full["pde_codigo"]+'\',\''+full["pde_actoadmin"]+'\',\''+full["pde_niveluno"]+'\',\''+full["pde_referencianiveldos"]+'\',\''+full["sub_codigo"]+'\',\''+full["sub_referencia"]+'\');"></i> </div> &nbsp;<div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" title="Editar Nivel Uno" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["sub_codigo"]+'\',\''+full["pde_codigo"]+'\');"></i></div><!--<div class="d-inline-block"> <i class="fas fa-user-plus fa-lg color_icono" title="Responsable Nivel Uno" style="display:<?php echo $visibilidad; ?>;" onclick="responsable_nivel(\''+full["sub_codigo"]+'\');"></i></div>-->';
											},
											//title: '<?php echo $pde_niveldos; ?>'
										},
										/*{
											"className":      'details-control',
											"orderable":      false,
											"data":           null,
											"defaultContent": ''
										},	*/

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
									"order": [[0, 'asc']],
									"columnDefs": [
										{ "width": "45%", "targets": 0 },
										{ "width": "9%", "targets": 1 },
										{ "width": "22%", "targets": 2 },
										{ "width": "16%", "targets": 3 },
										{ "width": "8%", "targets": 4 },
									],
								});


								function formatNumber(num) {
									return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
								}

								/* Formatting function for row details - modify as you need */
								function format(codigo_data) {
								
									var codigo_nivel = codigo_data.sub_codigo;

									var dataenviar = { 
														"codigo_nivel" : codigo_data.sub_codigo, 
														"nivel" : 1, 
													}	
													
									$.ajax({
										url:"inforesponsable",
										type:"POST",
										data:dataenviar, 
										async:true,

										success: function(message){
											$("#rsponsables_info"+codigo_nivel).empty().append(message);
										}
									});

									return '<div id="rsponsables_info'+codigo_nivel+'"></div>';
								}

								// Add event listener for opening and closing details
								$('#dataNivelUno tbody').on('click', 'td.details-control', function(){
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

							function aggNivelUno(codigo_plandesarrollo, actoAdministrativo, referencia_nivelUno){
								var codigo_plandesarrollo=codigo_plandesarrollo;
								var actoAdministrativo=actoAdministrativo;
								var referencia_nivelUno=referencia_nivelUno;
								//alert(referencia_nivelUno);

								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveluno",
									type:"POST",
									data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&referencia_nivelUno='+referencia_nivelUno,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

							function aggNivelDos(codigo_plandesarrollo, actoAdministrativo, nombre_niveluno, referencia_nivelDos, codigo_nivelUno, referencia_nivelUno){
								var codigo_plandesarrollo=codigo_plandesarrollo;
								var actoAdministrativo=actoAdministrativo;
								var nombre_niveluno=nombre_niveluno;
								var referencia_nivelDos=referencia_nivelDos;
								var codigo_nivelUno=codigo_nivelUno;
								var referencia_nivelUno=referencia_nivelUno;

								//alert(codigo_nivelUno);

								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveldos",
									type:"POST",
									data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&nombre_niveluno='+nombre_niveluno+'&referencia_nivelDos='+referencia_nivelDos+'&codigo_nivelUno='+codigo_nivelUno+'&referencia_nivelUno='+referencia_nivelUno,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

						
							function editar(codigo_niveluno, codigo_planDesarrollo){
								var codigo_niveluno=codigo_niveluno;
								var codigo_planDesarrollo=codigo_planDesarrollo;
								//alert(codigo_niveluno);
								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveluno",
									type:"POST",
									data:"codigo_niveluno="+codigo_niveluno+'&codigo_planDesarrollo='+codigo_planDesarrollo,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

							function responsable_nivel(codigo_nivel){
								var codigo_nivel = codigo_nivel;
								var nivel = 1;
								
								$('#frmModal').modal({
									keyboard: true
								});
								$.ajax({
									url:"formresponsable",
									type:"POST",
									data:"codigo_nivel="+codigo_nivel+'&nivel='+nivel,
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
<script>

    function agregar(){
        //alert('hola');
        var valor=1;
       // alert(codigo_accion);

		$('#frmModal').modal({
				keyboard: true
		});
        $.ajax({
				url:"formplandesarrollo",
				type:"POST",
				data:"valor="+valor,
                async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }

</script>
