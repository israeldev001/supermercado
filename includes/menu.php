<?php
session_start();

class menu{
    public string $menu;
    public function despliega_menu(){

        $menu = '<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">';
        $menu .= '<div class="container-fluid">';
        $menu .= '<a class="navbar-brand" href="inicio.php">Inicio</a>';
        $menu .= '<div class="collapse navbar-collapse" id="navbarsExample04">';
        $menu .= '<ul class="navbar-nav me-auto mb-2 mb-md-0">';
        foreach($_SESSION['tablas'] AS $tabla){
            $menu .=  '<li class="nav-item dropdown">';
            $menu .=  '<a class="nav-link dropdown-toggle" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">'.$tabla['nombre_tabla'].'</a>';
            $menu .=  '<ul class="dropdown-menu" aria-labelledby="dropdown04">';
            $menu .=  '<li><a class="dropdown-item" href="alta.php?tabla='.$tabla['tabla'].'">Alta</a></li>';
            $menu .=  '<li><a class="dropdown-item" href="lista.php?tabla='.$tabla['tabla'].'">Lista</a></li>';

            if($tabla['tabla']==='venta'){
                $menu .=  '<li><a class="dropdown-item" href="reporte.php?tabla='.$tabla['tabla'].'">Reporte '.$tabla['nombre_tabla'].'</a></li>';
            }

            $menu .=  '</ul></li>';
        }
        $menu .= '</ul>';
        $menu .= '<a href="../includes/salir.php"  class="logout">Logout</a>';
        $menu .= '</div>';
        $menu .= '</div>';
        $menu .= '</nav>';

        return $menu;
    }
}