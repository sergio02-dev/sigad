<?php

    class UrlAmigable{

        private $url;
        private $online;
        private $Server;
        private $url_pagina;
        private $totalVariables;
        private $contenido;
        private $codigos_url;
        private $seccion_url;
        private $codigo_elemento1;
        private $codigo_elemento2;

        public function __construct(){
            $this->url=$url;
            $this->online=$online;
            $this->Server=$Server;
            $this->url_pagina=$url_pagina;
            $this->totalVariables=$totalVariables;
            $this->contenido=$contenido;
            $this->codigos_url=$codigos_url;
            $this->seccion_url = $seccion_url;
            
        }

        public function urlRegla($online){

            $this->url = $_SERVER["REQUEST_URI"]; // toma carpeta;
            $this->Server = $_SERVER['SERVER_NAME'];
            $this->online = $online;
            
            if($this->online == true){
                $this->url = $this->Server.$this->url;
            }

            $this->url_pagina=$this->url;

            $this->url = preg_replace('/^(\/)/','',$this->url);

            // ----------------------------------------------------------------------------------------------
            // EXPLOTA EL ARRAY URL
            // ----------------------------------------------------------------------------------------------
            $array_url = explode('/',$this->url);
            //print_r($url); // Display array

            //TOTAL DE VARIABLES EN EL ARRAY URL
            $this->totalVariables = count($array_url);
            //echo 'total: '.$totalVariables.'<br><br>';



            // ----------------------------------------------------------------------------------------------
            // REGLA PARA EL DESGLOCE
            // ----------------------------------------------------------------------------------------------

            
            if ($this->totalVariables == 2){

                //PAGINA INICIAL
                if (empty($array_url[1])) {
                    //echo 'va al inicio';
                    //echo $array_url[1];
                    $this->contenido = 1;

                    $seccion_url = 'login';
                    $seccion_pagurl = $seccion_url;
                   
                    //echo $seccion_pagurl;
                }

                else {

                        //paginado
                        $seccion_url = $array_url[1];
                        $seccion_pagurl=$seccion_url;
                        $valores_url = explode('?',$seccion_url);


                        //Una Variables
                        $seccion_url = $valores_url[0]; //nombre de seccion
                        $codigo_elemento = $valores_url[1]; //variable

                        //  n Variables
                        $codigos_url = explode('-',$codigo_elemento);
                        $codigo_elemento1 = $codigos_url[0]; //variable 1
                        $codigo_elemento2 = $codigos_url[1]; //variable 2
                        $codigo_elemento3 = $codigos_url[2]; //variable 2


                        $this->contenido= 2;

                        $seccion_pagurl=$seccion_url;

                        $valores_url = explode('cdgint',$seccion_url);
                        $seccion_pagurl = $valores_url[0]; //nombre de seccion
                        $codigo_elemento = $valores_url[1]; //variable

                        //$seccion_pagurl=str_replace("-", "", $seccion_pagurl);
                        $this->codigo_elemento1 =  $codigo_elemento1;
                        $this->codigo_elemento2 = $codigo_elemento2;


                }

            }
            elseif ($this->totalVariables == 3){

                $this->contenido= 3;


                $seccion_url = $url[1];
                $titulo_url = $url[2];

                $seccion_pagurl=$seccion_url;
                $subseccionurl=$url[2];
                        $valores_url = explode('cdgint',$titulo_url);


                        //Una Variables
                        $seccion_url = $valores_url[0]; //nombre de seccion
                        $codigo_elemento = $valores_url[1]; //variable


                        $valores_elemento = explode('?',$codigo_elemento);

                        $codigo_notaelemento=$valores_elemento[0];

                        //  n Variables
                        $codigos_url = explode('-',$codigo_elemento);
                        $this->codigo_elemento1 = $codigos_url[0]; //variable 1
                        $this->codigo_elemento2 = $codigos_url[1]; //variable 2
                        //$codigo_elemento3 = $codigos_url[2]; //variable 2


            }
            
            $this->seccion_url=$seccion_url;
        } 

        public function getSeccionUrl(){
            return $this->seccion_url;
        }

        public function getContenido(){
            return $this->contenido;
        }

        public function getCodigo_elemento1(){
            return $this->codigo_elemento1;
        }

        public function getCodigo_elemento2(){
            return $this->codigo_elemento2;
        }


    }


?>