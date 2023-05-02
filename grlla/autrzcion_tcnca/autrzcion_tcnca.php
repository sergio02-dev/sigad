<?php
/**
 * Karen Yuliana Palacio Minú
 * 23 de Abril 2023 10:00pm 
 * Grilla Autorización Tecnica Solicitud CDP
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('prncpal/hd.php'); ?>
    <link rel="stylesheet" href="DataTables/datatables.min.css" />
    <script src="DataTables/datatables.min.js"></script>
	<style>
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
					<div class="col-sm-12 modal-header capa_titulo"><h3><strong>AUTORIZACI&Oacute;N T&Eacute;CNICA SOLICITUD DE CDP</strong></h3></div>

					<div class="col-sm-12">&nbsp;</div>

                    <div class="col-sm-12" id="dataAutorizacionTecnica">
                        <?php 
                            include('grlla/data/autrzcion_tcnca/autrzcion_tcnca.php');
                        ?>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</body>
</html>