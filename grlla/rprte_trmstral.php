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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>REPORTE TRIMESTRAL</strong> </h2></div>

                    <div class="col-sm-12">&nbsp;</div>
                    <div class="col-sm-12">&nbsp;&nbsp;&nbsp;
                        <span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;"  href="excelSubir/t12019.xlsx" class="btn btn-danger btn-sm" ><i class="fas fa-file-excel"></i>&nbsp; <strong>T1 2019</strong></a></span>
                        <span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;"  href="excelSubir/t22019.xlsx" class="btn btn-danger btn-sm" ><i class="fas fa-file-excel"></i>&nbsp; <strong>T2 2019</strong></a></span>
                        <span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;"  href="excelSubir/t32019.xlsx" class="btn btn-danger btn-sm" ><i class="fas fa-file-excel"></i>&nbsp; <strong>T3 2019</strong></a></span>
                        <span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;"  href="excelSubir/t42019.xlsx" class="btn btn-danger btn-sm" ><i class="fas fa-file-excel"></i>&nbsp; <strong>T4 2019</strong></a></span>
                    </div>
                    <div class="col-sm-12">&nbsp;</div>
                   
                
                    

                    <!-- ********************************** INICIO ACORDION  ******************************* -->
                    <div class="col-sm-12 accordion-container" id="acordeones">

                    <?php 
                        $planDesarrollo=1;
                        include('data/sbsstma.php');

                        $dataSubsistemaPlan= $subsistema->selectSubsistemaPlan();

                    ?>
                    
                    <!-- ********************************** INICIO ACORDEON  ******************************* -->
                    <!-- inicio contenido acordion -->
                    <div class="container">

                        
                        <div id="accordion" class="accordion">
                            <div class="card mb-0">

                                <?php
                                if($dataSubsistemaPlan){
                                    foreach ($dataSubsistemaPlan as $subsistemadatos) {

                                        $sub_codigo = $subsistemadatos['sub_codigo'];
                                        $sub_nombre = $subsistemadatos['sub_nombre'];
                                        $sub_referencia = $subsistemadatos['sub_referencia'];
                                        $sub_ref = $subsistemadatos['sub_ref'];
                                        $pde_codigo = $subsistemadatos['pde_codigo'];

                                        if($pde_codigo == 1){
                                            $referencia_subsistema = $sub_referencia;
                                        }
                                        else{
                                            $referencia_subsistema = $sub_referencia.$sub_ref;
                                        }

                                
                                ?>
                                <div class="card-header collapsed acoSubsistema" data-codigosubsistema="<?php echo $sub_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $sub_codigo; ?>" >
                                    <a class="card-title">
                                        <strong><?php echo $referencia_subsistema; ?> - <?php echo $sub_nombre; ?> </strong>
                                    </a>
                                </div>
                                <div id="collapse<?php echo $sub_codigo; ?>" class="card-body collapse reportesubsistema<?php echo $sub_codigo; ?>" data-parent="#accordion" >
                                    <p>
                                        Cargando...
                                    </p>
                                </div>


                                <?php
                                    }
                                }
                                ?>

                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- inicio contenido acordion -->
                    <!-- ********************************  FIN ACORDEON  ************************************** -->

                    <script type="text/javascript">  
                        function excelReporte(plan_desarrollo){
                            var plan_desarrollo = plan_desarrollo;
                            var vigencia = $('#selVigencia').val();

                            //alert("vigencias: "+vigencia+" Plan Desarrollo: "+plan_desarrollo);
                            window.location.href = 'excelreportecertificado?plan_desarrollo='+plan_desarrollo+'&vigencia='+vigencia;	
                        }
                    
                        $(".acoSubsistema").click(function(){
                            var codigosubsistema = $(this).data("codigosubsistema");
                            //alert("The paragraph was clicked."+codigosubsistema);

                            $.ajax({
                                    url:"datareportesubsistema",
                                    type:"POST",
                                    data:"codigo_subsistema="+codigosubsistema,
                                    async:true,

                                    success: function(message){
                                        $(".reportesubsistema"+codigosubsistema).empty().append(message);
                                    }
                                });


                        });

                    </script>

                        
                 
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

