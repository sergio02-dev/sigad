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
					$nombrNivelUno=$objRsPlanDesarrollo->nivelUnoNombre();

					$datosPlanDesarrollo=$objRsPlanDesarrollo->datosPlan();

					foreach($datosPlanDesarrollo as $data_datosPlan){
						$pde_codigo=$data_datosPlan['pde_codigo'];
						$pde_actoadmin=$data_datosPlan['pde_actoadmin'];
						$pde_referencianiveluno=$data_datosPlan['pde_referencianiveluno'];
						$pde_niveluno=$data_datosPlan['pde_niveluno'];
						$pde_niveldos=$data_datosPlan['pde_niveldos'];
						$pde_niveltres=$data_datosPlan['pde_niveltres'];
						$pde_referencianiveldos=$data_datosPlan['pde_referencianiveldos'];
					}

                  
                ?>
				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>NIVEL DOS PLAN DE DESARROLLO <?php echo $nombrePlanDesarrollo; ?> </strong></h2></div>

                    <div class="col-sm-12">&nbsp;</div>

					<a href="plandesarrollo" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong> Regresar al Plan de Desarrollo </strong></a>
					<span class="d-inline-block" tabindex="0"  title="Agregar <?php echo $pde_niveldos; ?>"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="aggNivelDos('<?php echo $pde_codigo; ?>','<?php echo $pde_actoadmin; ?>', '<?php echo $pde_niveldos; ?>', '<?php echo $pde_referencianiveldos; ?>');"><i class="fas fa-plus"></i> <strong>Agregar <?php echo $pde_niveldos; ?> </strong></button></span>

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
                  

            		<div class="col-sm-12" id="tablaNivelDos">
						<!-- **********************     Inicio Tabla Datatable     *********************************** -->
						<table id="dataNivelDos" class="table table-striped table-bordered">

						</table>

						<script>
							$(document).ready(function() {
								var table =	$('#dataNivelDos').DataTable({
									"processing": true,
									"language": {
										"sProcessing":     "Procesando...",
										"sLengthMenu":     "Mostrar _MENU_ registros",
										"sZeroRecords":    "No se encontraron resultados",
										"sEmptyTable":     "Ning??n dato disponible en esta tabla",
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
										"sLast":     "??ltimo",
										"sNext":     "Siguiente",
										"sPrevious": "Anterior"
										},
										"oAria": {
										"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
										"sSortDescending": ": Activar para ordenar la columna de manera descendente"
										}
									},
									ajax: {
										url: 'jniveldos?<?php echo $codigoPlanDesarrollo;?>',
										type: 'POST'
									},
									columns: [
										{ data: 'sub_nombre', title: '<?php echo $nombrNivelUno; ?>'},
										{ data: 'referencia', title: 'Referencia'},
										{ data: 'pro_descripcion', title: 'Descripci??n'},
										{ data: 'pro_objetivo', title: 'Objetivo'},	
										/*{ data: 'responsable', title:'Responsable'},*/
										{ 
											data: null,
											render: function (data, type, full, meta){
												return '<div class="d-inline-block"><i class="fas fa-plus fa-lg color_icono" title="Agregar <?php echo $pde_niveltres; ?>" style="display:<?php echo $visibilidad; ?>;" onclick="aggNivelTres(\''+full["pde_codigo"]+'\',\''+full["add_codigo"]+'\',\''+full["sub_codigo"]+'\',\''+full["pro_codigo"]+'\',\''+full["ref"]+'\');"></i> </div> &nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" title="Editar Nivel Dos" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["pro_codigo"]+'\',\''+full["pde_codigo"]+'\');"></i> </div>&nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-user-plus fa-lg color_icono" title="Agregar Responsable Nivel Dos" style="display:<?php echo $visibilidad; ?>;" onclick="responsable_nivel(\''+full["pro_codigo"]+'\');"></i></div>';		
											},
											//title: '<?php echo $pde_niveltres;?>'
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
									"order": [[1, 'asc']],
									"columnDefs": [
										{ "width": "22%", "targets": 0 },
										{ "width": "10%", "targets": 1 },
										{ "width": "23%", "targets": 2 },
										{ "width": "28%", "targets": 3 },
										/*{ "width": "15%", "targets": 4 },*/
										{ "width": "12%", "targets": 4 },
										{ "width": "5%", "targets": 5 },
									],
								});


								function formatNumber(num) {
									return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
								}

								/* Formatting function for row details - modify as you need */
								function format(codigo_data) {
									
									var codigo_nivel = codigo_data.pro_codigo;

									var dataenviar = { 
														"codigo_nivel" : codigo_data.pro_codigo, 
														"nivel" : 2, 
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
								$('#dataNivelDos tbody').on('click', 'td.details-control', function(){
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

						
							function editar(codigo_nivelDos, codigo_planDesarrollo){
								var codigo_nivelDos=codigo_nivelDos;
								var codigo_planDesarrollo=codigo_planDesarrollo;

								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveldos",
									type:"POST",
									data:"codigo_nivelDos="+codigo_nivelDos+'&codigo_planDesarrollo='+codigo_planDesarrollo,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

							function aggNivelDos(codigo_plandesarrollo, actoAdministrativo, nombre_niveluno, referencia_nivelDos){
								var codigo_plandesarrollo=codigo_plandesarrollo;
								var actoAdministrativo=actoAdministrativo;
								var nombre_niveluno=nombre_niveluno;
								var referencia_nivelDos=referencia_nivelDos;

								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveldos",
									type:"POST",
									data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&nombre_niveluno='+nombre_niveluno+'&referencia_nivelDos='+referencia_nivelDos,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

							function aggNivelTres(codigo_plandesarrollo, actoAdministrativo, codigoNivelUno, codigoNivelDos,ref){
								var codigo_plandesarrollo=codigo_plandesarrollo;
								var actoAdministrativo=actoAdministrativo;
								var codigoNivelUno=codigoNivelUno;
								var codigoNivelDos=codigoNivelDos;
								var ref=ref;

								//alert(codigoNivelUno+"-----"+codigoNivelDos+"------"+ref)
 								$('#frmModal').modal({
										keyboard: true
								});
								$.ajax({
									url:"formniveltres",
									type:"POST",
									data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&codigoNivelUno='+codigoNivelUno+'&codigoNivelDos='+codigoNivelDos+'&ref='+ref,
									async:true,

									success: function(message){
										$(".modal-content").empty().append(message);
									}
								});
							}

							function responsable_nivel(codigo_nivel){
								var codigo_nivel = codigo_nivel;
								var nivel = 2;
								var tipo_responsable = 1;
								
								$('#frmModal').modal({
									keyboard: true
								});
								$.ajax({
									url:"formresponsable",
									type:"POST",
									data:"codigo_nivel="+codigo_nivel+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
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
