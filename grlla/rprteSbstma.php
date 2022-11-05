
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
					<div class="col-sm-12 modal-header capa_titulo"><h2><strong>REPORTE SUBSISTEMA</strong> </h2></div>

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
                                    <option value="<?php echo $pde_codigo; ?>" data-plan="<?php echo $pde_codigo; ?>"><?php echo $pde_nombre; ?></option>
                                    <?php
                                        }    
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                
                    

                    <!-- ********************************** INICIO ACORDION  ******************************* -->
                    <div class="col-sm-12 accordion-container" id="acordeones">

                        <div class="row">
                            <?php
                                $personaSistema = $_SESSION['idusuario'];  
                                
                                if(($personaSistema==201604281729001)||($personaSistema==1)){
                            ?>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select name="selVigencia" id="selVigencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
                                            <option value="">Todas las Vigencias</option>
                                            <?php
                                                $vigencias_certificado = $objRsPlanDesarrollo->vigencias_certificado();
                                                foreach($vigencias_certificado as $data_vigencia_certificado){
                                                    $act_vigencia = $data_vigencia_certificado['act_vigencia'];
                                            ?>
                                            <option value="<?php echo $act_vigencia; ?>"><?php echo $act_vigencia; ?></option>
                                            <?php
                                                }    
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <span class="glyphicon glyphicon-search"><button class="btn btn-danger btn-sm" onclick="excelReporte()"><i class="fas fa-file-excel"></i>&nbsp;<strong>Excel Certificados</strong></a></span>
                                </div>
                                
                            <?php
                                }
                            ?>
                        </div>

                        
                 
                    </div>

                    <!-- ********************************  FIN ACORDION  ************************************** -->
				</div>
			</div>
		</div>




	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>

</html>
<script type="text/javascript">

    function excelReporte(){
        var plan_desarrollo='';
        var vigencia = $('#selVigencia').val();

        //alert("vigencias: "+vigencia);
        window.location.href = 'excelreportecertificado?plan_desarrollo='+plan_desarrollo+'&vigencia='+vigencia;	
    }

    $('#selPlanDesarrollo').change(function(){
        var planDesarrollo=$(this).find(':selected').data('plan');
        //alert('-- '+planDesarrollo);
        
        $.ajax({
            url:"datareporteplan",
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

