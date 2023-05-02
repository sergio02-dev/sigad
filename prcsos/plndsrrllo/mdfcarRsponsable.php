<?php
include('classResponsable.php');
class MdfcarRspnsble extends Responsable{

    private $updte_responsable;
    private $codigo_responsable;
    private $codigo_registro_ordenador;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_responsable = date('YmdHis').rand(99,99999);
        $this->codigo_registro_ordenador = date('YmdHis').rand(99,99999);
    }

    public function responsable_ordenador(){

        $sql_responsable_ordenador="SELECT ror_codigo
                                      FROM usco.registro_ordenador
                                     WHERE ror_registro = ".$this->getCodigo().";";

        $query_responsable_ordenador=$this->cnxion->ejecutar($sql_responsable_ordenador);

        $data_responsable_ordenador=$this->cnxion->obtener_filas($query_responsable_ordenador);

        $ror_codigo = $data_responsable_ordenador['ror_codigo'];

        return $ror_codigo;
    }

    public function updteResponsable(){

        $updte_responsable="UPDATE usco.responsable
                               SET res_nivel = ".$this->getNivel().", 
                                   res_codigonivel = ".$this->getCodigoNivel().", 
                                   res_codigocargo = ".$this->getCargo().", 
                                   res_codigooficina = ".$this->getOficina().", 
                                   res_estado = ".$this->getEstado().", 
                                   res_fechamodifico = NOW(), 
                                   res_personamodifico = ".$this->getPersonaSistema().",
                                   res_clasificacion = ".$this->getClasificacion()."
                             WHERE res_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($updte_responsable);
        
        if($this->getTipoResponsable() == 1){
            if($this->responsable_ordenador()){
                $inser_registro_ordenador="UPDATE usco.registro_ordenador
                                            SET  ror_registro= ".$this->getCodigo().", 
                                                ror_ordenador=".$this->getOrdenador().",
                                                ror_fechamodifico= NOW(), 
                                                ror_personamodifico=".$this->getPersonaSistema()."
                                            WHERE ror_registro=".$this->getCodigo().";";
                
                echo $inser_registro_ordenador;
                $this->cnxion->ejecutar($inser_registro_ordenador);
                
            }
            else{
                $inser_registro_ordenador="INSERT INTO usco.registro_ordenador(
                                    ror_codigo, 
                                    ror_registro, 
                                    ror_ordenador,
                                    ror_fechacreo, 
                                    ror_fechamodifico, 
                                    ror_personacreo, 
                                    ror_personamodifico)
                            VALUES (".$this->codigo_registro_ordenador.", 
                                    ".$this->getCodigo().", 
                                    ".$this->getOrdenador().",
                                    NOW(), 
                                    NOW(), 
                                    ".$this->getPersonaSistema().", 
                                    ".$this->getPersonaSistema().");";
                echo $inser_registro_ordenador;
                $this->cnxion->ejecutar($inser_registro_ordenador);
             
            }
      
            

        }

        return $updte_responsable;
    }
}
?>