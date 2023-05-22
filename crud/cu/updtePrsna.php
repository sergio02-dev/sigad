<?php
/**
 * Karen Yuliana Palacio Minú
 * 11 de Enero 2020 14:06pm
 * Update Persona
 */
include('prcsos/prsna/updtePrsna.php');

$personaSistema = $_SESSION['idusuario'];

$textNombres = $_REQUEST['textNombres'];
$textPrimerApellido = $_REQUEST['textPrimerApellido'];
$textSegundoApellido = $_REQUEST['textSegundoApellido'];
$selTipoIdentificacion = $_REQUEST['selTipoIdentificacion'];
$textIdentificacion = $_REQUEST['textIdentificacion'];
$selEntidad = $_REQUEST['selEntidad'];
$selFacultad = $_REQUEST['selFacultad'];
$chkgenero = $_REQUEST['chkgenero'];
$chkestado = $_REQUEST['chkestado'];
$per_codigo = $_REQUEST['per_codigo'];
$txtEmail = $_REQUEST['txtEmail'];

$updatePersona= new UpdtePrsna();

$updatePersona->setNombrePersona($textNombres);
$updatePersona->setPrimerApellidoPersona($textPrimerApellido);
$updatePersona->setSegundoApellidoPersona($textSegundoApellido);
$updatePersona->setTipoIdentificacionPersona($selTipoIdentificacion);
$updatePersona->setIdentificacionPersona($textIdentificacion);
$updatePersona->setGeneroPersona($chkgenero);
$updatePersona->setEstadoPersona($chkestado);
$updatePersona->setPersonaSistema($personaSistema);
$updatePersona->setCodigoPersona($per_codigo);
$updatePersona->setEntidadPersona($selEntidad);
$updatePersona->setFacultadPersona($selFacultad);
$updatePersona->setCorreo($txtEmail);

echo $updatePersona->updatePersona();

?>