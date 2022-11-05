
<?php
    $codigo_plan = $iduno;
    $codigoPpi = $iddos;
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
                        <?php include('prncpal/mnu.php') ?>
                    </div>
                    <?php
                        $visibilidad = $_SESSION['visibilidadBotones'];
                        include('crud/rs/plnDsrrllo.php'); 
                        $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_plan);
                        $nombrePlanDesarrollo=$objRsPlanDesarrollo->nombrePlanDesarrollo();

                        $estado_ppi = $objRsPlanDesarrollo->estado_ppi($codigoPpi);

                        if($estado_ppi == 1){
                            $disposicion_datos = 'style="display: none;"';
                        }

                        if($estado_ppi == 0){
                            $disposicion_datos = 'class="d-inline-block"';
                        }
                    
                    ?>
                    <div class="col-sm-9 container-principal" >
                        <div class="col-sm-12 modal-header capa_titulo"><h2><strong>PPI PLAN DE DESARROLLO <?php echo $nombrePlanDesarrollo; ?></strong> </h2></div>
                        <div class="col-sm-12">&nbsp;</div>
                    
                        <div class="d-inline-block"><a href="plandesarrollo" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong> Regresar al Plan de Desarrollo</strong></a></div>
                        <div <?php echo $disposicion_datos; ?>><span class="d-inline-block" tabindex="0"  title="Agregar PPI"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="aggPPI('<?php echo $codigo_plan; ?>', '<?php echo $codigoPpi; ?>');"><i class="fas fa-plus"> <strong>Agregar PPI</strong></i></button></span></div>
                        <div <?php echo $disposicion_datos; ?>><span class="d-inline-block" tabindex="0"  title="Cierre PPI"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="closePPI('<?php echo $codigo_plan; ?>', '<?php echo $codigoPpi; ?>');"><i class="fas fa-times-circle"> <strong>Cierre PPI</strong></i></button></span></div>
                        <div class="d-inline-block"><span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;" class="btn btn-danger btn-sm" onclick="generarExcel('<?php echo $codigo_plan; ?>','<?php echo $codigoPpi; ?>');"><i class="fas fa-file-excel"></i>&nbsp;<strong>Excel PPI</strong></a></span></div>

                       
                        
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
                
                        <div class="col-sm-12" id="dtaPPI">
                            <?php 
                                include('grlla/data/ppi/ppi.php');
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>


        </div>
        <!-- *********************** fin de page container ************************************************ -->




    </body>
    <script>
        function generarExcel(codigo_plan, codigo_ppi){
            var codigo_plan = codigo_plan;
            var codigo_ppi = codigo_ppi;
            window.location.href = 'excelppi?'+codigo_plan+'-'+codigo_ppi;
            
        }
    </script>

</html>
