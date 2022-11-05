<!------ Include the above in your HEAD tag ---------->
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
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>REGISTRO DE ACTIVIDAD POR ACCI&Oacute;N </strong></h2></div>
				

                    <div class="col-sm-12">&nbsp;</div>
                    <?php 
                        include('crud/rs/lstdoPlnDsrrllo.php');
                        $planDesarrollo=$objRsPlanDesarrollo->PlanDesarrolloLista();
                    ?>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="selPlanDesarrollo" class="font-weight-bold">Plan de Desarrollo</label>
                                <select name="selPlanDesarrollo" id="selPlanDesarrollo" class="form-control caja_texto_sizer" data-rule-required="true" required>
                                    <option value="0" data-plan="0">Seleccione</option>
                                    <?php
                                        foreach($planDesarrollo as $dataPlan){
                                            $pde_codigo=$dataPlan['pde_codigo'];
                                            $pde_nombre=$dataPlan['pde_nombre'];
                                    ?>
                                    <option value="0" data-plan="<?php echo $pde_codigo; ?>"><?php echo $pde_nombre; ?></option>
                                    <?php
                                        }    
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- ********************************** INICIO ACORDION  ******************************* -->
                    <div class="col-sm-12 accordion-container" id="acordeones">
                       
                    </div>

                    <!-- ********************************  FIN ACORDION  ************************************** -->
				</div>
			</div>
		</div>




	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>
<script type="text/javascript">
  $('#selPlanDesarrollo').change(function(){
        var planDesarrollo=$(this).find(':selected').data('plan');
        //alert('-- '+planDesarrollo);
        
        $.ajax({
            url:"datasubsistemaplan",
            type:"POST",
            data:"planDesarrollo="+planDesarrollo,
            async:true,

            success: function(message){
            //$(".modal-body").empty().append(message);
            $("#acordeones").empty().append(message);
            }
        });

    });
</script>

</html>
