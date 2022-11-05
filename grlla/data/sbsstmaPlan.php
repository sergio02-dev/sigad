<?php 
    $planDesarrollo=$_REQUEST['planDesarrollo'];
    include('sbsstma.php');

    $dataSubsistemaPlan=$subsistema->selectSubsistemaPlan();

?>
<!-- ********************************** INICIO ACORDEON  ******************************* -->
<!-- inicio contenido acordion -->
    <div class="container">
        <div id="accordion" class="accordion">
            <div class="card mb-0">

                <?php
                if($dataSubsistemaPlan){
                    foreach ($dataSubsistemaPlan as $subsistemadatos) {

                        $sub_codigo=$subsistemadatos['sub_codigo'];
                        $sub_nombre=$subsistemadatos['sub_nombre'];
                        $subreferencia=$subsistemadatos['sub_referencia'];
                        $sub_ref=$subsistemadatos['sub_ref'];
                
                        $sub_referencia=$subreferencia.$sub_ref;
                
                ?>
                <div class="card-header collapsed acoSubsistema" data-codigo_plan="<?php echo $planDesarrollo; ?>" data-codigosubsistema="<?php echo $sub_codigo; ?>" data-toggle="collapse" href="#collapse<?php echo $sub_codigo; ?>" >
                    <a class="card-title">
                        <strong><?php echo $sub_referencia; ?> . <?php echo $sub_nombre; ?></strong>
                    </a>
                </div>
                <div id="collapse<?php echo $sub_codigo; ?>" class="card-body collapse acccionsubsistema<?php echo $sub_codigo; ?>" data-parent="#accordion" >
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
<script>
    /*function grid_accion(){
        //var codigoSubsistema= 
    }*/
  
  
    $(".acoSubsistema").click(function(){
        var codigosubsistema = $(this).data("codigosubsistema");
        var codigo_plan = $(this).data("codigo_plan");
        //alert(codigo_plan);
        //alert("The paragraph was clicked."+codigosubsistema);

        $.ajax({
				url:"proyectodatos",
				type:"POST",
				data:"codigo_subsistema="+codigosubsistema+'&codigo_plan='+codigo_plan,
				async:true,

				success: function(message){
					$(".acccionsubsistema"+codigosubsistema).empty().append(message);
				}
			});


    });

</script>