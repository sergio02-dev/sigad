
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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>INFORMEN DE SEGUIMIENTO PDI</strong> </h2></div>

                    <div class="col-sm-12">&nbsp;</div>
                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->

                    <div class="row">
						<div class="col-sm-3">
							&nbsp;
							<span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;" target="_blank" href="pdfSeguimiento/pdf_seguimiento.pdf" class="btn btn-danger btn-sm" ><i class="fas fa-file-excel"></i>&nbsp;<strong>Informe de Seguimiento PDI</strong></a></span>
						</div>
                       
                    </div>

				</div>
			</div>
		</div>


	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>

</html>
<script>
    
</script>
