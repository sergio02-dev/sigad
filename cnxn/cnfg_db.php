<?php

/* Clase encargada de gestionar las conexiones a la base de datos */
class Dtbs{

	private $servidor;
	private $usuario;
	private $password;
	private $base_datos;
	private $link_cnxn;
	private $consulta;
	private $array;
	private $total_consultas;

   static $_instance;

   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
   private function __construct(){
      $this->setConexion();
      $this->conectar();
   }

   /*Método para establecer los parámetros de la conexión*/
   private function setConexion(){
      $conf = Conf::getInstance();
      $this->servidor=$conf->getHostDB();
      $this->base_datos=$conf->getDB();
      $this->usuario=$conf->getUserDB();
      $this->password=$conf->getPassDB();
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
   private function conectar(){
      $this->link_cnxn=pg_connect("host=".$this->servidor." port=5432 password=".$this->password." user=".$this->usuario." dbname=".$this->base_datos." ");
		if(!$this->link_cnxn){
					echo "No se puede establecer la conexión con Base de datos";
		}
   }


   public function ejecutar($consulta){
      $this->total_consultas++;
      $resultado = pg_query($this->link_cnxn,$consulta);
      return $resultado;
   }

   public function obtener_filas($consulta){
      return pg_fetch_array($consulta);
   }

   public function numero_filas($consulta){
      return pg_num_rows($consulta);
   }

   public function getTotalConsultas(){
      return $this->total_consultas;
   }

}

?>
