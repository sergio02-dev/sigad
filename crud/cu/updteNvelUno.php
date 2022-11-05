<?php
  function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú");
    $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
  }

  include('prcsos/plndsrrllo/updteNvelUno.php');
  
  $personaSistema = $_SESSION['idusuario'];
  
  $nombreNivelUno=$_REQUEST['txtNombre'];
  $txtReferenciaUno=$_REQUEST['txtReferenciaUno'];
  $codigoNivelUno=$_REQUEST['codigoNivelUno'];
  $txtReferenciaCompleta=$_REQUEST['txtReferenciaCompleta'];
  $selResponsable=$_REQUEST['selResponsable'];
  
    //echo "--->".$txtReferenciaUnotxtReferenciaUno;
  $update_nivelUno = new UpdateNvlUno();
  
  $update_nivelUno->setNombreNivelUno(strtoupper(tildes($nombreNivelUno)));
  $update_nivelUno->setReferenciaNivelUno(strtoupper(tildes($txtReferenciaUno)));
  $update_nivelUno->setPersonaSistemaNivelUno($personaSistema);
  $update_nivelUno->setCodigoNivelUno($codigoNivelUno);
  $update_nivelUno->setRef($txtReferenciaCompleta);
  $update_nivelUno->setResponsable($selResponsable);

  echo $update_nivelUno->updateNivelUno();


?>