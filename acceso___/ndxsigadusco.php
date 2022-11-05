<?php

	ob_start();
        session_start();

        

        include('lbr/dataSrvdor.php'); // datos del servidor 
        include('prcsos/sstma/Sstem.php'); // procesos del sistema, archivos del sistema de acurdo a la url

        $objSistema = new Sstema();
        $objSistema->setContenido($contenido);
        $objSistema->setSeccionurl($seccion_url);
		
 

        $data_sistema = $objSistema->mostrarsistema(); // lleva los parametros para mostrar los archivos a mostrar en el sistema
	
	    //echo $contenido." ".$seccion_url;
	    //echo "<br/> ".$data_sistema;
		

        $nombre_sistema = $objSistema->getNombre_modulosytem();
        $modulosistema = $objSistema->getImagen_modulosytem();
        $filesistema = $objSistema->getIncludefile();
        $padreSystem = $objSistema->getPadreSystem();

//echo $filesistema;		



        
		if($contenido==1){
			include($filesistema);
		}
		elseif($contenido==2){
			if($seccion_url=='acceso' || $seccion_url=='salir'){
				include($filesistema);
			}
			else{
				if ($_SESSION['idusuario']){
					include($filesistema);
				}
				else{
					 header('Location:'.$enlace);
				}
			}
		}
        
  


    ob_end_flush();
    
?>