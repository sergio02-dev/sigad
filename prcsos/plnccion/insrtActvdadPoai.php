<?php
include_once('classActvdadPoai.php');

class CtvdadPoai extends ActividadPoai{

  private $sqlInsertAcc;
  private $codigoaccion;
  private $codigoActividad;
  private $sql_unidad_indicador;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoActividad=date('YmdHis').rand(99,99999);
    }

    public function numero($codigoccion){
      $sqlnumero="SELECT MAX(acp_numero) AS numero
                         FROM planaccion.actividad_poai
                         WHERE acp_accion=$codigoccion;";
       $querynumero=$this->cnxion->ejecutar($sqlnumero);

      $data_numero=$this->cnxion->obtener_filas($querynumero);

      $numero=$data_numero['numero'];

      return $numero;
    }
    public function numeroActividades($codigoccion, $persona){
      $sqlnumeroActividad="SELECT COUNT (acp_codigo) AS numeroactividad
                         FROM planaccion.actividad_poai
                         WHERE acp_accion=$codigoccion
                          AND acp_personacreo=$persona;";

      $querynumeroActividad=$this->cnxion->ejecutar($sqlnumeroActividad);

      $data_numeroActividad=$this->cnxion->obtener_filas($querynumeroActividad);

      $numeroactividad=$data_numeroActividad['numeroactividad'];

      return $numeroactividad;
    }


    public function codigo_proyecto($codigoccion){

      $sql_codigo_proyecto="SELECT acc_codigo, acc_referencia, acc_proyecto
                              FROM plandesarrollo.accion
                             WHERE acc_codigo = $codigoccion;";

      $query_codigo_proyecto=$this->cnxion->ejecutar($sql_codigo_proyecto);

      $data_codigo_proyecto=$this->cnxion->obtener_filas($query_codigo_proyecto);

      $acc_proyecto=$data_codigo_proyecto['acc_proyecto'];

      return $acc_proyecto;
    }

    public function codigo_subsistema($codigo_proyecto){

      $sql_codigo_subsistema="SELECT pro_codigo, pro_descripcion, sub_codigo
                                  FROM plandesarrollo.proyecto
                              WHERE pro_codigo = $codigo_proyecto;";

      $query_codigo_subsistema=$this->cnxion->ejecutar($sql_codigo_subsistema);

      $data_codigo_subsistema=$this->cnxion->obtener_filas($query_codigo_subsistema);

      $sub_codigo = $data_codigo_subsistema['sub_codigo'];

      return $sub_codigo;
    }

    
    public function ofi_cargo($codigo_nivel, $nivel){

      $sql_ofi_cargo="SELECT vin_codigo, vin_persona, vin_oficina, vin_cargo, vin_estado, res_codigonivel, res_nivel
                          FROM usco.vinculacion, usco.responsable
                        WHERE res_codigocargo = vin_cargo
                        AND res_codigooficina = vin_oficina
                        AND vin_estado = 1
                        AND res_estado = 1
                        AND res_nivel = $nivel
                        AND vin_persona = ".$this->getPersonaSistema()."
                        AND res_codigonivel = $codigo_nivel;";

      $query_ofi_cargo=$this->cnxion->ejecutar($sql_ofi_cargo);

      $data_ofi_cargo=$this->cnxion->obtener_filas($query_ofi_cargo);

      $vin_oficina = $data_ofi_cargo['vin_oficina'];

      $vin_cargo = $data_ofi_cargo['vin_cargo'];

      return array($vin_oficina, $vin_cargo);
    }


    public function duenio_nivel($codigo_nivel, $nivel){

      $sql_duenio_nivel="SELECT vin_codigo, vin_persona, vin_oficina, vin_cargo, vin_estado, res_codigonivel, res_nivel
                          FROM usco.vinculacion, usco.responsable
                        WHERE res_codigocargo = vin_cargo
                        AND res_codigooficina = vin_oficina
                        AND vin_estado = 1
                        AND res_estado = 1
                        AND res_nivel = $nivel
                        AND vin_persona = ".$this->getPersonaSistema()."
                        AND res_codigonivel = $codigo_nivel;";

      $query_duenio_nivel=$this->cnxion->ejecutar($sql_duenio_nivel);

      $data_duenio_nivel=$this->cnxion->obtener_filas($query_duenio_nivel);

      $cantidad = $this->cnxion->numero_filas($query_duenio_nivel);

      return $cantidad;
    }

    public function oficina_cargo(){

      $codigo_proyecto = $this->codigo_proyecto($this->getCodigoAccion());

      $codigo_subssistema = $this->codigo_subsistema($codigo_proyecto);

      $level_uno = $this->duenio_nivel($codigo_subssistema, 1);

      if($level_uno>0){
        list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($codigo_subssistema, 1);
      }
      else{
        $level_dos = $this->duenio_nivel($codigo_proyecto, 2);
        if($level_dos>0){
          list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($codigo_proyecto, 2);
        }
        else{
          list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($this->getCodigoAccion(), 3);
        }
      }

      return array($oficina_guardar, $cargo_guardar);
    }

    public function insertRegistroActividadPoai(){
      
     

      $codigoccion=$this->getCodigoAccion();

      $numeroAccion=$this->numero($codigoccion);
      //echo "------>".$numeroAccion;
      if($numeroAccion){
        $numero_Accion=$numeroAccion+1;
      }
      else{
        $numero_Accion=1;
      }

      list($ofis, $cargs) = $this->oficina_cargo();

      if($ofis && $cargs){
        $ofis = $ofis;
        $cargs = $cargs;
      }
      else{
        $ofis = 0;
        $cargs = 0;
      }
      
      $sqlInsertAcc="INSERT INTO planaccion.actividad_poai(acp_codigo, acp_descripcion, 
                                                           acp_accion, acp_proyecto, 
                                                           acp_referencia, acp_estado, 
                                                           acp_fechacreo, acp_fechamodifico, 
                                                           acp_personacreo, acp_personamodifico, 
                                                           acp_vigencia, acp_numero, acp_subsistema,
                                                           acp_objetivo, acp_oficina, acp_cargo
                                                           )
                                                   VALUES (".$this->codigoActividad.", '".$this->getNombreActividad()."', 
                                                           ".$this->getCodigoAccion().",". $this->getCodigoProyecto().",
                                                           '".$this->getReferencia()."', '".$this->getEstado()."', 
                                                           NOW(), NOW(),".$this->getPersonaSistema().", 
                                                           ".$this->getPersonaSistema().", ".$this->getVigenciaActividad().", 
                                                           ".$numero_Accion.",".$this->getCodigoSubsistema().",
                                                           '".$this->getObjetivo()."', 
                                                           $ofis, $cargs);";

      $this->cnxion->ejecutar($sqlInsertAcc);

      $datos_indicadores = $this->getArrayIndicadores();

    if ($datos_indicadores) {
      foreach ($datos_indicadores as $dta_indicadores) {
        $codigo_indicador = $dta_indicadores['codigo_indicador'];
        $unidad_indicador = $dta_indicadores['unidad_indicador'];

        $codigo_unidad_indicador = date('YmdHis') . rand(99, 99999);

        $sql_unidad_indicador = "INSERT INTO planaccion.actividad_indicador(
                                                                                                      ain_codigo, 
                                                                                                      ain_actividad, 
                                                                                                      ain_indicador, 
                                                                                                      ain_estado, 
                                                                                                      ain_fechacreo, 
                                                                                                      ain_fechamodifico, 
                                                                                                      ain_personacre, 
                                                                                                      ain_personamodifico,
                                                                                                      ain_unidad)
                                                                                               VALUES (" . $codigo_unidad_indicador . ",
                                                                                                        " . $this->codigoActividad . ",
                                                                                                        $codigo_indicador,
                                                                                                        " . $this->getEstado() . ",
                                                                                                          NOW(), 
                                                                                                          NOW(), 
                                                                                                          " . $this->getPersonaSistema() . ",
                                                                                                          " . $this->getPersonaSistema() . ", 
                                                                                                          $unidad_indicador);";


       
        $this->cnxion->ejecutar($sql_unidad_indicador);
        echo $sql_unidad_indicador;
      }
    }

      


      return $sqlInsertAcc;

    }
}
?>
