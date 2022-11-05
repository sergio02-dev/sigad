<!------ Include the above in your HEAD tag ---------->
<?php
    include('data/sbsstma.php');
	$codigoPlanDesarrollo=$iduno;
	//$nombreNivel=$codigo_elemento2;

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
					<?php include('prncpal/mnu.php') ?>
				</div>
					<?php
						$visibilidad=$_SESSION['visibilidadBotones'];
						include('crud/rs/plnDsrrllo.php'); 
						$objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigoPlanDesarrollo);
						$nombrePlanDesarrollo=$objRsPlanDesarrollo->nombrePlanDesarrollo();
						$nombrNivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
						$nombrNivelDos=$objRsPlanDesarrollo->nivelDosNombre();

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
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong> NIVEL TRES PLAN DE DESARROLLO <?php echo $nombrePlanDesarrollo; ?> </strong></h2></div>

                    <div class="col-sm-12">&nbsp;</div>
					<a href="plandesarrollo" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong>Regresar al Plan de Desarrollo </strong></a>
					<span class="d-inline-block" tabindex="0"  title="Agregar <?php echo $pde_niveldos; ?>"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="aggNivelTres('<?php echo $pde_codigo; ?>','<?php echo $pde_actoadmin; ?>', '<?php echo $pde_niveluno; ?>', '<?php echo $pde_niveldos; ?>');"><i class="fas fa-plus"> </i> <strong>Agregar <?php echo $pde_niveltres; ?></strong></button></span>
					<!-- **********************          Inicio Modal Forma    *********************************** -->
					<div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								Cargando...
							</div>
						</div>
					</div>
					<!-- **********************          Fin Modal Forma       *********************************** -->
					

            	<div class="col-sm-12" id="tablaNivelTres">
					<?php
						$personaSistema = $_SESSION['idusuario'];
						///echo "---> ".$personaSistema;
					?>
						<!-- **********************     Inicio Tabla Datatable     *********************************** -->
					<table id="dataNivelTres" class="table table-striped table-bordered">

					</table>

					<script>
						$(document).ready(function() {
							var table =	$('#dataNivelTres').DataTable({
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
									url: 'jniveltres?<?php echo $codigoPlanDesarrollo;?>',
									type: 'POST'
								},
								columns: [
									
									{ data: 'sub_nombre', title: '<?php echo $nombrNivelUno; ?>'},
                					//{ data: 'acc_codigo', title: '<?php echo $nombreNivelUno; ?>'},
									{ data: 'pro_descripcion', title: '<?php echo $nombrNivelDos; ?>'},
									{ data: 'referencia', title: 'Codigo'},	
									{ data: 'acc_descripcion', title: '<?php echo $pde_niveltres; ?>'},
									{
										data: null, 
										render: function (data, type, full, meta){
											return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Nivel Tres" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["acc_codigo"]+'\', \''+full["pde_codigo"]+'\');"></i></div>';
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
								"order": [[1, 'asc']],
								"columnDefs": [
									{ "width": "20%", "targets": 0 },
									{ "width": "30%", "targets": 1 },
									{ "width": "10%", "targets": 2 },
									{ "width": "32%", "targets": 3 },
									{ "width": "4%", "targets": 4 },
									{ "width": "4%", "targets": 5 },
								],
							});


							function formatNumber(num) {
								return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
							}

							function format(codigo_data) {
						
								var codigo_nivelTres=codigo_data.acc_codigo;
								var dataenviar = { 
												"codigo_accion" : codigo_data.acc_codigo, 
												"codigo_planDesarrollo" : codigo_data.pde_codigo, 
												}			

								$.ajax({
									url:"indicador",
									type:"POST",
									data:dataenviar, //"codigo_actividad="+codigo_actividad,
									async:true,

									success: function(message){
										$("#registroIndicador"+codigo_nivelTres).empty().append(message);
									}
								});

								return '<div id="registroIndicador'+codigo_nivelTres+'"></div>';
							}

							// Add event listener for opening and closing details
							$('#dataNivelTres tbody').on('click', 'td.details-control', function(){
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
					
						function editar(codigo_NivelTres, codigo_planDesarrollo){
							var codigo_NivelTres=codigo_NivelTres;
							var codigo_planDesarrollo=codigo_planDesarrollo;

							$('#frmModal').modal({
								keyboard: true
							});
							$.ajax({
								url:"formniveltres",
								type:"POST",
								data:"codigo_NivelTres="+codigo_NivelTres+'&codigo_planDesarrollo='+codigo_planDesarrollo,
								async:true,

								success: function(message){
									$(".modal-content").empty().append(message);
								}
							});
						}

						function addDelegado(codigo_NivelTres, codigo_planDesarrollo){
							var codigo_NivelTres=codigo_NivelTres;
							var codigo_planDesarrollo=codigo_planDesarrollo;

							$('#frmModal').modal({
								keyboard: true
							});
							$.ajax({
								url:"formdelegado",
								type:"POST",
								data:"codigo_NivelTres="+codigo_NivelTres+'&codigo_planDesarrollo='+codigo_planDesarrollo,
								async:true,

								success: function(message){
									$(".modal-content").empty().append(message);
								}
							});
						}

						function aggNivelTres(codigo_plandesarrollo, actoAdministrativo, nombre_niveluno, nombre_niveldos){
							var codigo_plandesarrollo=codigo_plandesarrollo;
							var actoAdministrativo=actoAdministrativo;
							var nombre_niveluno=nombre_niveluno;
							var nombre_niveldos=nombre_niveldos;

							$('#frmModal').modal({
								keyboard: true
							});
							$.ajax({
								url:"formniveltres",
								type:"POST",
								data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&nombre_niveluno='+nombre_niveluno+'&nombre_niveldos='+nombre_niveldos,
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
