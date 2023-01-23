<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	/*
	// parameters
	$dsn = 'oci:host=172.16.1.81;port=1521;dbname=LINIX';
	$username = 'SIGAD';
	$password = 'ANDRESMORECO';
	$options = [];

	$pdo = new PDO($dsn, $username, $password, $options);
	*/
	/*
	$db = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP) (HOST = 172.16.1.81) (PORT = 1521)) )
	(CONNECT_DATA = (SERVICE_NAME=LINIX)))";
	$conn = oci_connect('SIGAD', 'ANDRESMORECO', $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	else{
		echo "conectado a Oracle";
	}
	*/
    require 'cnxnoci/cnfgoci_db.php';
    require 'cnxnoci/cnfoci_class.php';

	class ConsultaLinix{
		private $cnxionoci;
		
		public function __construct(){
            $this->cnxionoci = Dtbsoci::getInstance();
        }
		
		public function clasificadores(){

			$sql_clasificadores="SELECT K_RUBRO,N_RUBRO FROM PS070MRUBRO
								  WHERE K_RUBRO LIKE '24%'";

			$resulatdo_clasificadores=$this->cnxionoci->ejecutaroci($sql_clasificadores);

			while($data_clasificadores =$this->cnxionoci->obtener_filasoci($resulatdo_clasificadores)){
				$dataclasificadores[]=$data_clasificadores;
			}
			return $dataclasificadores;
		}
		
		public function jsonCsfcdores(){
			$list_cldfcadores = $this->clasificadores();
			if($list_cldfcadores){
				foreach ($list_cldfcadores as $dta_clsfcdores) {
					$cla_codigo = $dta_clsfcdores['K_RUBRO'];
					$cla_nombre = $dta_clsfcdores['N_RUBRO'];
					$cla_numero = $dta_clsfcdores['K_RUBRO'];
	
					$rsClsfcdres[] = array('cla_codigo'=> $cla_codigo, 
										   'cla_nombre'=> $cla_nombre, 
										   'cla_numero'=> $cla_numero
										);
	
				}
				$datClasificadores = json_encode(array("data"=>$rsClsfcdres));
			}
			else{
				$datClasificadores = json_encode(array("data"=>""));
			}
			return $datClasificadores;
		}
		
	}

	/*$objConsultaLinix = new ConsultaLinix();	
	$rs_clasificadores = $objConsultaLinix->clasificadores();
	
	$numeroItem=1;
	foreach ($rs_clasificadores as $dta_listaClasificadores) {
		$clasificador_codigo = $dta_listaClasificadores['K_RUBRO'];
		$clasificador_nombre = $dta_listaClasificadores['N_RUBRO'];
		
		echo $numeroItem.". ".$clasificador_codigo." ".$clasificador_nombre."<br>";
		$numeroItem++;
	}*/

?>