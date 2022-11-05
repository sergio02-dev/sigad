<?php
    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_subsistema=$_REQUEST['codigo_subsistema'];
    include('crud/rs/prycto.php');

?>
<div class="col-sm-12">
    <strong>Total Subsistema: <?php echo '$'.number_format($totalSubstistema,0,',','.'); ?></strong>
</div>
<br>
 <!-- ********************************** INICIO ACORDION  ******************************* -->
<div class="col-sm-12 accordion-container">
    <!-- inicio contenido acordion -->
    <div class="container">
        <div id="accordion<?php echo $codigo_subsistema; ?>_2" class="accordion">
            <div class="card mb-0">

                <?php

                    foreach ($dataProyecto as $proyectoDatos) {

                        $pro_codigo=$proyectoDatos['pro_codigo'];
                        $pro_descripcion=$proyectoDatos['pro_descripcion'];
                        $proreferencia=$proyectoDatos['pro_referencia'];
                        $pro_numero=$proyectoDatos['pro_numero'];

                        if($pro_numero==0){
                            $pro_referencia=$proreferencia;
                        }
                        else{
                            $pro_referencia=$proreferencia.'.'.$pro_numero;
                        }
                
                ?>
                <div class="card-header collapsed acoSubsistema" data-codigo_plan="<?php echo $codigo_plan; ?>" data-codigoproyecto="<?php echo $pro_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $codigo_subsistema.$pro_codigo; ?>" >
                    <a class="card-title">
                        <strong><?php echo $pro_referencia; ?> . <?php echo $pro_descripcion; ?> </strong>
                    </a>
                </div>
                <div id="collapse<?php echo $codigo_subsistema.$pro_codigo; ?>" class="card-body collapse acccionproyecto<?php echo $pro_codigo; ?>" data-parent="#accordion<?php echo $codigo_subsistema; ?>_2" >
                    <p>
                        Cargando...
                    </p>
                </div>


                <?php
                    }
                ?>

                
                
            </div>
        </div>
    </div>
    <!-- Fin contenido acordion -->
</div>

<!-- ********************************  FIN ACORDION  ************************************** -->


<script>
     
    $(".acoSubsistema").click(function(){
        var codigo_proyecto = $(this).data("codigoproyecto");
        var codigo_plan = $(this).data("codigo_plan");
		var codigo_subsistema = <?php echo  $codigo_subsistema; ?>;

        $.ajax({
				url:"dataaccionproyecto",
				type:"POST",
				data:{
						codigo_proyecto:codigo_proyecto,
						codigo_subsistema:codigo_subsistema,
                        codigo_plan:codigo_plan
					}, 
				async:true,

				success: function(message){
					$(".acccionproyecto"+codigo_proyecto).empty().append(message);
				}
			});


    });

</script>