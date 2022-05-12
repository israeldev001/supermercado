<?php
    session_start();
    if(isset($_SESSION['nombre_usuario'])){
        header('Location: ./vistas/inicio.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/layout.css" rel="stylesheet">

        <title>Supermercado</title>
    </head>
    <body>
        <form class="login"  action="includes/login.php" method="post" >
            <div class="form-floating h1_login">
                <?php
                    if(isset($_GET['error'])){
                        echo '<p align="center">'.$_GET["error"].'</p>';
                    }
                ?>
                <h4 align="center"><span>Bienvenido</span></h4>
                <p align="center">Sistema de Control Electronico.</p>
            </div>
            <div class="form-floating txt_login">
                <input name="nombre_usuario" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating txt_login">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Contraseña">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Enviar</button>
        </form>

        <script src="./js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
