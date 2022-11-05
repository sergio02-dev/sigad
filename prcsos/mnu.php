<?php


class MenuSistema{

	private $cnxion;
	public $codigo_sistema;
	private $menuhijo;
	private $sql_menu;
	private $sql_submenu;
	private $submenu;
	private $submenuPermisos;

  public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_sistema = $codigo_sistema;
				$this->menuhijo = $menuhijo;
				$this->sql_submenu = $sql_submenu;
				$this->submenu = $submenu;
   }

   public function menusistema(){

		$sql_menu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen,
						sys_estado, sys_tipo, sys_nivel, sys_padre
				FROM principal.system
				WHERE sys_nivel=1
				AND sys_padre=0
				ORDER BY sys_codigo ASC; ";

		$query_menu=$this->cnxion->ejecutar($sql_menu);
		while ($data_menu = $this->cnxion->obtener_filas($query_menu)){
				$datamenu[] = $data_menu;
		}
		return $datamenu;
   }

	public function submenusistema($codigo_sistema){

		$sql_submenu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen,
							sys_estado, sys_tipo, sys_nivel, sys_padre
					FROM principal.system
					WHERE sys_nivel=1
					AND sys_tipo=2
					AND sys_padre=$codigo_sistema
					ORDER BY sys_orden  ASC; ";

		$query_submenu=$this->cnxion->ejecutar($sql_submenu);

		while ($data_submenu = $this->cnxion->obtener_filas($query_submenu)){
				$datasubmenu[] = $data_submenu;

		}

		$this->submenu = $datasubmenu;				
	}

	public function getSubmenu(){
		return $this->submenu;
	}

	public function menuPermisos($personaSistema){

		$sql_menuPermisos="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen,
						          sys_estado, sys_tipo, sys_nivel, sys_padre
							FROM  principal.system, principal.persona_sistema
							WHERE sys_codigo=CAST(spe_sistema AS BIGINT)
							AND sys_nivel=1
							AND sys_padre=0
							AND CAST(spe_persona AS BIGINT)=$personaSistema
							ORDER BY sys_codigo ASC; ";

		$query_menuPermisos=$this->cnxion->ejecutar($sql_menuPermisos);
		while ($data_menuPermisos = $this->cnxion->obtener_filas($query_menuPermisos)){
			$datamenuPermisos[] = $data_menuPermisos;
		}
		return $datamenuPermisos;
	}
	
	public function submenusistemaPermiso($codigo_sistema, $personaSistema){

		$sql_submenuPermisos="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen,
									 sys_estado, sys_tipo, sys_nivel, sys_padre
								FROM principal.system, principal.persona_sistema
								WHERE sys_codigo=CAST(spe_sistema AS BIGINT)
								AND sys_nivel=1
								AND sys_tipo=2
								AND sys_padre=$codigo_sistema
								AND CAST(spe_persona AS BIGINT)=$personaSistema
								ORDER BY sys_orden ASC; ";

		$query_submenuPermisos=$this->cnxion->ejecutar($sql_submenuPermisos);

		while ($data_submenuPermisos = $this->cnxion->obtener_filas($query_submenuPermisos)){
				$datasubmenuPermisos[] = $data_submenuPermisos;

		}

		$this->submenuPermisos = $datasubmenuPermisos;				
	}

    

	public function getSubmenuPermisos(){
		return $this->submenuPermisos;
	}

}


?>
