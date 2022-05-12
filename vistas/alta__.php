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
        <h4>Informacion Venta</h4>
        <hr>
        <form class="row g-3">
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">
                        Fecha:
                        <input type="text"  class="form-control" name="'.$valor['columna'].'">
                    </label>
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">
                        ID Venta:
                        <input type="text"  class="form-control" name="'.$valor['columna'].'">
                    </label>
                </div>

                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">
                        ID Empleado:
                        <input type="text"  class="form-control" name="'.$valor['columna'].'">
                    </label>
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">
                        Empleado:
                        <input type="text"  class="form-control" name="'.$valor['columna'].'">
                    </label>
                </div>
            </form>
    </div>
    <br>
    <div class="centro col-md-11">
        <h4>Informacion Producto</h4>
        <hr>
        <form class="row g-3">
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Id Producto:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Codigo:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Descripcion:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Precio:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Stock:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Cantidad:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-12">
                <button style="width: 100%" type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        <br>
        <table class="table table-hover caption-top">
            <caption>Productos registrados</caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Importe</th>
            </tr>
            </thead>
            <tbody>
           <!-- <tr>
                <td>1</td>
                <td>0021453</td>
                <td>Leche</td>
                <td>32</td>
                <td>2</td>
                <td>64</td>
            </tr>-->
            </tbody>
        </table>
        <br>
        <hr>
        <form class="row g-3">
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Subtotal:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    IVA:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">
                    Total:
                    <input type="text"  class="form-control" name="'.$valor['columna'].'">
                </label>
            </div>

            <div class="col-12">
                <button style="width: 100%" type="submit" class="btn btn-primary">Registrar Venta</button>
            </div>
        </form>
    </div>
    </body>
</html>