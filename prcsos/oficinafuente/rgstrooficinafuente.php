<?php
include_once('classOficinafuente.php');

class RgstroOficinaFuente extends OficinaFuente {

    private $sql_oficinafuente;

   

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function insertOficinafuente(){

        $fuentes = $this->getFuente();

        for ($lista_fuentes=0; $lista_fuentes < count($fuentes); $lista_fuentes++) { 
            
            $codigo_oficinafuente[$lista_fuentes] = date('YmdHis').rand(99,99999);

            $sql_oficinafuente[$lista_fuentes]="INSERT INTO usco.oficinafuente(
                                            off_codigo, 
                                            off_oficina,
                                            off_cargo, 
                                            off_fuente, 
                                            off_estado, 
                                            off_fechacreo, 
                                            off_fechamodifico, 
                                            off_personacreo, 
                                            off_personamodifico)
                                            VALUES (".$codigo_oficinafuente[$lista_fuentes].",
                                                    ".$this->getOficina().", 
                                                    ".$this->getCargo().",
                                                    ".$fuentes[$lista_fuentes].",
                                                    ".$this->getEstado().", 
                                                    NOW(),
                                                    NOW(),
                                                    ".$this->getPersonaSistema().",
                                                    ".$this->getPersonaSistema().");";

            
            $this->cnxion->ejecutar($sql_oficinafuente[$lista_fuentes]);
        }
        

      


        return $sql_oficinafuente;

    }
}

?>
