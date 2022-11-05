<?php 
    $planDesarrollo=$_REQUEST['planDesarrollo'];
    include('sbsstma.php');

    $dataSubsistemaPlan= $subsistema->selectSubsistemaPlan();

?>
<div class="row">
    <?php
        $personaSistema = $_SESSION['idusuario'];  
        
        if(($personaSistema==201604281729001)||($personaSistema==1)){
    ?>
        <div class="col-sm-2">
            <div class="form-group">
                <select name="selVigencia" id="selVigencia" class="form-control" data-rule-required="true" required>
                    <option value="">Todas las Vigencias</option>
                    <?php
                        $vigencias_certificado = $subsistema->vigencias_certificado();
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
            <span class="glyphicon glyphicon-search"><button class="btn btn-danger btn-sm" onclick="excelReporte('<?php echo $planDesarrollo; ?>')"><i class="fas fa-file-excel"></i>&nbsp;Excel Certificados</a></span>
        </div>
        
        
    <?php
        }
    ?>
</div>
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