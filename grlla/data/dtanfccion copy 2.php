<?php

    $accion_code = $_REQUEST['codigo_accion'];

    //echo $accion_code;
?>
<!-- **********************          Inicio Modal Forma    *********************************** -->
<!-- Large modal -->
<div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			Cargando...
		</div>
	</div>
</div>
<!-- **********************          Fin Modal Forma       *********************************** -->
<!-- **********************          Inicio Modal Forma    *********************************** -->
<!-- Large modal -->
<div class="modal fade" tabindex="-1" id="frmModalEliminar" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			Cargando...
		</div>
	</div>
</div>
<!-- **********************          Fin Modal Forma       *********************************** -->
<div id="tabla_poai<?php echo $accion_code; ?>">
<?php

  include('grlla/data/rcgrPoai.php');
 ?>
</div>
