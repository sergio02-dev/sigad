<?php
$codigo_subsistema=$_REQUEST['codigo_subsistema'];

include('crud/rs/rprteSbstma.php');

$personaSistema = $_SESSION['idusuario'];  
//echo "----> ".$personaSistema;
if(($personaSistema==201604281729001)||($personaSistema==1)){
              
?>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="selAnio" class="font-weight-bold">Seleccione Año</label>
            <select name="selyear" id="selyear" class="form-control caja_texto_sizer" data-rule-required="true" required>
                <option value="0">Seleccione</option>
                <?php
                $apertura=$objRsrprteSbstma->listadoAperturaReporte();

                if($apertura){
                    foreach($apertura as $data_apertura){
                        $apr_trimestres=$data_apertura['apr_trimestres'];
                        $apr_trim=$data_apertura['apr_trim'];

                    echo "<option value=".$apr_trimestres."> ".$apr_trimestres."</option>";
                    }

                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <br>
        <span class="glyphicon glyphicon-search"><a class="btn btn-danger btn-sm" onclick="generarExcel();"><i class="fas fa-file-excel"></i>&nbsp;Excel</a></span>
        <input type="hidden" value="<?php echo $codigo_subsistema;?>" id="codigo_subsistema" >
    </div>
</div>

<br>
<?php
}
?>


<?php
    //foreach Proyectos
    $numero_proyecto=1;
    foreach($rsProyectoSubsistema as $data_ProyectoSubsistema){
        $pro_codigo=$data_ProyectoSubsistema['pro_codigo'];
        $pro_descripcion=$data_ProyectoSubsistema['pro_descripcion'];
        $pro_referencia=$data_ProyectoSubsistema['pro_referencia'];

        $cantidad_actividades_proyecto=$objRsrprteSbstma->cantidadActividadesProyecto($pro_codigo);
    ?>
    <div class="row">
     <div class="col-sm-12">
         <div class="row" style="border: 1px solid #CCC; background: #8f141b; margin-top: 2px; color:#fff; ">
            <div class='col-sm-2'>Proyecto</div>
            <div class='col-sm-10'>
                <div class="row">
                    <div class='col-sm-2'>Accion</div>
                    <div class='col-sm-1' title="Linea de Base">L.B</div>
                    <div class='col-sm-1' title="Meta de Resultado">M.R</div>
                    <div class='col-sm-8'>
                        <div class="row">
                            <div class="col-sm-6">Actividad</div>
                            <div class="col-sm-2">Certificado</div>
                            <div class="col-sm-2">Valor</div>
                            <div class="col-sm-1">L%</div>
                            <div class="col-sm-1">LT</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-sm-2' style="border: 1px solid #CCC;"><?php echo $pro_referencia." ".$pro_descripcion; ?></div>
            <div class='col-sm-10' style="border: 1px solid #CCC;">
                <?php
                    $rsAccionProyecto=$objRsrprteSbstma->sqlRsAccioProyecto($pro_codigo);


                    if($rsAccionProyecto){
                        //Foreach Acciones
                        $numero_accion=1;
                        foreach($rsAccionProyecto as $data_accion){
                            $acc_codigo=$data_accion['acc_codigo'];
                            $acc_referencia=$data_accion['acc_referencia'];
                            $acc_descripcion=$data_accion['acc_descripcion'];
                            $acc_lineabase=$data_accion['acc_lineabase'];
                            $acc_metaresultado=$data_accion['acc_metaresultado'];
                            $acc_indicador=$data_accion['acc_indicador'];

                           // $cantidada_actividades_accion=$objRsrprteSbstma->cantidadActividadesAccion($pro_codigo, $acc_codigo);
                            $cantidada_actividades_accion=$objRsrprteSbstma->cantidadActividadAccionExcel($pro_codigo, $acc_codigo);
                ?>
                <div class="row">
                    <div class='col-sm-2' style="border: 1px solid #CCC;"><?php echo $acc_referencia." ".$acc_descripcion;/* echo $cantidada_actividades_accion; */?></div>
                    <div class='col-sm-1' style="border: 1px solid #CCC;"><?php echo $lineaBase=$objRsrprteSbstma->LineaBase($acc_codigo); ?></div>
                    <div class='col-sm-1' style="border: 1px solid #CCC;"><?php echo $metaResultado=$objRsrprteSbstma->MetaResultado($acc_codigo);  ?></div>
                    <div class='col-sm-8' style="border: 1px solid #CCC;">
                        <!--Inicio Actividades-->
                        <?php

                            $sqlRsAtividad=$objRsrprteSbstma->sqlRsAtividad($pro_codigo, $acc_codigo);
                            if($sqlRsAtividad){
                                $numero_actividad=1;
                                foreach($sqlRsAtividad as $data_RsAtividad){
                                    $act_codigo=$data_RsAtividad['act_codigo'];
                                    $act_referencia=$data_RsAtividad['act_referencia'];
                                    $act_descripcion=$data_RsAtividad['act_descripcion'];
                                    $act_certificado=$data_RsAtividad['act_certificado'];

                                // echo "<p style='color: green;'>Actividad  Proyecto Accion: ".$numero_actividad."</p> ".$act_referencia." ".$act_descripcion;
                        ?>
                        <div class="row">
                            <div class='col-sm-6'  style="border: 1px solid #CCC;"><?php echo $act_referencia." ".$act_descripcion; ?></div>
                            <div class='col-sm-2'  style="border: 1px solid #CCC;"><?php echo $act_certificado; ?></div>
                            <div class='col-sm-2'  style="border: 1px solid #CCC;">
                                <?php

                                    $valor_actividad=$objRsrprteSbstma->sqlRsValorActividad($act_codigo);
                                //echo "--->".$valor_actividad;
                                    echo "$".number_format($valor_actividad,0,',','.');
                                 ?>

                            </div>
                            <div class='col-sm-1'  style="border: 1px solid #CCC;">
                                <?php
                                    $sqlRsCantidadActividadRealizadaPorcentaje=$objRsrprteSbstma->sqlRsCantidadActividadRealizadaPorcentaje($act_codigo);
                                    if($sqlRsCantidadActividadRealizadaPorcentaje>0){
                                        $sqlLogroAvanzadoPorcentaje=$objRsrprteSbstma->sqlLogroAvanzadoPorcentaje($act_codigo);
                                        $logroporcentaje=$sqlLogroAvanzadoPorcentaje/$sqlRsCantidadActividadRealizadaPorcentaje;

                                        echo number_format($logroporcentaje,2,',','');
                                    }
                                    else{
                                        echo "0";
                                    }
                                ?>
                            </div>
                            <div class='col-sm-1'  style="border: 1px solid #CCC;">
                                <?php
                                    $sqlLogroAvanzadoTotal=$objRsrprteSbstma->sqlLogroAvanzadoTotal($act_codigo);
                                    if($sqlLogroAvanzadoTotal){
                                        echo $sqlLogroAvanzadoTotal;
                                    }
                                    else{
                                        echo "0";
                                    }

                                ?>
                            </div>
                        </div>
                        <?php


                                    $numero_actividad++;
                                }
                            }
                            else{
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">No hay actividades</div>
                                </div>
                                <?php

                            }

                        ?>
                    </div>
                </div>
                <?php
                            //foreach Actividad

                            $numero_actividad=0;
                            $numero_accion++;
                        }
                    }
                    else{

                    }
                ?>

            </div>
<?php
    $numero_proyecto++;
    $numero_accion=0;
?>
    </div>
  </div>
</div>
<div class='row'>
    <div class='col-sm-12'>
        &nbsp;
    </div>
</div>
<div class='row' >
    <div class='col-sm-12'>
        <table border="1" style=" border: 1px solid #CCC" >
            <tr style="background: #8f141b; color: #fff;">
                <th colspan="3" >Resultado</th>
                <th>Logro %</th>
                <th> Logro Total</th>
            </tr>
           <?php
                $accion_proyecto=$objRsrprteSbstma->sqlRsAccioProyecto($pro_codigo);
                if($accion_proyecto){
                    foreach($accion_proyecto as $data_accion){
                        $acc_codigo=$data_accion['acc_codigo'];
                        $acc_indicador=$data_accion['acc_indicador'];
            ?>
                <tr>
                    <td colspan="3"><?php echo $acc_indicador; ?></td>
                    <td>
                        <?php

                         $sqlRsCantidadPorcentaje=$objRsrprteSbstma->sqlRsCantidadPorcentaje($acc_codigo);
                         if($sqlRsCantidadPorcentaje>0){
                            $sqlPorcentaje=$objRsrprteSbstma->sqlPorcentaje($acc_codigo);

                            $porcentaje_final=$sqlPorcentaje/$sqlRsCantidadPorcentaje;
                            echo number_format($porcentaje_final, 2,',','.');
                         }
                         else{
                            echo "0";
                         }

                        ?>
                    </td>
                    <td>
                        <?php
                          $sqlTotal=$objRsrprteSbstma->sqlTotal($acc_codigo);
                          if($sqlTotal){
                              echo number_format($sqlTotal, 2,',','.');
                          }
                          else{
                              echo "0";
                          }
                        ?>
                    </td>
                </tr>
            <?php
                    }
                }
           ?>

        </table>
    </div>
</div>
<div class='row'>
    <div class='col-sm-12'>
        &nbsp;
    </div>
</div>
<?php
    }
?>



<script type="text/javascript">

function generarExcel(){
    var codigo_subsistema=$('#codigo_subsistema').val();
    var anio=$('#selyear').val();
    // alert(anio);
    

    if(anio>0){
        
            window.location.href = 'excelreportesubsistema?codigo_subsistema='+codigo_subsistema+'&year='+anio;
        
        // document.frm_minuto.action='excelsigadusco/rprteSbsstma.php?codigo_subsistema='+codigo_subsistema+'&year='+anio+'&trimestre='+trimestre;
        /* document.frm_minuto.action='excelreportesubsistema?codigo_subsistema='+codigo_subsistema+'&year='+anio+'&trimestre='+trimestre;
        document.frm_minuto.enctype='multipart/form-data';
        document.frm_minuto.method='POST';
        document.frm_minuto.submit();*/
        
    }
}

 
</script>
