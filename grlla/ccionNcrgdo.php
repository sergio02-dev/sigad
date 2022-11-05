
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
					<div class="col-sm-12 modal-header"><h1>Registro Encargado Acción </h1></div>

                    <div class="col-sm-12">&nbsp;</div>
                    <hr/>

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


                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->

                    <div class="row">
                        <div class="col-sm-4">
                        <?php include('crud/rs/plnccion.php') ?>
                            <div class="form-group">
                                <label for="selPlanDesarrollo" class="font-weight-bold">Plan Desarrollo  </label> <a href="Javascript:modalInfo();"></a>
                                <!-- <input type="text" class="form-control" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" data-rule-required="true" required> -->
                                <select name="selPlanDesarrollo" id="selPlanDesarrollo"  class="form-control" data-rule-required="true" required <?php echo $disabled; ?> >
                                    <option value="0" data-codigospla='0'>Seleccione...</option>
                                    <?php
                                        foreach ($plan_desarrollo as $dataPlanDesarrollo) {

                                            $pde_codigo=$dataPlanDesarrollo['pde_codigo'];
                                            $pde_nombre=$dataPlanDesarrollo['pde_nombre'];

                                    ?>
                                        <option value="<?php echo  $pde_codigo; ?>"  data-codigospla="<?php echo $pde_codigo; ?>" ><?php echo $pde_nombre; ?></option>
                                    <?php
                                        }

                                    ?>
                                </select>
                                <span class="help-block" id="error"></span>
                            </div>
                        <script type="text/javascript">
                            $('#selPlanDesarrollo').change(function(){
                            var codigo_plandesarrollo=$(this).find(':selected').data('codigospla');
                            //alert('--->'+codigo_plandesarrollo);
                                if(codigo_plandesarrollo==0){

                                }
                                else{
                                    $.ajax({
                                    url:"dataencargadoaccion",
                                    type:"POST",
                                    data:"codigo_plandesarrollo="+codigo_plandesarrollo,
                                    async:true,

                                    success: function(message){
                                    //$(".modal-body").empty().append(message);
                                    $("#accion_encargado").empty().append(message);
                                    }
                                    });

                                }
                            });
                        </script>
                        </div>
                        <div class="col-sm-8">
                        </div>
                    </div>

                    <!------------------------------------------- FIN SELECT PLAN ACCIÓN -------------------------------!-->

                    <!------------------------------------------ INICIO DATA PLAN ACCIÓN ------------------------------------!-->

                    <div class="row">
                        <div class="col-sm-12" id="accion_encargado">
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
