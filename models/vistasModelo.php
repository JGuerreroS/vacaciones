<?php

    class vistasModelo{

        protected function obtener_vistas_modelo($vistas){

            $listaBlanca = ["inicio", "usuarios", "registrar", "reporte", "reportes", "buscar", "dependencias"];

            if (in_array($vistas,$listaBlanca)) {

                if(is_file("./views/contenido/" . $vistas. "-view.php")){

                    $contenido = "./views/contenido/" . $vistas. "-view.php";

                    if($contenido == "./views/contenido/reporte-view.php"){

                        $contenido = 'reporte';

                    }elseif ($contenido == "./views/contenido/reportes-view.php") {
                        
                        $contenido = 'reportes';

                    }

                }else{

                    $contenido = 'login';

                }
                
            }elseif($vistas == 'login'){

                $contenido = 'login';

            }elseif($vistas == 'index'){

                $contenido = 'login';

            }elseif($vistas = '404'){

                $contenido = '404';

            }else{

                $contenido = '404';

            }

            return $contenido;

        }

    }