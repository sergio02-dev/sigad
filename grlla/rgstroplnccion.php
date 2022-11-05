
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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>REGISTRO PLAN DE ACCI&Oacute;N</strong>  </h2></div>
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
                    <div class="col-sm-12">&nbsp;</div>

                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->

                    <?php
                        if($_SESSION['idusuario'] == 1 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1|| $_SESSION['idusuario'] == 201604281729001){
                    ?>
                    <div class="row">
                        <div class="col-sm-4">
                        <?php include('crud/rs/plnccion.php') ?>
                            <div class="form-group">
                                <label for="selPlanDesarrollo" class="font-weight-bold">Plan Desarrollo </label> <a href="Javascript:modalInfo();"></a>
                                <!-- <input type="text" class="form-control" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" data-rule-required="true" required> -->
                                <select name="selPlanDesarrollo" id="selPlanDesarrollo"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
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
                                var codigo_planaccion=$(this).find(':selected').data('codigospla');
                                //alert('--->'+codigo_planaccion);
                                if(codigo_planaccion==0){

                                }
                                else{
                                    $.ajax({
                                        url:"dataplanaccion",
                                        type:"POST",
                                        data:"codigo_planaccion="+codigo_planaccion,
                                        async:true,

                                        success: function(message){
                                            //$(".modal-body").empty().append(message);
                                            $("#plan_accion").empty().append(message);
                                        }
                                    });

                                }
                            });
                        </script>
                        </div>
                        <div class="col-sm-8">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="plan_accion">
                        </div>
                    </div>
                    <?php
                        }
                        else{
                    ?>
                        <div class="PlanReportar">
                            <?php include('grlla/data/dtaplnccion.php'); ?>
                        </div>
                    <?php
                        }
                    ?>

                    

                    <!------------------------------------------ FIN  DATA PLAN ACCIÓN ------------------------------------!-->
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
				url:"formplanaccion",
				type:"POST",
				data:"valor="+valor,
                async:true,

				success: function(message){
					$(".modal-content").empty().append(message);
				}
			});
    }

</script>
