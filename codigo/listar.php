<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <?php $Countries = array("España", "Chile", "Argentina", "Brasil", "Angola", "Guinea"); ?> <!--- Esto no deberiamos ponerlo, solo usarlo --->
</head>
<body>
    <form method="post">
        <label for="pais">Country:</label>
        <select name="pais">
            <?php for ($i = 0; $i < count($Countries); $i++):?>
                <option value=<?= $i ?>><?= $Countries[$i] ?></option>
            <?php endfor; ?>
        </select><br>

        <input type="hidden" name="listarusuarios">
        <input type="submit" value="Listar!">
    </form>

    <?php
        if (isset($_POST["listarusuarios"])):
            $conexion = mysqli_connect("localhost", "root", "", "examen");
            $consulta_usuarios = mysqli_query($conexion, "select * from usuarios where usuario_pais = '" . $Countries[$_POST["pais"]] . "';");
            $nfilas_consulta_usuarios = mysqli_num_rows($consulta_usuarios);

            if ($nfilas_consulta_usuarios == 0):
                print "<p>Lo sentimos. No existen usuarios registrados en ese país.</p>";
            else:
                print "<table>";
                print "<tr><td><strong>E-mail</strong></td><td><strong>Sex</strong></td><td><strong>Year of Birth</strong></td><td><strong>ZIP/Postal Code</strong></td></tr>";
                for ($i = 0; $i < $nfilas_consulta_usuarios; $i++):
                    $fila_counsulta_usuario = mysqli_fetch_array($consulta_usuarios);
                    print "<tr><td>" . $fila_counsulta_usuario["usuario_email"] . "</td><td>" . $fila_counsulta_usuario["usuario_sexo"] . "</td><td>" . $fila_counsulta_usuario["usuario_yob"] . "</td><td>" . $fila_counsulta_usuario["usuario_cp"] . "</td></tr>";
                endfor;
                print "</table>";
            endif;
        endif;
    ?>
    <br>
    <a href="registro.php">Registro</a>
</body>
</html>