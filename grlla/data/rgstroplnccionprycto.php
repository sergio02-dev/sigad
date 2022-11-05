<?php

    $codigo_subsistema=$_REQUEST['codigo_subsistema'];
    include('crud/rs/prycto.php');




?>
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
                                                $pro_referencia=$proyectoDatos['pro_referencia'];
                                        
                                        
                                        ?>
                                        <div class="card-header collapsed acoSubsistema" data-codigoproyecto="<?php echo $pro_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $codigo_subsistema.$pro_codigo; ?>" >
                                            <a class="card-title">
                                                <strong><?php echo $pro_referencia; ?> - <?php echo $pro_descripcion; ?></strong>
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
    /*function grid_accion(){
        //var codigoSubsistema= 
    }*/
  
  
    $(".acoSubsistema").click(function(){
        var codigo_proyecto = $(this).data("codigoproyecto");
        //alert("The paragraph was clicked."+codigosubsistema);

        $.ajax({
				url:"dataccionplanaccion",
				type:"POST",
				data:"codigo_proyecto="+codigo_proyecto,
				async:true,

				success: function(message){
					$(".acccionproyecto"+codigo_proyecto).empty().append(message);
				}
			});


    });

</script>