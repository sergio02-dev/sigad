<?php
include('crud/rs/plnDsrrllo.php');
$pde_codigo=$_REQUEST['pde_codigo'];

$visibilidad = $_SESSION['visibilidadBotones'];


$lista_planes = $objRsPlanDesarrollo->PlanDesarrolloLista();

if($pde_codigo){
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($pde_codigo);
    $nivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
    $nivelDos=$objRsPlanDesarrollo->nivelDosNombre();
    $nivelTres=$objRsPlanDesarrollo->nivelTresNombre();
}
else{
    $pde_codigo = $objRsPlanDesarrollo->ultimo_plan();
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($pde_codigo);
    $nivelUno=$objRsPlanDesarrollo->nivelUnoNombre();
    $nivelDos=$objRsPlanDesarrollo->nivelDosNombre();
    $nivelTres=$objRsPlanDesarrollo->nivelTresNombre();
}


?>
<div class="row">
    <div class="col-sm-4">
        <span class="glyphicon glyphicon-search"><a style="color:#FFFFFF;" class="btn btn-danger btn-sm" onclick="generarExcel();"><i class="fas fa-file-excel"></i>&nbsp;<strong>Excel Plan Indicativo</strong></a></span>
        <input type="hidden" value="<?php echo $pde_codigo;?>" id="codigo_plandesarrollo" >
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="selPlan">Plan de Desarrollo</label>
			<select name="selPlan" id="selPlan" class="form-control caja_texto_sizer" data-rule-required="true" required>
                <?php 
                    foreach ($lista_planes as $dta_lista_planes) {
                        $cdpde_codigo = $dta_lista_planes['pde_codigo'];
                        $cdpde_nombre = $dta_lista_planes['pde_nombre'];

                        if($cdpde_codigo == $pde_codigo){
                            $selectedPln = "selected";
                        }
                        else{
                            $selectedPln = "";
                        }
                ?>
                <option value="<?php echo $cdpde_codigo; ?>" <?php echo $selectedPln; ?> data-plan_cargar="<?php echo $cdpde_codigo; ?>"><?php echo $cdpde_nombre; ?></option>
                <?php 
                    }
                ?>
				
			
			</select>
		</div>
    </div>
    <div class="col-sm-4"></div>
</div>

<div class="row" style="border: 1px solid #CCC; background: #8f141b; margin-top: 2px; color:#fff; ">
    <div class="col-sm-1">
        No.
    </div>
    <div class="col-sm-2">
       <?php echo $nivelUno; ?>
    </div>
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-5">
                <?php echo $nivelDos; ?>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $nivelTres; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $listadoNivelUno=$objRsPlanDesarrollo->listadoNivelUno();
    if($listadoNivelUno){
        $numero_subsistema=1;
        foreach($listadoNivelUno as $data_nivelUno){
            $sub_codigo=$data_nivelUno['sub_codigo'];
            $sub_nombre=$data_nivelUno['sub_nombre'];
            $sub_referencia=$data_nivelUno['sub_referencia'];
            $sub_ref=$data_nivelUno['sub_ref'];

            if($pde_codigo == 1){
                $siglas_sub = $sub_referencia;
            }
            else{
                $siglas_sub = $sub_referencia.$sub_ref;
            }

?>
        <div class="row">
            <div class="col-sm-1" style="border: 1px solid #CCC;">
                <?php echo $numero_subsistema; ?>
            </div>
            <div class="col-sm-2" style="border: 1px solid #CCC;">
                <?php echo $sub_nombre." - ".$siglas_sub; ?>
            </div>
            <div class="col-sm-9" style="border: 1px solid #CCC;">
            <?php
                $listaNivelDos=$objRsPlanDesarrollo->nivelDos($sub_codigo);
                if($listaNivelDos){
                    foreach ($listaNivelDos as $data_nivelDos) {
                        $pro_codigo=$data_nivelDos['pro_codigo'];
                        $pro_descripcion=$data_nivelDos['pro_descripcion'];
                        $pro_referencia=$data_nivelDos['pro_referencia'];
                        $pro_numero=$data_nivelDos['pro_numero'];

                        if($pde_codigo==1){
                            $final_referencia=$sub_referencia.".".$pro_referencia;
                        }
                        else{
                            $final_referencia=$pro_referencia.".".$pro_numero;
                        }

            ?>
                    <div class="row">
                        <div class="col-sm-5" style="border: 1px solid #CCC;">
                            <?php echo $final_referencia." ".$pro_descripcion; ?>
                        </div>
                        <div class="col-sm-7" style="border: 1px solid #CCC;">
                        <?php
                            $listaNivelTres=$objRsPlanDesarrollo->accionPlanDesarrollo($pro_codigo);

                            if($listaNivelTres){
                                foreach ($listaNivelTres as $data_nivelTres) {
                                    $acc_codigo=$data_nivelTres['acc_codigo'];
                                    $acc_referencia=$data_nivelTres['acc_referencia'];
                                    $acc_descripcion=$data_nivelTres['acc_descripcion'];
                                    $acc_numero=$data_nivelTres['acc_numero'];

                                    if($pde_codigo==1){
                                        $finalRef=$sub_referencia.".".$acc_referencia;
                                    }
                                    else{
                                        $finalRef=$acc_referencia.".".$acc_numero;
                                    }

                        ?>
                            <div class="row">
                                <div class="col-sm-12" style="border: 1px solid #CCC;">
                                    <?php echo $finalRef." ".$acc_descripcion; ?>
                                </div>
                            </div>
                        <?php
                                }
                            }
                            else{

                        ?>
                        <div class="row">
                            <div class="col-sm-12" style="border: 1px solid #CCC;">
                               No Hay <?php echo $nivelTres; ?>
                            </div>
                        </div>
                        <?php
                            }

                        ?>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>
            </div>
        </div>
<?php
        $numero_subsistema++;
        }
    }

?>

<script type="text/javascript">

    function generarExcel(){
        var codigo_plandesarrollo=$('#codigo_plandesarrollo').val();
        if(codigo_plandesarrollo == 1){
            window.location.href = 'reporteplandesarrolloantiguo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        else{
            window.location.href = 'excelplandesarrollo?codigo_plandesarrollo='+codigo_plandesarrollo;
        } 
        
    }

    $('#selPlan').change(function(){
        //alert("Hola");
        var plan_desarrollo = $(this).find(':selected').data('plan_cargar');

        //alert(plan_desarrollo);
      

        $.ajax({
            url:"dtaplanindicativoplurianual",
            type:"POST",
            data:"pde_codigo="+plan_desarrollo,
            async:true,

            success: function(message){
                $("#datosListarPlanPlurianual").empty().append(message);
            }
        });

    });
</script>
