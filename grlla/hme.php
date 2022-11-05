<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('prncpal/hd.php'); ?>
</head>

<body>
	
	<!-- *************** Inicio de page container ************************************************ -->
	<div class="page-container" style='padding:0; margin:0;'>

		<div  class="container-fluid">
			<div class="row">
				<div class="col-sm-3">
				
				<!-- INICIO MENU -->
					<?php include('prncpal/mnu.php') ?>
				<!--..........................................FIN MENU..................................................-->
					
				</div>
				<div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo" ><h2><strong>SIGAD-USCO - Bienvenido</strong> </h2></div>
					<div class="col-9">&nbsp;</div>
					
					<p>
						Sistema de Gestión Administrativa de la Universidad Surcolombiana. Aplicación encargada de consignar el seguimiento al plan de desarrollo institucional
					</p>


					<?php 
						/*$numeroletasaumenta = 66;
						$numeroletrauno = 66;
						$numeroletrados = 64;
						$a = 1;
						while ($a <= 80) {
							if($numeroletasaumenta>90){//si es mayor a 90 
								if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
									$numeroletrauno=65;
									$numeroletrados++;
									
								}
								else{//Si no que siga aumentando
									$numeroletrauno++;
								}//cierre else
								$letra=chr($numeroletrados).''.chr($numeroletrauno);
								//echo "qui <br>";
							}//fin si primera condicion
							else{//Sino Primera condicion
								$letra=chr($numeroletasaumenta);
								$numeroletrauno++;
							}


							echo $numeroletasaumenta.") Letra ".$letra."1 <br>";


							$numeroletasaumenta++;
							//echo "Hola <br>";
							$a++;
						}*/

					?>
				</div>
			</div>
		</div>




	</div>
	<!-- *********************** fin de page container ************************************************ -->




</body>

</html>
