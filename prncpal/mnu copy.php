<?php
	include('prcsos/mnu.php');

	$menusistema=new MenuSistema();
	$menu_izquierdo = $menusistema->menusistema();
	$personaSistema = $_SESSION['idusuario'];


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

									if(($personaSistema== 17) || ($personaSistema== 18) || ($personaSistema== 20)){
										if(($codigo_sismenu==9) || ($codigo_sismenu==2)){
							?>
										<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
											<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
										</li>
							<?php
										}
										else{

										}
									}
									elseif($personaSistema== 19){
										if(($codigo_sismenu==9) || ($codigo_sismenu==2)){
							?>
										<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
											<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
										</li>
							<?php
										}
									}
									else{

										if($personaSistema>=2 && $personaSistema<=16){
											if($codigo_sismenu==16){
							?>

											<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
												<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
											</li>
							<?php
											}
										}
										elseif($personaSistema==34 || $personaSistema==35 || $personaSistema==2020011416352446865 || $personaSistema==2020011416365362559 || $personaSistema==2020011416375847096 ){
											if($codigo_sismenu==16){
							?>
											<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
												<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
											</li>
							<?php
											}
										}
										else{
							?>
										<li data-toggle="collapse" data-target="#<?php echo $idsys; ?>" class="collapsed">
											<a href="<?php echo $urlsys; ?>"><?php echo $sys_imagen; ?><?php echo $nombre_sismenu;?><?php echo $arrow; ?></a>
										</li>	
							<?php
										}
							?>		
									

							<?php
									}
							?>
									

									<?php
										if(preg_match('/_NA_/i', $url_sismenu)){
											echo '<ul class="sub-menu collapse '.$showMenu.'" id="'.$idsys.'">';

											$menusistema->submenusistema($codigo_sismenu);
											$submenu=$menusistema->getSubmenu();

											foreach ($submenu as $data_menuizqhijo){

												$codigo_sismenuhijo=$data_menuizqhijo['sys_codigo'];
												$nombre_sismenuhijo=$data_menuizqhijo['sys_nombre'];
												$url_sismenuhijo=$data_menuizqhijo['sys_url'];
												$sys_imagenhijo=$data_menuizqhijo['sys_imagen'];

												if(($personaSistema== 17) || ($personaSistema== 18) || ($personaSistema== 20)){
													if($codigo_sismenuhijo==48){
														echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
													}
													else{

													}	
												}
												elseif($personaSistema== 19){
													if($codigo_sismenuhijo==48){
														echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
													}
													else{

													}
												}
												
												elseif($personaSistema>=2 && $personaSistema<=16){
													if(($codigo_sismenuhijo== 39) || ($codigo_sismenuhijo== 32) || ($codigo_sismenuhijo== 23) ){
														echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
													}
												}
												elseif($personaSistema==34 || $personaSistema==35 || $personaSistema==2020011416352446865 || $personaSistema==2020011416365362559 || $personaSistema==2020011416375847096 ){
													if($codigo_sismenuhijo== 39){
														echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
													}	
												}
												else{
													//////////////////////////////////
													if(($codigo_sismenuhijo== 43) || ($codigo_sismenuhijo== 48) || ($codigo_sismenuhijo== 39) ){
														if(($personaSistema== 201604281729001) || ($personaSistema== 1) ){
															echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
														}
													}
													else{
														echo '<li><a href="'.$url_sismenuhijo.'">'.$sys_imagenhijo.' '.$nombre_sismenuhijo.'</a></li>';
													}
												}


												

												
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
