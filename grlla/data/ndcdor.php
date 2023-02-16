<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    $codigo_planDesarrollo = $_REQUEST['codigo_planDesarrollo'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $visibilidad = $_SESSION['visibilidadBotones']; 

    include('crud/rs/plnDsrrllo.php');

   
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);
    $nombreNvelTres=$objRsPlanDesarrollo->nivelTresNombre();

    $datosPlanDesarrollo=$objRsPlanDesarrollo->datosPlan();

    foreach($datosPlanDesarrollo as $data_datosPlan){
        $pde_codigo=$data_datosPlan['pde_codigo'];
        $pde_yearinicio=$data_datosPlan['pde_yearinicio'];
        $pde_yearfin=$data_datosPlan['pde_yearfin'];
    }

    $codigo_nivel = $codigo_accion;
    $nivel = 3;
    //echo "codigo nivel ".$codigo_nivel;

    $list_responsables = $objRsPlanDesarrollo->list_responsables($codigo_nivel, $nivel);

    $list_responsbles_gastos = $objRsPlanDesarrollo->list_responsbles_gastos($codigo_nivel, $nivel);

    $list_autorizador = $objRsPlanDesarrollo->list_autorizador($codigo_nivel, $nivel);

    $list_asignacionrecursos = $objRsPlanDesarrollo->list_asignacionrecursos($codigo_nivel, $nivel);
    //$list_ordenador = $objRsPlanDesarrollo->list_ordenador($codigo_nivel, $nivel);

?>
<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">RESPONSABLES REGISTRO  </strong> 
        <i class="fas fa-plus-circle color_icono" title="Agregar Responsable Nivel Tres" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="responsable_nivel('<?php echo $codigo_accion;?>','<?php echo $codigo_planDesarrollo; ?>')"></i>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>

<table claas="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 25%">Oficina Responsable</th>
        <th style="width: 25%">Cargo</th>
        <th style="width: 25%">Ordenador</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 5%">::</th>
    </tr>

    <?php
        if($list_responsables){
            $num = 1;
            foreach ($list_responsables as $dta_lsta_responsables) {
                $res_codigo = $dta_lsta_responsables['res_codigo'];
                $res_nivel = $dta_lsta_responsables['res_nivel'];
                $res_codigonivel = $dta_lsta_responsables['res_codigonivel'];
                $res_codigocargo = $dta_lsta_responsables['res_codigocargo'];
                $res_codigooficina = $dta_lsta_responsables['res_codigooficina'];
                $res_estado = $dta_lsta_responsables['res_estado'];
                $res_ordenador = $dta_lsta_responsables['res_ordenador'];
  

          
                if($res_estado == 1){
                    $nombre_estado = "ACTIVO";
                }

                if($res_estado == 0){
                    $nombre_estado = "INACTIVO";
                }

                $nombre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                $nombre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);
                
                $nombre_registro_ordenador = $objRsPlanDesarrollo->nombre_registro_ordenador($res_codigo);
                $codigo_registro_ordenador = $objRsPlanDesarrollo->codigo_registro_ordenador($res_codigo);
         
                
            
    ?>
    <tr>
        <td><?php echo $num; ?></td>
        <td><?php echo strtoupper(tildes($nombre_oficina)); ?></td>
        <td><?php echo strtoupper(tildes($nombre_cargo)); ?></td>
        <td><?php
    

                     echo strtoupper(tildes($nombre_registro_ordenador));
       
        ?>
        
        </td>
          
        <td><?php echo $nombre_estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_responsable('<?php echo $codigo_nivel ?>','<?php echo $nivel; ?>','<?php echo $res_codigo; ?>','<?php echo $codigo_planDesarrollo; ?>','<?php echo $codigo_registro_ordenador; ?>');"></i></div>
        </td>
    </tr>
    <?php
                $num++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="6">No hay Responsables Registrados</td>
    </tr>
    <?php
        }

    ?>
</table></br>

<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">AUTORIZA EL GASTO </strong> 
        <i class="fas fa-plus-circle color_icono" title="Autoriza el Gasto" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="responsable_nivel_autorizacion('<?php echo $codigo_accion;?>','<?php echo $codigo_planDesarrollo; ?>')"></i>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>

<table claas="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 30%">Oficina Responsable</th>
        <th style="width: 30%">Cargo</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 20%">Clasificacion</th>
        <th style="width: 5%">::</th>
    </tr>

    <?php
        if($list_autorizador){
            $num_resp = 1;
            foreach ($list_autorizador as $dta_autorizador) {
                $res_codigo = $dta_autorizador['res_codigo'];
                $res_nivel = $dta_autorizador['res_nivel'];
                $res_codigonivel = $dta_autorizador['res_codigonivel'];
                $res_codigocargo = $dta_autorizador['res_codigocargo'];
                $res_codigooficina = $dta_autorizador['res_codigooficina'];
                $res_estado = $dta_autorizador['res_estado'];
                $res_clasificacion = $dta_autorizador['res_clasificacion'];

                if($res_estado == 1){
                    $nbre_estado = "ACTIVO";
                }

                if($res_estado == 0){
                    $nbre_estado = "INACTIVO";
                }

                $nbre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                $nbre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);
                $nbre_clasificacion = $objRsPlanDesarrollo->nombre_clasificacion($res_clasificacion);
            
    ?>
    <tr>
        <td><?php echo $num_resp; ?></td>
        <td><?php echo strtoupper(tildes($nbre_oficina)); ?></td>
        <td><?php echo strtoupper(tildes($nbre_cargo)); ?></td>
        <td><?php echo $nbre_estado; ?></td>
        <td> <?php echo $nbre_clasificacion; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_autorizador_gastos('<?php echo $codigo_nivel ?>','<?php echo $nivel; ?>','<?php echo $res_codigo; ?>','<?php echo $codigo_planDesarrollo; ?>');"></i></div>
        </td>
    </tr>
    <?php
                $num_resp++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="6">No hay Responsables Registrados</td>
    </tr>
    <?php
        }

    ?>
</table></br>

<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">ORDENADOR DEL GASTO  </strong> 
        <i class="fas fa-plus-circle color_icono" title="Agregar Responsable Gastos Nivel Tres" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="responsable_nivel_gastos('<?php echo $codigo_accion;?>','<?php echo $codigo_planDesarrollo; ?>')"></i>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>

<table claas="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 50%">Oficina Responsable</th>
        <th style="width: 30%">Cargo</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 5%">::</th>
    </tr>

    <?php
        if($list_responsbles_gastos){
            $num_resp = 1;
            foreach ($list_responsbles_gastos as $dta_rsponsable_gastos) {
                $res_codigo = $dta_rsponsable_gastos['res_codigo'];
                $res_nivel = $dta_rsponsable_gastos['res_nivel'];
                $res_codigonivel = $dta_rsponsable_gastos['res_codigonivel'];
                $res_codigocargo = $dta_rsponsable_gastos['res_codigocargo'];
                $res_codigooficina = $dta_rsponsable_gastos['res_codigooficina'];
                $res_estado = $dta_rsponsable_gastos['res_estado'];

                if($res_estado == 1){
                    $nbre_estado = "ACTIVO";
                }

                if($res_estado == 0){
                    $nbre_estado = "INACTIVO";
                }

                $nbre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                $nbre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);
            
    ?>
    <tr>
        <td><?php echo $num_resp; ?></td>
        <td><?php echo strtoupper(tildes($nbre_oficina)); ?></td>
        <td><?php echo strtoupper(tildes($nbre_cargo)); ?></td>
        <td><?php echo $nbre_estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_responsable_gastos('<?php echo $codigo_nivel ?>','<?php echo $nivel; ?>','<?php echo $res_codigo; ?>','<?php echo $codigo_planDesarrollo; ?>');"></i></div>
        </td>
    </tr>
    <?php
                $num_resp++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="5">No hay Responsables Registrados</td>
    </tr>
    <?php
        }

    ?>
</table></br>


<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">RESPONSABLE ASIGNACION DE RECURSOS  </strong> 
        <i class="fas fa-plus-circle color_icono" title="Agregar Responsable Gastos Nivel Tres" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="responsable_asignacionrecursos('<?php echo $codigo_accion;?>','<?php echo $codigo_planDesarrollo; ?>')"></i>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>

<table claas="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 50%">Oficina Responsable</th>
        <th style="width: 30%">Cargo</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 5%">::</th>
    </tr>

    <?php
        if($list_asignacionrecursos){
            $num_resp = 1;
            foreach ($list_asignacionrecursos as $dta_asignacionrescursos) {
                $res_codigo = $dta_asignacionrescursos['res_codigo'];
                $res_nivel = $dta_asignacionrescursos['res_nivel'];
                $res_codigonivel = $dta_asignacionrescursos['res_codigonivel'];
                $res_codigocargo = $dta_asignacionrescursos['res_codigocargo'];
                $res_codigooficina = $dta_asignacionrescursos['res_codigooficina'];
                $res_estado = $dta_asignacionrescursos['res_estado'];

                if($res_estado == 1){
                    $nbre_estado = "ACTIVO";
                }

                if($res_estado == 0){
                    $nbre_estado = "INACTIVO";
                }

                $nbre_oficina = $objRsPlanDesarrollo->nombre_oficina($res_codigooficina);

                $nbre_cargo = $objRsPlanDesarrollo->nombre_cargo($res_codigocargo);
            
    ?>
    <tr>
        <td><?php echo $num_resp; ?></td>
        <td><?php echo strtoupper(tildes($nbre_oficina)); ?></td>
        <td><?php echo strtoupper(tildes($nbre_cargo)); ?></td>
        <td><?php echo $nbre_estado; ?></td>
        <td>
            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="editar_asignacionrecursos('<?php echo $codigo_nivel ?>','<?php echo $nivel; ?>','<?php echo $res_codigo; ?>','<?php echo $codigo_planDesarrollo; ?>');"></i></div>
        </td>
    </tr>
    <?php
                $num_resp++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="5">No hay Responsables Registrados</td>
    </tr>
    <?php
        }

    ?>
</table></br>


<p>
    <div style="float: left; margin-bottom: 1px;">
        <strong style="color: #930606db;">INDICADORES</strong>
        <div class="d-inline-block"> <i class="fas fa-plus-circle color_icono" title="Agregar Indicador" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="aggIndicador('<?php echo $codigo_accion;?>','<?php echo $codigo_planDesarrollo; ?>');"></i></div>
    </div>
    <hr style="float: left; border: 1px solid #930606db; margin: 10px 0; width: 100%">
</p>
<?php
   $rs_indicador=$objRsPlanDesarrollo->indicadorLista($codigo_accion);

   $num_registro=1;
   if($rs_indicador){

        foreach ($rs_indicador as $data_indicadorLista) {
            $ind_codigo = $data_indicadorLista['ind_codigo'];
            $ind_unidadmedida = $data_indicadorLista['ind_unidadmedida'];
            $ind_lineabase = $data_indicadorLista['ind_lineabase'];
            $ind_metaresultado = $data_indicadorLista['ind_metaresultado'];
            $ind_tipocomportamiento = $data_indicadorLista['ind_tipocomportamiento'];
            $ind_tendencia = $data_indicadorLista['ind_tendencia'];
            $ind_accion = $data_indicadorLista['ind_accion'];
            $ind_sede = $data_indicadorLista['ind_sede'];

            $nombre_sede = $objRsPlanDesarrollo->nombre_sede($ind_sede);
?>

<table class="table table-sm table-striped table-bordered">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 25%">Inidicador</th>
        <th style="width: 13%">Sede</th>
        <th style="width: 10%">Linea Base</th>
        <th style="width: 10%">Meta Resultado</th>
        <th style="width: 17%">Comportamiento</th>
        <th style="width: 16%">Tendencia</th>
        <th rowspan="2" style="width: 4%"> 
            <div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Indicador" style="display:<?php echo $visibilidad; ?>;" onclick="editar_indicador('<?php echo $ind_accion; ?>','<?php echo $pde_codigo; ?>', '<?php echo $ind_codigo; ?>');"></i> </div>
        </th>
    </tr>
    <tr>
        <td><?php echo $num_registro; ?></td>
        <td><?php echo $ind_unidadmedida; ?></td>
        <td><?php echo $nombre_sede; ?></td>
        <td><?php echo $ind_lineabase; ?></td>
        <td><?php echo $ind_metaresultado; ?></td>
        <td><?php echo $comportamiento=$objRsPlanDesarrollo->comportamientoNivelTres($ind_tipocomportamiento); ?></td>
        <td><?php echo $tendencia=$objRsPlanDesarrollo->tendenciaNivelTres($ind_tendencia); ?></td>
    </tr>

    <tr>
        <td colspan="3">
            <table class="table table-sm table-striped table-bordered">
                <tr>
                    <th colspan="3"><center>VIGENCIAS</center></th>
                </tr>
                <tr>
                    <th style="width: 30%">VIGENCIA</th>
                    <th style="width: 20%">UNIDAD</th>
                    <th style="width: 50%">PRESUPUESTO</th>
                <?php
                    $indicadorVigencia=$objRsPlanDesarrollo->indicador_vigencia($ind_codigo);
                    //echo "----------->".$indicadorVigencia;
                    foreach($indicadorVigencia as $data_vigencia){
                        $ivi_codigo=$data_vigencia['ivi_codigo'];
                        $ivi_indicador=$data_vigencia['ivi_indicador'];
                        $ivi_vigencia=$data_vigencia['ivi_vigencia'];
                        $ivi_presupuesto=$data_vigencia['ivi_presupuesto'];
                        $ivi_valorlogrado=$data_vigencia['ivi_valorlogrado'];

                ?>
                <tr>
                    <td><?php echo $ivi_vigencia; ?></td>
                    <td><?php echo $ivi_valorlogrado; ?></td>
                    <td><?php echo "$".number_format($ivi_presupuesto,0,',','.'); ?></td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </td>
        <td colspan="5">
            <table class="table table-sm table-striped table-bordered">
                <tr>
                    <th colspan="4"><center>RESPONSABLES <i class="fas fa-user-plus fa-lg color_icono" title="Agergar Responsable" style="display:<?php echo $visibilidad; ?>; float: right;" onclick="agregar_responsabe('<?php echo $ind_codigo; ?>','<?php echo $ind_accion; ?>', '<?php echo $pde_codigo; ?>');"></i></center>              </th>
                </tr>
                <tr>
                    <th style="width: 43%">OFICINA</th>
                    <th style="width: 42%">CARGO</th>
                    <th style="width: 10%">ESTADO</th>
                    <th style="width: 5%">::</th>
                <?php
                    $responsable_indicador = $objRsPlanDesarrollo->list_responsable_indicador($ind_codigo);
                   
                    if($responsable_indicador){
                        foreach($responsable_indicador as $dta_rspnsbles_indcdor){
                            $ires_codigo = $dta_rspnsbles_indcdor['res_codigo'];
                            $ires_nivel = $dta_rspnsbles_indcdor['res_nivel'];
                            $ires_codigonivel = $dta_rspnsbles_indcdor['res_codigonivel'];
                            $ires_codigocargo = $dta_rspnsbles_indcdor['res_codigocargo'];
                            $ires_codigooficina = $dta_rspnsbles_indcdor['res_codigooficina'];
                            $ires_estado = $dta_rspnsbles_indcdor['res_estado'];

                            if($ires_estado == 1){
                                $nmbre_estdo_ind = "ACTIVO";
                            }

                            if($ires_estado == 0){
                                $nmbre_estdo_ind = "INACTIVO";
                            }

                            $nmbre_ofcna_ind = $objRsPlanDesarrollo->nombre_oficina($ires_codigooficina);

                            $nmbre_crgo_ind = $objRsPlanDesarrollo->nombre_cargo($ires_codigocargo);

                ?>
                    <tr>
                        <td><?php echo $nmbre_ofcna_ind; ?></td>
                        <td><?php echo $nmbre_crgo_ind; ?></td>
                        <td><?php echo $nmbre_estdo_ind; ?></td>
                        <td>
                            <div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Responsable" onclick="edtar_rspnsble_indcdor('<?php echo $ind_codigo; ?>','<?php echo $ind_accion; ?>', '<?php echo $pde_codigo; ?>', '<?php echo $ires_codigo; ?>');"></i></div>    
                        </td>
                    </tr>

                <?php   
                        }
                    }
                    else{
                ?>
                    <tr>
                        <td colspan="4"><center><strong>No hay Responsables Registrados</strong></center></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </td>
    </tr>
</table> </br>
<?php
            $num_registro++;
       }
    }
?>

<script>
    

    function responsable_nivel_autorizacion(codigo_nivel, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 3;
        if(nivel == 3){
            $('#frmModal').modal({
                keyboard: true
            });
            $.ajax({
                url:"formresponsable",
                type:"POST",
                data:"codigo_nivel="+codigo_nivel+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
        }else if($nivel == 2){
            $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
        }
    }

    
    function responsable_nivel_gastos(codigo_nivel, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 2;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


    function responsable_asignacionrecursos(codigo_nivel, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 4;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


    function responsable_nivel(codigo_nivel, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 1;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    
    function editar_autorizador_gastos(codigo_nivel, nivel, codigo_responsable, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_responsable = codigo_responsable;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 3;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_responsable='+codigo_responsable+'&nivel='+nivel+'&codigo_plan='+codigo_plan+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar_responsable_gastos(codigo_nivel, nivel, codigo_responsable, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_responsable = codigo_responsable;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 2;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_responsable='+codigo_responsable+'&nivel='+nivel+'&codigo_plan='+codigo_plan+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar_asignacionrecursos(codigo_nivel, nivel, codigo_responsable, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_responsable = codigo_responsable;
        var codigo_plan = codigo_plan;
        var nivel = 3;
        var tipo_responsable = 4;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_responsable='+codigo_responsable+'&nivel='+nivel+'&codigo_plan='+codigo_plan+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar_responsable(codigo_nivel, nivel, codigo_responsable, codigo_plan, codigo_registro_ordenador){
        var codigo_nivel = codigo_nivel;
        var codigo_responsable = codigo_responsable;
        var codigo_plan = codigo_plan;
        var codigo_registro_ordenador = codigo_registro_ordenador
        var nivel = 3;
        var tipo_responsable = 1;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsable",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_responsable='+codigo_responsable+'&nivel='+nivel+'&codigo_plan='+codigo_plan+'&tipo_responsable='+tipo_responsable+'&codigo_registro_ordenador='+codigo_registro_ordenador,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    
    
    function editar_indicador(codigo_NivelTres, codigo_planDesarrollo, codigoIndicador){
        var codigo_NivelTres=codigo_NivelTres;
        var codigo_planDesarrollo=codigo_planDesarrollo;
        var codigoIndicador=codigoIndicador;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formindicador",
            type:"POST",
            data:"codigo_NivelTres="+codigo_NivelTres+'&codigo_planDesarrollo='+codigo_planDesarrollo+'&codigoIndicador='+codigoIndicador,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function agregar_responsabe(codigo_nivel, codigo_accion, codigo_plan){
        var codigo_nivel = codigo_nivel;
        var codigo_accion = codigo_accion;
        var codigo_plan = codigo_plan;
        var nivel = 4;
        var tipo_responsable = 0;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsableindicador",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_accion='+codigo_accion+'&codigo_plan='+codigo_plan+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    
    function edtar_rspnsble_indcdor(codigo_nivel, codigo_accion, codigo_plan, codigo_responsable){
        var codigo_nivel = codigo_nivel;
        var codigo_accion = codigo_accion;
        var codigo_plan = codigo_plan;
        var codigo_responsable = codigo_responsable;
        var nivel = 4;
        var tipo_responsable = 0;
        
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formresponsableindicador",
            type:"POST",
            data:"codigo_nivel="+codigo_nivel+'&codigo_accion='+codigo_accion+'&codigo_plan='+codigo_plan+'&codigo_responsable='+codigo_responsable+'&nivel='+nivel+'&tipo_responsable='+tipo_responsable,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function aggIndicador(codigo_NivelTres, codigo_planDesarrollo){
        var codigo_NivelTres=codigo_NivelTres;
        var codigo_planDesarrollo=codigo_planDesarrollo;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formindicador",
            type:"POST",
            data:"codigo_NivelTres="+codigo_NivelTres+'&codigo_planDesarrollo='+codigo_planDesarrollo,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
</script>
