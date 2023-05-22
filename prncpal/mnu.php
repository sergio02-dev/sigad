<?php
	include('prcsos/mnu.php');
	include('crud/rs/autrzcion_tcnca/autrzcion_tcnca.php');
	include('crud/rs/autrzcion_rspnsble_accion/autrzcion_rspnsble_accion.php');
	include('crud/rs/autrzcion_fnncra/autrzcion_fnncra.php');
	include('crud/rs/autrzcion_ordndor_gsto/autrzcion_ordndor_gsto.php');

	$personaSistema = $_SESSION['idusuario'];
	$perfil = $_SESSION['perfil'];
	$menusistema=new MenuSistema();

	if($personaSistema==1 || $personaSistema==201604281729001 || $perfil==1){
		$menu_izquierdo = $menusistema->menusistema();
	}
	else{
		$menu_izquierdo = $menusistema->menuPermisos($personaSistema);
	}

?>
<div class="nav-side-menu">
	<figure class="logo"><img src="img/logoUSCOTBG.png" style=" width: 100%;"></figure>
	<div class="brand" style="color:#FFF; font-weight:bold;text-align:left; ">  <?php echo $_SESSION['nomusuario']; ?> &nbsp;&nbsp;&nbsp; <a href="salir" alt="Salir" title="Salir" style="color:#FFF; border:1px solid #FFF; padding:5px;"> <i class="fas fa-sign-out-alt"></i></a>&nbsp;</div>
		<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i> 

		<div class="menu-list">
			<ul id="menu-content" class="menu-content collapse out">

			<?php
				foreach ($menu_izquierdo as $datamenuizq){


					$codigo_sismenu=$datamenuizq['sys_codigo'];
					$nombre_sismenu=$datamenuizq['sys_nombre'];
					$url_sismenu=$datamenuizq['sys_url'];
					$sys_imagen=$datamenuizq['sys_imagen'];
					$sys_padre=$datamenuizq['sys_padre'];
					$sys_tipo=$datamenuizq['sys_tipo'];

					if($padreSystem==$codigo_sismenu){
						$showMenu="show";
					}
					else{
						$showMenu="";
					}


				//preg_match("/php/i", "PHP es el lenguaje de secuencias de comandos web preferido.")

					if(preg_match('/_NA_/i', $url_sismenu)){
						$urlsys="#";
						$idsys=$url_sismenu;
						$arrow='<span class="arrow"></span>';
					}
					else {
						$urlsys=$url_sismenu;
						$idsys=$url_sismenu;
						$arrow='';
						//$funcionurl="Javascript:contenido_mostrar('".$url_sismenu."');";
					}

					if(preg_match('/'.$url_sismenu.'/i',$urlmirar)){
						$codigos_permenusegundoreal="";
					}
					else {
						$codigos_permenusegundoreal=$codigos_permenusegundo;
					}

			?>
					<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
						<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
					</li>
			
					

					<?php
						if(preg_match('/_NA_/i', $url_sismenu)){
							echo '<ul class="sub-menu collapse '.$showMenu.'" id="'.$idsys.'">';
							if($personaSistema==1 || $personaSistema==201604281729001 || $perfil==1){
								$menusistema->submenusistema($codigo_sismenu);
								$submenu=$menusistema->getSubmenu();
							}
							else{
								$menusistema->submenusistemaPermiso($codigo_sismenu, $personaSistema);
								$submenu=$menusistema->getSubmenuPermisos();
							}

							foreach ($submenu as $data_menuizqhijo){

								$codigo_sismenuhijo=$data_menuizqhijo['sys_codigo'];
								$nombre_sismenuhijo=$data_menuizqhijo['sys_nombre'];
								$url_sismenuhijo=$data_menuizqhijo['sys_url'];
								$sys_imagenhijo=$data_menuizqhijo['sys_imagen'];

								if($url_sismenuhijo =='autorizaciontecnicasolicitud'){
									$numero_tecnicas = $objAutorizacionTecnica->numero_tecnicas();
									if($numero_tecnicas > 0){
										$not = '<i class="fas fa-bell" style="color: green"></i>';
									}
									else{
										$not = '';
									}
									
								}
								elseif($url_sismenuhijo =='autorizacionresponsableaccion'){
									$numero_res_accion = $objAutorizacionResponsableAccion->numero_res_accion();
									if($numero_res_accion > 0){
										$not = '<i class="fas fa-bell" style="color: green"></i>';
									}
									else{
										$not = '';
									}
								}
								elseif($url_sismenuhijo == 'autorizacionfinanciera'){
									$numero_financiera = $objAutorizacionFinanciera->numero_financiera();
									if($numero_financiera > 0){
										$not = '<i class="fas fa-bell" style="color: green"></i>';
									}
									else{
										$not = '';
									}
								}
								elseif($url_sismenuhijo == 'autorizacionordenadorgasto'){
									$numero_ordernador = $objAutorizacionOrdenadorGasto->numero_ordernador();
									if($numero_ordernador > 0){
										$not = '<i class="fas fa-bell" style="color: green"></i>';
									}
									else{
										$not = '';
									}
								}
								else{
									$not = "";
								}

								echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.' '.$not.'</a></li>';
																			
							}

							echo "</ul>";

							}
						else{
							echo "";
						}

					?>
			<?php
				}
			?>
		</ul>
	</div>
</div>
