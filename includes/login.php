<?php
include 'database.php';
session_start();

$error = '';
if(isset($_SESSION['nombre_usuario'])){
    header('Location: ../vistas/inicio.php');
} else if(isset($_POST['login'])){
    $user = $_POST['nombre_usuario'];
    $pass = $_POST['password'];

    $database = new Database();
    $pdo = $database->connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $pdo->prepare("SELECT * FROM empleado WHERE nombre_usuario = :user AND password = :pass");
    $query->bindParam(":user",$user);
    $query->bindParam(":pass",$pass);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    $tablas = $pdo->query("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = '$database->dbNombre';")->fetchAll(PDO::FETCH_COLUMN);

    if($query->rowCount()){
        $_SESSION['empleado_id'] =  $usuario['id'];
        $_SESSION['nombre_usuario'] =  $usuario['nombre_usuario'];
        $_SESSION['tipo_empleado'] =  $usuario['tipo_empleado'];
        $_SESSION['tablas'] = renombra($tablas);
        header('Location: ../vistas/inicio.php');
    }else{
        $error = 'Usuario y/o contraseña es incorrecto';
        header('Location: ../index.php?error='.$error);
    }
}

function renombra(array $tablas): array
{
    $r_tabla = array();

    foreach ($tablas as $tabla){
        $r['tabla'] = $tabla;

        $tabla = str_replace('_', ' ',$tabla);
        $nombre_tabla =  ucfirst($tabla);

        $r['nombre_tabla'] = $nombre_tabla;

        $r_tabla[] = $r;
    }

    return $r_tabla;
}