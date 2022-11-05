<?php
include('classPrtra.php');
Class Prtra extends Apertura{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function sqlAperturaReporte(){

        $sqlAperturaReporte="SELECT apr_codigo, apr_fechainicio, apr_fechafin, apr_trimestres, apr_estado
                                    FROM planaccion.apertura_reporte;";

        $queryAperturaReporte=$this->cnxion->ejecutar($sqlAperturaReporte);

        while($data_AperturaReporte=$this->cnxion->obtener_filas($queryAperturaReporte)){
            $dataAperturaReporte[]=$data_AperturaReporte;
        }
        return $dataAperturaReporte;
    }

    public function dataAperturaReporte(){
        
        $rs_aperturareporte=$this->sqlAperturaReporte();
        //return $rs_aperturareporte;
       
        foreach ($rs_aperturareporte as $data_aperturareporte) {
            
            $apr_codigo = $data_aperturareporte['apr_codigo'];
            $apr_fechainicio = date('d/m/Y',strtotime($data_aperturareporte['apr_fechainicio']));
            $apr_fechafin = date('d/m/Y',strtotime($data_aperturareporte['apr_fechafin']));
            $aprestado = $data_aperturareporte['apr_estado'];
            $apr_trimestres = $data_aperturareporte['apr_trimestres'];

            if($aprestado==1){
                $apr_estado="Activo";
            }
            else{
                $apr_estado="Inactivo";
            }

            $rsAperturaReporte[] = array('apr_codigo'=> $apr_codigo, 
                                'apr_fechainicio'=> $apr_fechainicio, 
                                'apr_fechafin'=> $apr_fechafin,
                                'apr_trimestres'=> $apr_trimestres,
                                'apr_estado'=> $apr_estado
                            );

        }

        $datPrturaRprte=json_encode(array("data"=>$rsAperturaReporte));
            
        return $datPrturaRprte;
    }

    public function updateAperturaReporte(){

        $sqlupdateAperturaReporte="SELECT apr_codigo, apr_fechainicio, apr_fechafin, apr_trimestres, apr_estado
                                    FROM planaccion.apertura_reporte
                                    WHERE apr_codigo=".$this->getCodigoApertura().";";

        $queryupdateAperturaReporte=$this->cnxion->ejecutar($sqlupdateAperturaReporte);

        while($data_updateAperturaReporte=$this->cnxion->obtener_filas($queryupdateAperturaReporte)){
            $dataupdateAperturaReporte[]=$data_updateAperturaReporte;
        }
        return $dataupdateAperturaReporte;
    }
}
?>