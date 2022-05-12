<?php
    session_start();
    if(!isset($_SESSION['nombre_usuario'])){
        header('Location: ../index.php');
    }
    require '../includes/database.php';
    $database = new Database();
    $pdo = $database->connect();
    $columnas = $pdo->query("SELECT COLUMN_NAME AS columna, COLUMN_TYPE AS tipo FROM information_schema.columns WHERE table_schema = '$database->dbNombre' AND table_name = '$_GET[tabla]'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/layout.css" rel="stylesheet">

        <script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <title>Supermercado</title>
    </head>
    <body>
        <?php
            require '../includes/menu.php';
            $menu = new menu();
            echo $menu->despliega_menu();
        ?>
        <div class="centro col-md-11">
            <form method="post" class="row g-3">
                <?php
                    foreach($columnas AS $campo => $valor){
                        if($valor['columna']==='id'){
                            continue;
                        }else{
                            echo '<div class="col-md-4">';
                            echo '<label for="inputEmail4" class="form-label">Inserta '.$valor['columna'].':</label>';
                            echo '<input type="text"  class="form-control" name="'.$valor['columna'].'">';
                            echo '</div>';
                        }
                    }
                ?>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Inserta</button>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
if(!empty($_POST)){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="INSERT INTO $_GET[tabla] (";
    foreach ($_POST as $campo => $valor) {
        $sql.= $campo.", ";
    }
    $sql = trim($sql, ', ');
    $sql.=") values(";


    for($i=0;$i<count($_POST); $i++){
        $sql.='?, ';
    }
    $sql = trim($sql, ', ');
    $sql.=")";

    $q = $pdo->prepare($sql);
    foreach ($_POST as $campo => $valor) {
        $valores[] = $valor;
    }

    $q->execute($valores);

    $pdo = $database->disconnect();
} else{
    header('Location: index.php');
}
