
<!------ Include the above in your HEAD tag ---------->
<?php
    include('data/sbsstma.php');
?>

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
				<!--..........................................FIN MENU..................................................-->

				</div>
				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header"><h1>Subsistemas </h1></div>
					<div class="col-sm-12"><!--<button type="button" class="btn btn-danger btn-sm float-right espacio-boton10" onClick=""><i class="fas fa-plus"></i> Crear Subsistema </button>--></div>

                    <div class="col-sm-12">&nbsp;</div>
                    <div class="col-sm-12">&nbsp;</div>
                    <hr/>

                   
                    <!-- ********************************** INICIO ACORDION  ******************************* -->
                    <div class="col-sm-12 accordion-container">
                       <!-- inicio contenido acordion -->
                            <div class="container">
                                <div id="accordion" class="accordion">
                                    <div class="card mb-0">

                                        <?php

                                            foreach ($dataSubsistema as $subsistemadatos) {

                                                $sub_codigo=$subsistemadatos['sub_codigo'];
                                                $sub_nombre=$subsistemadatos['sub_nombre'];
                                                $sub_referencia=$subsistemadatos['sub_referencia'];


                                        ?>
                                        <div class="card-header collapsed acoSubsistema" data-codigosubsistema="<?php echo $sub_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $sub_codigo; ?>" >
                                            <a class="card-title">
                                                <strong><?php echo $sub_nombre; ?> - <?php echo $sub_referencia; ?></strong>
                                            </a>
                                        </div>
                                        <div id="collapse<?php echo $sub_codigo; ?>" class="card-body collapse acccionsubsistema<?php echo $sub_codigo; ?>" data-parent="#accordion" >
                                            <p>
                                                Cargando...
                                            </p>
                                        </div>


                                        <?php
                                            }
                                        ?>



                                    </div>
                                </div>
                            </div>


                            <!-- Fin contenido acordion -->
                    </div>

                    <!-- ********************************  FIN ACORDION  ************************************** -->
				</div>
			</div>
		</div>




	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>

</html>
<script>
    /*function grid_accion(){
        //var codigoSubsistema=
    }*/


    $(".acoSubsistema").click(function(){
        var codigosubsistema = $(this).data("codigosubsistema");
        //alert("The paragraph was clicked."+codigosubsistema);

        $.ajax({
				url:"dataaccion",
				type:"POST",
				data:"codigo_subsistema="+codigosubsistema,
				async:true,

				success: function(message){
					$(".acccionsubsistema"+codigosubsistema).empty().append(message);
				}
			});


    });

</script>
