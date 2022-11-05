
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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>FUENTES DE FINANCIACI&Oacute;N yei</strong> </h2></div>

                    <div class="col-sm-12">&nbsp;</div>
                   
                    <!------------------------------------------- INICIO SELECT PLAN ACCIÓN ----------------------------!-->

                    <div class="row">
                        <div class="col-sm-4">
                            &nbsp;
                            <span class="d-inline-block" tabindex="0"><a style="color:#FFFFFF;" class="btn btn-danger btn-sm" onclick="generarExcelPoai('2019112216054038898', '2020');"><i class="fas fa-file-excel"></i>&nbsp;<strong>Fuentes de Financiaci&oacute;n Vigencia 2020</strong></a></span>
                        </div>
                       
                    </div>

                    <div class="col-12">
                        <?php
                            include('prcsos/plan_copia.php');


                            $rsPlanCopy = new RsCopy();

                            $cod_plan = 2019112216054038898;

                            $list_subsistemas = $rsPlanCopy->list_subsistemas($cod_plan);
                            if($list_subsistemas){
                                $new_sub = 6;
                                $new_pro = 38;
                                $new_acc = 116;
                                foreach($list_subsistemas as $dta_sub){
                                    $sub_codigos = $dta_sub['sub_codigo'];
                                    $sub_nombre = $dta_sub['sub_nombre'];
                                    $add_codigos = $dta_sub['add_codigo'];
                                    $pde_codigo = $dta_sub['pde_codigo'];
                                    $res_codigos = $dta_sub['res_codigo'];
                                    $sub_referencia = $dta_sub['sub_referencia'];
                                    $sub_ref = $dta_sub['sub_ref'];

                                    $sql_subsistema = "INSERT INTO plandesarrollo.subsistema(
                                                                   sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico, 
                                                                   sub_fechacreo, sub_fechamodifico, add_codigo, 
                                                                   pde_codigo, res_codigo, sub_referencia, sub_ref)
                                                           VALUES ($new_sub, '$sub_nombre', 1, 1,  
                                                                  NOW(), NOW(), $add_codigos, 
                                                                  2, $res_codigos, '$sub_referencia', '$sub_ref');";

                                    echo $sql_subsistema."<br>";

                                    $list_proyecto = $rsPlanCopy->list_proyecto($sub_codigos);
                                    if($list_proyecto){
                                        
                                        foreach ($list_proyecto as $dta_pro) {
                                            $pro_codigo = $dta_pro['pro_codigo'];
                                            $pro_descripcion = $dta_pro['pro_descripcion'];
                                            $sub_codigop = $dta_pro['sub_codigo'];
                                            $add_codigop = $dta_pro['add_codigo'];
                                            $res_codigop = $dta_pro['res_codigo'];
                                            $pro_referencia = $dta_pro['pro_referencia'];
                                            $pro_numero = $dta_pro['pro_numero'];
                                            $pro_objetivo = $dta_pro['pro_objetivo'];

                                            $sql_proyecto = "INSERT INTO plandesarrollo.proyecto(
                                                                         pro_codigo, pro_descripcion, sub_codigo, pro_personacreo, pro_personamodifico, 
                                                                         pro_fechacreo, pro_fechamodifico, add_codigo, res_codigo, 
                                                                         pro_referencia, pro_numero, pro_objetivo)
                                                                 VALUES ($new_pro, '$pro_descripcion', $new_sub, 1, 1, 
                                                                         NOW(), NOW(), $add_codigop, $res_codigop, 
                                                                         '$pro_referencia', $pro_numero, '$pro_objetivo');";

                                            echo $sql_proyecto."<br>";

                                            $list_accion = $rsPlanCopy->list_accion($pro_codigo);
                                            if($list_accion){
                                                
                                                foreach ($list_accion as $dta_acc){
                                                    $acc_codigo = $dta_acc['acc_codigo'];
                                                    $acc_referencia = $dta_acc['acc_referencia'];
                                                    $acc_descripcion = $dta_acc['acc_descripcion'];
                                                    $acc_responsable = $dta_acc['acc_responsable'];
                                                    $acc_lineabase = $dta_acc['acc_lineabase'];
                                                    $acc_metaresultado = $dta_acc['acc_metaresultado'];
                                                    $acc_proyecto = $dta_acc['acc_proyecto'];
                                                    $acc_actoadmin = $dta_acc['acc_actoadmin'];
                                                    $acc_numerovigencia = $dta_acc['acc_numerovigencia'];
                                                    $acc_comportamiento = $dta_acc['acc_comportamiento'];
                                                    $acc_tendenciapositiva = $dta_acc['acc_tendenciapositiva'];
                                                    $acc_indicador = $dta_acc['acc_indicador'];
                                                    $acc_numero = $dta_acc['acc_numero'];


                                                    $sql_accion = "INSERT INTO plandesarrollo.accion(
                                                                               acc_codigo, acc_referencia, acc_descripcion, 
                                                                               acc_responsable, acc_lineabase, acc_metaresultado, 
                                                                               acc_proyecto, acc_personacreo, acc_personamodifico, 
                                                                               acc_fechacreo, acc_fechamodifico, acc_actoadmin, 
                                                                               acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva, 
                                                                               acc_indicador, acc_numero)
                                                                       VALUES ($new_acc, '$acc_referencia', '$acc_descripcion', 
                                                                               $acc_responsable, $acc_lineabase, $acc_metaresultado,
                                                                               $new_pro, 1, 1, 
                                                                               NOW(), NOW(), $acc_actoadmin, 
                                                                               $acc_numerovigencia, $acc_comportamiento, $acc_tendenciapositiva, 
                                                                               '$acc_indicador', $acc_numero);";

                                                    echo $sql_accion."<br>";
                                                    
                                                    $new_acc++; 
                                                }
                                            }

                                            $new_pro++;
                                        }
                                    }
                                    echo "<br>";

                                    $new_sub++;
                                }
                            }
                        ?>

                    </div>

				</div>
			</div>
		</div>
	</div>
</body>

</html>
<script>
    function generarExcelPoai(codigo_plandesarrollo, vigencia){
        var codigo_plandesarrollo=codigo_plandesarrollo;
        var vigencia=vigencia;
        //alert("Plan "+codigo_plandesarrollo+" Vigencia "+vigencia);
        if(vigencia==0){

        }
        else{
            window.location.href = 'reporteexcelpoai?codigo_plandesarrollo='+codigo_plandesarrollo+'&vigencia='+vigencia;	
        }
            
        
    }
</script>
