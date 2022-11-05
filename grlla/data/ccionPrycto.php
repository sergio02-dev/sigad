<?php

    $codigo_proyecto = $_REQUEST['codigo_proyecto'];
    $codigo_subsistema = $_REQUEST['codigo_subsistema'];
    $codigo_plan = $_REQUEST['codigo_plan'];

    //echo "Codigo Plan ".$codigo_plan;

    include('crud/rs/ccionPrycto.php');



?>
 <div class="col-sm-12">
 
        <strong>Total Proyecto: <?php echo '$'.number_format($totalProyecto,0,',','.'); ?></strong>
 </div>
<br>
 <!-- ********************************** INICIO ACORDION  ******************************* -->
    <div class="col-sm-12 accordion-container">
        <!-- inicio contenido acordion -->
            <div class="container">
                <div id="accordion<?php echo $codigo_proyecto; ?>_3" class="accordion">
                    <div class="card mb-0">

                        <?php
                            $numeroregacc=1;
                            foreach ($dataAccionProyecto as $accionDatos) {
                                
                                $acc_codigo=$accionDatos['acc_codigo'];
                                $acc_proyecto=$accionDatos['acc_proyecto'];
                                $accreferencia=$accionDatos['acc_referencia'];
                                $acc_descripcion=$accionDatos['acc_descripcion'];
                                $acc_numero=$accionDatos['acc_numero'];

                                if($acc_numero==0){
                                    $acc_referencia=$accreferencia;
                                }
                                else{
                                    $acc_referencia=$accreferencia.'.'.$acc_numero;
                                }
                        
                        
                        ?>
                        <div class="card-header collapsed acoProyecto" data-codigo_plan="<?php echo $codigo_plan; ?>" data-codigoaccion="<?php echo $acc_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $acc_proyecto.$acc_codigo.$numeroregacc; ?>" >
                            <a class="card-title">
                                <strong><?php echo $acc_referencia; ?> . <?php echo $acc_descripcion; ?> </strong>
                            </a>
                        </div>
                        <div id="collapse<?php echo $acc_proyecto.$acc_codigo.$numeroregacc; ?>" class="card-body collapse acccionactividad<?php echo $acc_codigo; ?>" data-parent="#accordion<?php echo $codigo_proyecto; ?>_3" >
                            <p>
                                Cargando...
                            </p>
                        </div>


                        <?php
                            $numeroregacc++;
                            }
                        ?>

                        
                        
                    </div>
                </div>
            </div>


            <!-- Fin contenido acordion -->
    </div>

<!-- ********************************  FIN ACORDION  ************************************** -->

<script>

    $(".acoProyecto").click(function(){
        var codigoaccion = $(this).data("codigoaccion");
		var codigo_subsistema = <?php echo $codigo_subsistema; ?>;
        var codigo_plan = $(this).data("codigo_plan");
        var url = "";

        if(codigo_plan == 1){
            url = "dataactividadxaccion";
        }
        else{
            url = "inforegistroactividadplannew";
        }
        //alert("The paragraph was clicked."+codigosubsistema);

        $.ajax({
				url: url,
				type:"POST",
				data:{
						codigo_accion:codigoaccion,
						codigo_subsistema:codigo_subsistema,
                        codigo_plan:codigo_plan,
					},
				//"codigo_accion="+codigoaccion,
				async:true,

				success: function(message){
					$(".acccionactividad"+codigoaccion).empty().append(message);
				}
			});


    });

</script>