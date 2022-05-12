<?php
    session_start();
    if(!isset($_SESSION['nombre_usuario'])){
        header('Location: ../index.php');
    }

    require '../includes/database.php';
    $database = new Database();
    $pdo = $database->connect();
    $campos = $pdo->query("SELECT * FROM $_GET[tabla] WHERE id = $_GET[id]")->fetch(PDO::FETCH_ASSOC);
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
        <form class="row g-3">
            <?php
            foreach($campos AS $campo => $valor){
                if($campo==='id'){
                    continue;
                }else{
                    echo '<div class="col-md-4">';
                    echo '<label for="inputEmail4" class="form-label">Inserta '.$campo.':</label>';
                    echo '<input type="text"  class="form-control" name="'.$campo.'" value="'.$valor.'">';
                    echo '</div>';
                }
            }
            ?>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>
    </div>
    </body>
</html>