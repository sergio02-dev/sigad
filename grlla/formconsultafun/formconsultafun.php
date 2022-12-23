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
        .modal-body {
            max-height: calc(100vh - 210px);
            overflow-y: auto;
        }
	</style>
</head>

<body>
	<div class="page-container" style='padding:0; margin:0;'>

		<div  class="container-fluid">
			<div class="row">
				<div class="col-sm-3">

				<!-- INICIO MENU -->
					<?php include('prncpal/mnu.php') ?>
				<!--..........................................FIN MENU..................................................-->

				</div>

				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>CONSULTAS DE FUNCIONAMIENTO</strong> </h2></div>

					<div class="col-sm-12">&nbsp;</div>
                    

					<?php $visibilidad=$_SESSION['visibilidadBotones']; ?>

                    <div class="col-sm-12" id="dtaDependencia">
                        <?php 
                            include('grlla/data/formconsultafun/formconsultafun.php');
                        ?>
                    </div>
						
                </div>
            </div>
        </div>
    </div>
</body>

</html>
