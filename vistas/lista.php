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
        <script>
            function myFunction() {
                alert('Eliminado correctamente');
            }
        </script>

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
                <div class="col0-md-4">
                    <label for="inputEmail4" class="form-label">Buscar por id:
                        <input type="text"  class="form-control">
                    </label>
                </div>
            </form>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
        <div class="centro col-md-11">
            <table class="table table-hover caption-top">
                <?php
                    echo "<caption>$_GET[tabla]</caption>";
                ?>
                <thead>
                    <tr>
                        <?php
                        foreach($columnas AS $campo=>$valor){
                            if($_GET['tabla']==="usuario" && $valor['columna'] === "password"){
                                continue;
                            }else{
                                echo '<th scope="col">'.$valor['columna'].'</th>';
                            }
                        }
                        ?>
                        <th>Modifica</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tabla = $pdo->query("SELECT * FROM $_GET[tabla]")->fetchALL(PDO::FETCH_ASSOC);
                    if(count($tabla)>0){
                        foreach ($tabla as $campo => $valor) {
                            echo '<tr>';
                            $res='';
                            foreach ($valor as $cam => $val) {
                                if($_GET['tabla']==="usuario" && $cam === "password"){
                                    continue;
                                }else{
                                    $res .= '<td>' . $val . '</td>';
                                }
                            }
                            echo $res;
                            echo '<td>';
                            echo '<a href="modifica.php?tabla='.$_GET['tabla'].'&id='.$valor['id'].'">Modifica</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a onclick="myFunction()" href="elimina.php?tabla='.$_GET['tabla'].'&id='.$valor['id'].'">Elimina</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php
