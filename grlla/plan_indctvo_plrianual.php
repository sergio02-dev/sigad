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
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>PLAN INDICATIVO</strong></h2></div>

                    <div class="col-sm-12">&nbsp;</div>
					
                    
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


           			<div class="col-sm-12" id="datosListarPlanPlurianual">
						<?php include('grlla/data/plan_indctvo_plrianual.php'); ?>
					</div>
				
				</div>
			</div>
		</div>

	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>

</html>
