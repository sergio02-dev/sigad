<?php
    include('crud/rs/agncion_rcrsos/agncion_rcrsos.php');

    $codigo_poai = $_REQUEST['codigo_poai'];
    $codigo_accion = $_REQUEST['codigo_accion'];   
    $codigo_indicador = $_REQUEST['codigo_indicador'];

    $datos_etapa = $objAsignacionRecursos->datos_etapa($codigo_poai);

    if($datos_etapa){
        foreach ($datos_etapa as $dta_dtos_etpa) {
            $poa_codigo = $dta_dtos_etpa['poa_codigo'];
            $poa_referencia = $dta_dtos_etpa['poa_referencia'];
            $poa_objeto = $dta_dtos_etpa['poa_objeto'];
            $poa_recurso = $dta_dtos_etpa['poa_recurso'];
            $poa_logro = $dta_dtos_etpa['poa_logro']; 
            $poa_estado = $dta_dtos_etpa['poa_estado'];
            $poa_numero = $dta_dtos_etpa['poa_numero'];
            $poa_vigencia = $dta_dtos_etpa['poa_vigencia'];
            $poa_logroejecutado = $dta_dtos_etpa['poa_logroejecutado'];
        }

        $ref = $poa_referencia.".".$poa_numero;
    }

    $recurso_etapa = $objAsignacionRecursos->recurso_etapa($codigo_poai);
?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-sm" style="font-size: 12px;">
            <tr>
                <th style="width: 30%">CODIGO</th>
                <td><?php echo $ref; ?></td>
            </tr>
            <tr>
                <th>ETAPA</th>
                <td><?php echo $poa_objeto; ?></td>
            </tr>
            <tr>
                <th>RECURSO</th>
                <td><?php echo "$".number_format($poa_recurso,0,'','.'); ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <table class="table table-striped table-bordered table-sm" style="font-size: 12px;">
            <thead>
                <tr>
                    <th colspan="5"><center>RECURSOS ASIGNADOS</center></th>
                </tr>
                <tr>
                    <th>FUENTE DE FINANCIACIÓN</th>
                    <th>VIGENCIA</th>
                    <th>RECURSO</th>
                    <th>ESTADO</th>
                    <th>::</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($recurso_etapa){
                ?>
                    <tbody>
                <?php
                    $total_asignado = 0;
                    foreach ($recurso_etapa as $dta_asgnacion) {
                        $asre_codigo = $dta_asgnacion['asre_codigo'];
                        $asre_etapa = $dta_asgnacion['asre_etapa'];
                        $asre_accion = $dta_asgnacion['asre_accion'];
                        $asre_fuente = $dta_asgnacion['asre_fuente']; 
                        $asre_indicador = $dta_asgnacion['asre_indicador'];
                        $asre_recurso = $dta_asgnacion['asre_recurso'];
                        $asre_estado = $dta_asgnacion['asre_estado'];
                        $ffi_nombre = $dta_asgnacion['ffi_nombre'];
                        $asre_vigenciarecurso = $dta_asgnacion['asre_vigenciarecurso'];
                        
                        if($asre_estado == 1){
                            $estado = "Activo";
                        }
                        
                        if($asre_estado == 0){
                            $estado = "Inactivo";
                        }

                        $total_asignado = $total_asignado + $asre_recurso;
                ?>
                    <tr>
                        <td><?php echo $ffi_nombre; ?></td>
                        <td><?php echo $asre_vigenciarecurso; ?></td>
                        <td><?php echo "$".number_format($asre_recurso,0,'','.'); ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <i class="fas fa-edit" style="color: #BB0900;"  title="Editar Etapa" onclick="modRecurso('<?php echo $codigo_poai; ?>', '<?php echo $codigo_accion; ?>', '<?php echo $codigo_indicador; ?>','<?php echo $asre_codigo;?>');"></i>

                        </td>
                    </tr>
                
                <?php
                        }
                ?>
                    </tbody>
                    <tfoot>
                        <th colspan="2">Total Asignado</th>
                        <th colspan="3"><?php echo "$".number_format($total_asignado,0,'','.'); ?></th>
                    </tfoot>
                <?php
                    }
                    else{
                ?>
                <tbody>
                    <tr>
                        <td colspan="5">No hay Recursos Asignados</td>
                    </tr>
                 <tbody>
                <?php
                    }
                ?>
            </tbody>
        </table> 
    </div>
    <div class="col-md-5">
        <i class="fas fa-plus-circle fa-lg" style="color: #BB0900;"  title="Asignar Recursos" onclick="addRecurso('<?php echo $codigo_poai; ?>', '<?php echo $codigo_accion; ?>', '<?php echo $codigo_indicador; ?>');"></i>
        <div class="row">
            <div class="col-md-12 formulario_recursos">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function addRecurso(codigo_poai, codigo_accion, codigo_indicador){
        var codigo_poai = codigo_poai;
        var codigo_accion = codigo_accion;
        var codigo_indicador = codigo_indicador;

        //alert('Aca ');
        $.ajax({
            url:"formasignacionrecursos",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion+'&codigo_indicador='+codigo_indicador,                                            
            async:true,
            success: function(message){
                $(".formulario_recursos").empty().append(message);
            }
        });
    }

    function modRecurso(codigo_poai, codigo_accion, codigo_indicador, codigo_asignacion){
        var codigo_poai = codigo_poai;
        var codigo_accion = codigo_accion;
        var codigo_indicador = codigo_indicador;
        var codigo_asignacion = codigo_asignacion;

        //alert('Aca ');
        $.ajax({
            url:"formasignacionrecursos",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion+'&codigo_indicador='+codigo_indicador+'&codigo_asignacion='+codigo_asignacion,                                            
            async:true,
            success: function(message){
                $(".formulario_recursos").empty().append(message);
            }
        });
    }
</script>