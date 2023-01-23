<?php

// Clase de Configuracion

class Confoci{
	
   private $_userdboci;
   private $_passdboci;
   private $_hostdboci;
   private $_dboci;

   static $_instance;

   private function __construct(){
      require 'cnfgoci_cnxn.php';
      $this->_userdboci=$useroci;
      $this->_passdboci=$passwordoci;
      $this->_hostdboci=$hostoci;
      $this->_dboci=$dboci;
   }

   private function __clone(){ }

   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
      return self::$_instance;
   }

   public function getUserDBoci(){
      $varoci=$this->_userdboci;
      return $varoci;
   }

   public function getHostDBoci(){
      $varoci=$this->_hostdboci;
      return $varoci;
   }

   public function getPassDBoci(){
      $varoci=$this->_passdboci;
      return $varoci;
   }

   public function getDBoci(){
      $varoci=$this->_dboci;
      return $varoci;
   }

}

?>