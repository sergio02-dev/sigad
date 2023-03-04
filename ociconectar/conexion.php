<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
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

		public function list_cldfcadores(){
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
				$datClasificadores = $rsClsfcdres;
			}
			else{
				$datClasificadores = array();
			}
			return $datClasificadores;
		}

		public function nmbre_clsfcdor($numero_clasificador){

			$sql_nmbre_clsfcdor="SELECT K_RUBRO,N_RUBRO FROM PS070MRUBRO
								  WHERE K_RUBRO = '$numero_clasificador'";

			$resulatdo_nmbre_clsfcdor=$this->cnxionoci->ejecutaroci($sql_nmbre_clsfcdor);

			$data_nmbre_clsfcdor =$this->cnxionoci->obtener_filasoci($resulatdo_nmbre_clsfcdor);

			$numero = $data_nmbre_clsfcdor['K_RUBRO'];
			$nombre = $data_nmbre_clsfcdor['N_RUBRO'];

			return array($nombre, $numero);
		}

		public function list_cdp(){

			$sql_clasificadores="SELECT K_NUMDOC, F_MOVIMI, F_CANCEL,
										N_OBJECT, K_NUMDOC_CIA, F_VIGENCIA,
										V_MONTO

								   FROM PS070MRUBRO
								  WHERE K_RUBRO LIKE '24%'";

			$resulatdo_clasificadores=$this->cnxionoci->ejecutaroci($sql_clasificadores);

			while($data_clasificadores =$this->cnxionoci->obtener_filasoci($resulatdo_clasificadores)){
				$dataclasificadores[]=$data_clasificadores;
			}
			return $dataclasificadores;
		}
		
		/*public function jsonCsfcdores(){
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
		}*/


		public function list_rp(){

			$sql_clasificadores="SELECT K_RUBRO,N_RUBRO FROM PS070MRUBRO
								  WHERE K_RUBRO LIKE '24%'";

			$resulatdo_clasificadores=$this->cnxionoci->ejecutaroci($sql_clasificadores);

			while($data_clasificadores =$this->cnxionoci->obtener_filasoci($resulatdo_clasificadores)){
				$dataclasificadores[]=$data_clasificadores;
			}
			return $dataclasificadores;
		}
		
	}

	
?>