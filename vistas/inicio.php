<?php
    session_start();
    if(!isset($_SESSION['nombre_usuario'])){
        header('Location: ../index.php');
    }
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

    <div class="mis_acciones centro col-md-11">
        <h4>Mis acciones</h4>
        <hr>

    </div>
    </body>
</html>