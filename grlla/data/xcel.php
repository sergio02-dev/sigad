<?php 
$year=$_REQUEST['year'];
$trimestre=$_REQUEST['trimestre'];
$anioTrimestre=$_REQUEST['anioTrimestre'];


?>

<span class="glyphicon glyphicon-search"><a class="btn btn-danger btn-sm" href="excelreportesubsistema?codigo_subsistema=<?php echo $codigo_subsistema ?>&year=<?php echo $year; ?>&trimestre=<?php echo $trimestre ?>&anioTrimestre=<?php echo $anioTrimestre; ?>"><i class="fas fa-file-excel"></i>&nbsp;Excel</a></span>