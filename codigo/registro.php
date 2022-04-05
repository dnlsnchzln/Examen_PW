<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <?php $Countries = array("España", "Chile", "Argentina", "Brasil", "Angola", "Guinea"); ?> <!--- Esto no deberiamos ponerlo, solo usarlo --->
    <?php
        if (isset($_POST["nuevousuario"])):
            if ($_POST["email"] != $_POST["email2"]):
                print "<p>Registro fallido: Los correos no coindicen.</p>";
            elseif ($_POST["pw"] != $_POST["pw2"]):
                print "<p>Registro fallido: Las contraseñas no coindicen.</p>";
            else:
                $conexion = mysqli_connect("localhost", "root", "", "examen");
                $consulta_usuario = mysqli_query($conexion, "select * from usuarios where usuario_email = '" . $_POST["email"] . "';");
                $nfilas_consulta_usuario = mysqli_num_rows($consulta_usuario);

                if ($nfilas_consulta_usuario == 1):
                    print "<p>Registro fallido: Ya existe un usuario registrado con ese correo.</p>";
                else:
                    mysqli_query($conexion, "insert into usuarios (usuario_email, usuario_sexo, usuario_yob, usuario_cp, usuario_pais, usuario_pw) values ('" . $_POST["email"] . "', '" . $_POST["sexo"] . "', " . $_POST["yob"] . ", '" . $_POST["cp"] . "', '" . $Countries[$_POST["pais"]] . "', '" . $_POST["pw"] . "');");
                    print "<p>Registro correcto: Usuario registrado correctamente en el sistema.</p>";
                endif;
            endif;
        endif;
    ?>
</head>
<body>
    <form method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>

        <label for="email2">Confirm E-mail:</label>
        <input type="email" name="email2" required><br>

        <label for="sexo">Sex:</label>
        <input type="radio" name="sexo" id="sexom" value = "Masculino">
        <label for="sexom">Male</label>
        <input type="radio" name="sexo" id="sexof" value = "Femenino">
        <label for="sexof">Female</label><br>

        <label for="yob">Year of Birth</label>
        <input type="number" name="yob" min=1922 max=2022 required><br>

        <label for="cp">ZIP/Postal Code</label>
        <input type="text" name="cp" required><br>

        <label for="pais">Country:</label>
        <select name="pais">
            <?php for ($i = 0; $i < count($Countries); $i++):?>
                <option value=<?= $i ?>><?= $Countries[$i] ?></option>
            <?php endfor; ?>
        </select><br>

        <label for="pw">Select a password:</label>
        <input type="password" name="pw" required><br>

        <label for="pw2">Confirm password:</label>
        <input type="password" name="pw2" required><br>

        <input type="hidden" name="nuevousuario">
        <input type="submit" value="Register!">
    </form>
    <a href="listar.php">Listar usuarios por país</a>
</body>
</html>