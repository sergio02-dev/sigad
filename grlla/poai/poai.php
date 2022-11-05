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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>POAI</strong>  </h2></div>
                    
                    <div class="col-sm-12">&nbsp;</div>
                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->
                    <?php
                        //if($_SESSION['idusuario'] == 1 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1|| $_SESSION['idusuario'] == 201604281729001){
                    ?>
                    <div class="row">
                        <div class="col-sm-4">
                        <?php include('crud/rs/plnccion.php') ?>
                            <div class="form-group">
                                <label for="selPlanDesarrollo" class="font-weight-bold">Plan Desarrollo </label>
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
                                var codigo_plandesarrollo=$(this).find(':selected').data('codigospla');
                                if(codigo_plandesarrollo==0){

                                }
                                else{
                                    $.ajax({
                                        url:"dtapoai",
                                        type:"POST",
                                        data:"codigo_plandesarrollo="+codigo_plandesarrollo,
                                        async:true,

                                        success: function(message){
                                            $(".capa_poai").empty().append(message);
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
                        <div class="col-sm-12 capa_poai">
                        </div>
                    </div>
                    <?php
                        /*}
                        else{
                    ?>
                    <div class="row">
                        <div class="col-sm-12 capa_poai">
                            <?php include('grlla/data/poai.php'); ?>
                        </div>
                    </div>
                    <?php
                        }*/
                    ?>
                    <!------------------------------------------ FIN  DATA PLAN ACCIÓN ------------------------------------!-->
				</div>
			</div>
		</div>
	</div>
	<!-- *********************** fin de page container ************************************************ -->
</body>

</html>