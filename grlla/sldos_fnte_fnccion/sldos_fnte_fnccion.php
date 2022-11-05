<!DOCTYPE html>
<html lang="es">

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
                    <!--......FIN MENU......-->
				</div>
				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>RECURSOS DE BALANCE</strong></h2></div>
                    
                    <div class="col-sm-12">&nbsp;</div>
                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->
                  
                    <div class="row">
                        <div class="col-sm-12 saldo_fuente">
                            <?php include('grlla/data/sldos_fnte_fnccion/sldos_fnte_fnccion.php'); ?>
                        </div>
                    </div>
                    <!------------------------------------------ FIN  DATA PLAN ACCIÓN ------------------------------------!-->
				</div>
			</div>
		</div>
	</div>
	<!-- *********************** fin de page container ************************************************ -->
</body>

</html>