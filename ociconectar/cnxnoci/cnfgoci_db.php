<?php

/* Clase encargada de gestionar las conexiones a la base de datos */
class Dtbsoci{

	private $servidoroci;
	private $usuariooci;
	private $passwordoci;
	private $base_datosoci;
	private $link_cnxnoci;
	private $consultaoci;
	private $arrayoci;
	private $total_consultasoci;

   static $_instance;

   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
   private function __construct(){
      $this->setConexionoci();
      $this->conectaroci();
   }

   /*Método para establecer los parámetros de la conexión*/
   private function setConexionoci(){
      $confoci = Confoci::getInstance();
      $this->servidoroci=$confoci->getHostDBoci();
      $this->base_datosoci=$confoci->getDBoci();
      $this->usuariooci=$confoci->getUserDBoci();
      $this->passwordoci=$confoci->getPassDBoci();
   }

   /*Evitamos el clonaje del objeto. Patrón Singleton*/
   private function __clone(){ }

   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
         return self::$_instance;
   }

   /*Realiza la conexión a la base de datos. */
   private function conectaroci(){
//      $this->link_cnxnoci=pg_connect("host=".$this->servidor." port=5432 password=".$this->password." user=".$this->usuario." dbname=".$this->base_datos." ");
      $this->link_cnxnoci=oci_connect($this->usuariooci, $this->passwordoci, $this->base_datosoci);
		if(!$this->link_cnxnoci){
					echo "No se puede establecer la conexión con Base de datos";
		}
   }


	public function ejecutaroci($consultaoci){
		$this->total_consultasoci++;
		$resultadooci = oci_parse($this->link_cnxnoci,$consultaoci);
		//$stid = oci_parse($conn, $sql);
		oci_execute($resultadooci);
		return $resultadooci;
	}

	public function ejecutaroci_nomcam($consultaoci){
		$this->total_consultasoci++;
		$resultadooci = oci_parse($this->link_cnxnoci,$consultaoci);
		//$stid = oci_parse($conn, $sql);
		oci_execute($resultadooci, OCI_DESCRIBE_ONLY);
		return $resultadooci;
	}

	public function obtener_filasoci($consultaoci){
		return oci_fetch_array($consultaoci);
	}

	public function numero_filasoci($consultaoci){
		return pg_num_rows($consultaoci);
	}

	public function getTotalConsultasoci(){
		return $this->total_consultasoci;
	}

	public function numeroCampos($consultaoci){
		return oci_num_fields($consultaoci);
	}

}

?>
