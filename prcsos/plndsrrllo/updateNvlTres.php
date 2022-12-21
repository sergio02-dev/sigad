<?php
include('classNvlTres.php');
class UpdateNvlTres extends NivelTres{

    private $update_nivelTres;
    private $update_PlanComprasAccion;
    private $insert_PlanComprasAccion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function referenciaNivel(){

        $sqlreferenciaNivel="SELECT pro_numero ,pro_referencia
                                FROM plandesarrollo.proyecto
                                WHERE pro_codigo=".$this->getCodigoNivelDos().";";

        $queryreferenciaNivel=$this->cnxion->ejecutar($sqlreferenciaNivel);

        $data_referenciaNivel=$this->cnxion->obtener_filas($queryreferenciaNivel);

        $pro_referencia=$data_referenciaNivel['pro_referencia'];

        $pro_numero=$data_referenciaNivel['pro_numero'];

        $ref=$pro_referencia.".".$pro_numero;

        return $ref;
    }

    public function updateNivelTres(){

        $referenciaFinal=$this->referenciaNivel();

        $update_nivelTres="UPDATE plandesarrollo.accion
                                SET acc_referencia='".$referenciaFinal."', acc_descripcion='".$this->getDescripcion()."', 
                                    acc_proyecto=".$this->getCodigoNivelDos().",
                                    acc_fechamodifico=NOW(), acc_personamodifico=".$this->getPersonaSistema().",
                                    acc_responsable=".$this->getResponsable()."
                            WHERE acc_codigo=".$this->getCodigo().";";
     

        $this->cnxion->ejecutar($update_nivelTres);

        
        $update_PlanComprasAccion="UPDATE plandesarrollo.plan_compras_accion
                                      SET pca_estado = 0, 
                                          pca_fechamodifico=NOW(), 
                                          pca_personamodifico=".$this->getPersonaSistema()."
                                    WHERE pca_accion=".$this->getCodigo().";";
        
        $this->cnxion->ejecutar($update_PlanComprasAccion);

        if($this->getPlanCompras() == 1){
            $codigoPlandeComprasAccion=date('YmHis').rand(99,99999);
            $insert_PlanComprasAccion = "INSERT INTO plandesarrollo.plan_compras_accion(
                                                    pca_codigo,
                                                    pca_accion, 
                                                    pca_plantafisica, 
                                                    pca_estado, 
                                                    pca_fechamodifico, 
                                                    pca_personamodifico)
                                            VALUES (".$codigoPlandeComprasAccion.",
                                                    ".$this->getCodigo().", 
                                                    1, 
                                                    1, 
                                                    NOW(), 
                                                    ".$this->getPersonaSistema().");";
        
           $this->cnxion->ejecutar($insert_PlanComprasAccion);                                         
        }
        else{

        }

        return $update_nivelTres;
    }

   
}
?>
