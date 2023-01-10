<?php

    $accion_code = $_REQUEST['codigo_accion'];
	$personaSistema = $_SESSION['idusuario'];
    $visibilidad = $_SESSION['visibilidadBotones']; 

	include('crud/rs/nfaccion.php');

    $numeroActividad=1;
    if($rs_RegistroActividad){
        foreach ($rs_RegistroActividad as $dta_activdades) {
            $acp_codigo = $dta_activdades['acp_codigo'];
            $acp_descripcion  = $dta_activdades['acp_descripcion'];
            $acp_referencia = $dta_activdades['acp_referencia'];
            $acp_numero = $dta_activdades['acp_numero'];
            $acp_estado = $dta_activdades['acp_estado'];
            $acp_vigencia = $dta_activdades['acp_vigencia'];
            $acc_codigo = $dta_activdades['acc_codigo'];
            $acc_descripcion = $dta_activdades['acc_descripcion'];
            $acp_objetivo = $dta_activdades['acp_objetivo'];
            $acp_sedeindicador = $dta_activdades['acp_sedeindicador'];
            $acp_unidad = $dta_activdades['acp_unidad'];

            $nombre_sede = $objPlanAccion->sede_indicador($acp_sedeindicador);

            $referenciaActividad = $acp_referencia.'.'.$acp_numero;

            if($acp_estado==1){
                $estado="Activo";
            }
            else{
                $estado="Inactivo";
            }
        
?>
            <style>
                .modal-content<?php echo $acp_codigo; ?> {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid rgba(0,0,0,.2);
                    border-radius: .3rem;
                    outline: 0;
                }
                .modal-contentEtapa<?php echo $acp_codigo; ?> {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid rgba(0,0,0,.2);
                    border-radius: .3rem;
                    outline: 0;
                }
            </style>
            <!-- **********************          Inicio Modal Forma    *********************************** -->
            <div class="modal fade" tabindex="-1" id="frmModal<?php echo $acp_codigo; ?>" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content<?php echo $acp_codigo; ?>">
                        Cargando...
                    </div>
                </div>
            </div>
            <!-- **********************          Fin Modal Forma       *********************************** -->

            <!-- **********************          Inicio Modal Forma    *********************************** -->
            <div class="modal fade" tabindex="-1" id="frmModalEtapa<?php echo $acp_codigo; ?>" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-contentEtapa<?php echo $acp_codigo; ?>">
                        Cargando...
                    </div>
                </div>
            </div>
            <!-- **********************          Fin Modal Forma       *********************************** -->

            <table style="padding-left:50px;">
                <tr>
                    <th><strong>Referencia:</strong> <?php echo $referenciaActividad; ?> </th>
                    <th><strong>Vigencia:</strong> <?php echo $acp_vigencia; ?> </th>
                    <th>
                        <?php 
                            //if($personaSistema==201604281729001 || $personaSistema==1 || $personaSistema==19){
                        ?>
                            <i class="fas fa-edit" style="color: #BB0900;" title="Editar Actividad" onclick="editarActiviad('<?php echo $acp_codigo; ?>','<?php echo $acp_referencia; ?>', '<?php echo $acc_codigo; ?>');"></i>
                        <?php 
                            //}
                        ?>
                    </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Sede:</strong><br>
                        <?php echo $nombre_sede; ?>
                    </td>
                    <td>
                        <strong>Unidad: </strong><br>
                        <?php echo $acp_unidad; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>Actividad:</strong><br>
                        <?php echo $acp_descripcion; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>Objetivo:</strong><br>
                        <?php echo $acp_objetivo; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong> <div style="display: <?php echo $visibilidad; ?>">Agregar Etapa <i class="fas fa-plus-circle" style="color: #BB0900;" title="Registrar Etapa" onclick="agregarPoai('<?php echo $acp_codigo; ?>','<?php echo $referenciaActividad; ?>', '<?php echo $acc_codigo; ?>');"></i> </div></strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table id="etapaActividad<?php echo $acp_codigo; ?>">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>C&oacute;digo Etapa</th>
                                    <th>Etapa</th>
                                    <th>Costo</th>
                                    <th>Vigencia</th>
                                    <th>Peso de la Etapa %</th>
                                    <th>Avance Inicial de la Etapa %</th>
                                    <th>Codigo Presupuestal</th>
                                    <th>DANE</th>
                                    <th>Descripción Codigo Presupuestal</th>
                                    <th>::</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $numeroreg=1;
                                    $rs_RegistroAcccion=$objPlanAccion->etapasPoai($acp_codigo);
                                    if($rs_RegistroAcccion){

                                        $totalAvance=0;
                                        foreach ($rs_RegistroAcccion as $dataEtapasPoai) {

                                            $poa_codigo=$dataEtapasPoai['poa_codigo'];
                                            $poa_referencia=$dataEtapasPoai['poa_referencia'];
                                            $poa_objeto=$dataEtapasPoai['poa_objeto'];
                                            $poa_recurso=$dataEtapasPoai['poa_recurso'];
                                            $poa_logro=$dataEtapasPoai['poa_logro'];
                                            $poa_estado=$dataEtapasPoai['poa_estado'];
                                            $poa_numero=$dataEtapasPoai['poa_numero'];
                                            $poa_vigencia=$dataEtapasPoai['poa_vigencia'];
                                            $poa_logroejecutado=$dataEtapasPoai['poa_logroejecutado'];
                                            $codigo_Actividad=$dataEtapasPoai['acp_codigo'];
                                            $poa_codigoclasificadorpresupuestal = $dataEtapasPoai['poa_codigoclasificadorpresupuestal'];
                                            $poa_dane = $dataEtapasPoai['poa_dane'];
                                            $poa_plancompras = $dataEtapasPoai['poa_plancompras'];
                                            $poa_descripcionclasificador = $dataEtapasPoai['poa_descripcionclasificador'];

                                            $referenciaAccion=$poa_referencia.'.'.$poa_numero;
                      
                                            if($poa_estado==1){
                                                $estado="Activo";
                                            }
                                            else{
                                                $estado="Inactivo";
                                            }
                      
                                            $avance_esperado=($poa_logro*$poa_logroejecutado)/100;
                                ?>
                                    <style>
                                        .modal-contentEtapaEditar<?php echo $poa_codigo; ?> {
                                            position: relative;
                                            display: -ms-flexbox;
                                            display: flex;
                                            -ms-flex-direction: column;
                                            flex-direction: column;
                                            width: 120%;
                                            pointer-events: auto;
                                            background-color: #fff;
                                            background-clip: padding-box;
                                            border: 1px solid rgba(0,0,0,.2);
                                            border-radius: .3rem;
                                            outline: 0;
                                        }
                                    </style>
                                    <!-- **********************          Inicio Modal Forma    *********************************** -->
                                    <div class="modal fade" tabindex="-1" id="frmModalEtapaEditar<?php echo $poa_codigo; ?>" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-contentEtapaEditar<?php echo $poa_codigo; ?>">
                                                Cargando...
                                            </div>
                                        </div>
                                    </div>
                                    <!-- **********************          Fin Modal Forma       *********************************** -->

                                    <tr>
                                        <td><center><?php echo $numeroreg; ?></center></td>
                                        <td><?php echo $referenciaAccion; ?></td>
                                        <td><?php echo $poa_objeto; ?></td>
                                        <td>
                                            <?php
                                                if($poa_recurso > 0){
                                            ?>
                                            <i class="fas fa-balance-scale-left" style="color: #BB0900;"  title="Recursos" onclick="addAsignacion('<?php echo $poa_codigo; ?>', '<?php echo $accion_code; ?>','<?php echo $acp_sedeindicador; ?>','<?php echo $referenciaAccion; ?>');"></i>
                                            <?php 
                                                }
                                                echo  "$".number_format($poa_recurso, 0, ',', '.'); 
                                            ?>
                                        </td>
                                        <td><?php echo $poa_vigencia; ?></td>
                                        <td><?php echo $poa_logro; ?></td>
                                        <td><?php echo $poa_logroejecutado.'=>'. number_format($avance_esperado, 2, ",", ".").'%'; ?></td>
                                        <td><?php echo $poa_codigoclasificadorpresupuestal; ?></td>
                                        <td><?php echo $poa_dane; ?></td>
                                        <td><?php echo $poa_descripcionclasificador; ?></td>
                                        <td>
                                            <div style="display: <?php echo $visibilidad; ?>"><i  class="fas fa-edit" style="color: #BB0900;" title="Editar Etapa" onclick="editarEtapa('<?php echo $poa_codigo; ?>','<?php echo $poa_referencia; ?>','<?php echo $acp_codigo; ?>', '<?php echo $acc_codigo; ?>');"></i></div>
                                            <?php 
                                                if($poa_plancompras == 1){
                                            ?>
                                            <i class="fas fa-plus-circle" style="color: #BB0900;"  title="Agergar Plan Compras" onclick="addPlanCompra('<?php echo $poa_codigo; ?>', '<?php echo $accion_code; ?>');"></i>
                                            <i class="fas fa-list" style="color: #BB0900;"  title="Lista Plan Compras" onclick="listPlanCompra('<?php echo $poa_codigo; ?>', '<?php echo $acc_codigo; ?>');"></i>
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                            $numeroreg++;
                                        }
                                    }
                                    else{
                                ?>
                                    <tr>
                                        <td colspan="11"><strong>No hay etapas Registradas</strong></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php $suma=$objPlanAccion->suma($acp_codigo); ?>
                                    <th colspan="3">Total</th>
                                    <th colspan="2">  
                                        <?php
                                            if($acp_codigo){
                                                $sumaRecurso=$objPlanAccion->sumaRecursoEtapas($acp_codigo);
                                                echo "$".number_format($sumaRecurso, 0, ',', '.');
                                            }
                                        ?>
                                    </th>
                                    <th colspan="1"><?php echo $suma.'%'; ?></th>
                                    <th colspan="5">
                                        <?php
                                            $rs_avanceEsperado=$objPlanAccion->avanceEsperado($acp_codigo);


                                            if($rs_avanceEsperado){
                                                
                                            foreach ($rs_avanceEsperado as $dataAvanceEsperado) {
                                                $poa_logro=$dataAvanceEsperado['poa_logro'];
                                                $poa_logroejecutado=$dataAvanceEsperado['poa_logroejecutado'];

                                                $avance_esperadoTotal=($poa_logro*$poa_logroejecutado)/100;

                                                $totalAvance=$totalAvance+$avance_esperadoTotal;
                                            }
                                                echo number_format($totalAvance, 2, ",", ".").'%';
                                            }
                                            else{

                                            }
                                        ?>
                                    </th>
                                <tr>

                            </tfoot>
                        </table>
                    </td>
                </tr>

            </table> <br>
            <script>
                
                
            </script>
<?php 
        }
    }
    else{
        echo "<strong>No hay Actividades Registradas </strong>";
    }
?>

<script type="text/javascript">

    function editarActiviad(codigo_actividad,referenciaAccion, codigo_accion){
        var codigo_actividad = codigo_actividad;
        var referenciaAccion = referenciaAccion;
        var codigo_accion  = codigo_accion;

        $('#frmModal'+codigo_actividad).modal({
            keyboard: true
        });
        $.ajax({
            url:"formactividadpoai",
            type:"POST",
            data:"codigo_actividad="+codigo_actividad+"&referenciaAccion="+referenciaAccion+'&codigo_accion='+codigo_accion,
            async:true,

            success: function(message){
                $(".modal-content"+codigo_actividad).empty().append(message);
            }
        });
    }

    function agregarPoai(codigo_actividad, referenciaActividad, codigo_accion){
        var codigo_actividad = codigo_actividad;
        var referenciaAccion = referenciaAccion;
        var codigo_accion = codigo_accion;

        $('#frmModalEtapa'+codigo_actividad).modal({
            keyboard: true
        });
        $.ajax({
            url:"formplanaccion",
            type:"POST",
            data:"codigo_actividad="+codigo_actividad+"&referenciaActividad="+referenciaActividad+'&codigo_accion='+codigo_accion,
            async:true,

            success: function(message){
                $(".modal-contentEtapa"+codigo_actividad).empty().append(message);
            }
        });
    }

    function editarEtapa(codigo_poai, referenciaActividad, codigo_actividad, codigo_accion){
        var codigo_poai = codigo_poai;
        var referenciaAccion = referenciaAccion;
        var codigo_actividad = codigo_actividad;
        var codigo_accion= codigo_accion;

        $('#frmModalEtapaEditar'+codigo_poai).modal({
            keyboard: true
        });
        $.ajax({
            url:"formplanaccion",
            type:"POST",
            data:"codigo_poai="+codigo_poai+"&referenciaActividad="+referenciaActividad+"&codigo_actividad="+codigo_actividad+'&codigo_accion='+codigo_accion,                                            
            async:true,
            success: function(message){
                $(".modal-contentEtapaEditar"+codigo_poai).empty().append(message);
            }
        });
    }

    function addPlanCompra(codigo_poai, codigo_accion){
        var codigo_poai = codigo_poai;
        var codigo_accion= codigo_accion;

        $('#frmModalEtapaEditar'+codigo_poai).modal({
            keyboard: true
        });
        $.ajax({
            url:"formplancompras",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion,                                            
            async:true,
            success: function(message){
                $(".modal-contentEtapaEditar"+codigo_poai).empty().append(message);
            }
        });
    }

    function listPlanCompra(codigo_poai, codigo_accion){
        var codigo_poai = codigo_poai;
        var codigo_accion= codigo_accion;

        $('#frmModalEtapaEditar'+codigo_poai).modal({
            keyboard: true
        });
        $.ajax({
            url:"listplancompras",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion,                                            
            async:true,
            success: function(message){
                $(".modal-contentEtapaEditar"+codigo_poai).empty().append(message);
            }
        });
    }

    function addAsignacion(codigo_poai, codigo_accion, codigo_indicador, referencia_etapa){
        var codigo_poai = codigo_poai;
        var codigo_accion = codigo_accion;
        var codigo_indicador = codigo_indicador;
        var referencia_etapa = referencia_etapa;

        $('#frmModalEtapaEditar'+codigo_poai).modal({
            keyboard: true
        });
        $.ajax({
            url:"asignacionrecursos",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion+'&codigo_indicador='+codigo_indicador+'&referencia_etapa='+referencia_etapa,                                            
            async:true,
            success: function(message){
                $(".modal-contentEtapaEditar"+codigo_poai).empty().append(message);
            }
        });
    }

    function eliminarActividad(codigo_poai, codigo_accion, referencia){
        var codigo_poai = codigo_poai;
        var codigo_accion = codigo_accion;
        var referencia = referencia;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formeliminaractividadaccion",
            type:"POST",
            data:"codigo_poai="+codigo_poai+'&codigo_accion='+codigo_accion+'&referencia='+referencia,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function eliminarEtapa(codigo_etapa, codigo_accion, referencia){
        var codigo_etapa = codigo_etapa;
        var codigo_accion = codigo_accion;
        var referencia = referencia;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"eliminaretapa",
            type:"POST",
            data:"codigo_etapa="+codigo_etapa+'&codigo_accion='+codigo_accion+'&referencia='+referencia,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    
</script>
