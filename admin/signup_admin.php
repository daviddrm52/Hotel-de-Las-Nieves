<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    $errores = array('usuario' => '', 'nombre' => '', 'apellido_primero' => '', 'apellido_segundo' => '', 'dni' => '', 'tipo_id' => '','direccion' => '', 'telefono' => '', 'email' => '', 'contrasena' => '', 'fecha_nacimiento' => '')   ;

    $usuarioSign='';
    $nombre='';
    $apellidoPrimero=''; 
    $apellidoSegundo='';
    $tipoID='2';
    $dni='';
    $direccion='';
    $telefono='';
    $email='';
    $contrasena='';
    $fechaNacimiento='';

    if (isset($_POST['submit'])) {
        $usuarioSign = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellidoPrimero = $_POST['apellido_primero'];
        $apellidoSegundo = $_POST['apellido_segundo'];        
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
    }
    if (isset($_POST['submit'])) {
        if(empty($_POST['usuario'])) {
            $errores['usuario'] = 'El nombre de usuario es obligatorio';
        } else {
            $usuarioSign = $_POST['usuario'];
            if(!preg_match('/^[a-zA-Z0-9]+$/', $usuarioSign)) {
                $errores['usuario'] = '¡El nombre solo puede estar compuesto de letras y numeros sin espacios!';
            }
            //Verificar si este usuario esta registrado
            $queryUsuario="SELECT usuario FROM 73_clientes";
            //Lanzamos la query para ver los resultados
            $resultadosUsuario = mysqli_query($conn, $queryUsuario);
            //Volcamos el resultado en un array
            $verificarUsuario = mysqli_fetch_assoc($resultadosUsuario);
            //Miramos si existe el usuario en la base de datos
            $usuarioBaseDatos = $verificarUsuario['usuario'];
            //Comparamos los dos nombres introducidos, en caso de coincidir, no dejamos que continue
            if($usuarioBaseDatos==$usuarioSign){
                $errores['usuario'] = '¡El usuario debe de ser unico!';
            } else {}
        }
        if(empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio';
        } else {
            $nombre = $_POST['nombre'];
            if(!preg_match('/^[a-zA-Z]+$/', $nombre)) {
                $errores['nombre'] = '¡El nombre solo puede estar compuesto de letras!';
            }
        }
        if(empty($_POST['apellido_primero'])) {
            $errores['apellido_primero'] = 'El apellido es obligatorio';
        } else {
            $apellidoPrimero = $_POST['apellido_primero'];
            if(!preg_match('/^[a-zA-Z]+$/', $apellidoPrimero)) {
                $errores['apellido_primero'] = '¡El apellido solo puede estar compuesto de letras!';
            }
        }
        if(empty($_POST['apellido_segundo'])) {
            $errores['apellido_segundo'] = 'El apellido es obligatorio';
        } else {
            $apellidoSegundo = $_POST['apellido_segundo'];
            if(!preg_match('/^[a-zA-Z]+$/', $apellidoSegundo)) {
                $errores['apellido_segundo'] = '¡El apellido solo puede estar compuesto de letras!';
            }
        }
        if(empty($_POST['dni'])) {
            $errores['dni'] = 'El DNI es obligatorio';
        } else {
            $dni = $_POST['dni'];
            if(!preg_match('/^[0-9A-Z]+$/', $dni)) {
                $errores['dni'] = '¡El DNI solo puede estar compuesto de letras y numeros!';
            }
        }
        if(empty($_POST['direccion'])) {
            $errores['direccion'] = 'La dirección es obligatoria';
        }
        if(empty($_POST['telefono'])) {
            $errores['telefono'] = 'El telefono es obligatorio';
        } else {
            $telefono = $_POST['telefono'];
            if(!preg_match('/^[0-9]+$/', $telefono)) {
                $errores['telefono'] = '¡El telefono solo puede estar compuesto de numeros!';
            }
        }
        if(empty($_POST['email'])) {
            $errores['email'] = 'El correo es obligatorio';
        }
        if(empty($_POST['contrasena'])) {
            $errores['contrasena'] = 'La contraseña es obligatoria';
        }
        if(empty($_POST['fecha_nacimiento'])) {
            $errores['fecha_nacimiento'] = 'La fecha de nacimiento es obligatoria';
        }
        if(!array_filter($errores)) {    
            //Evitar la injección de codigo malicioso a la bd
            $usuarioSign = mysqli_real_escape_string($conn, $_POST['usuario']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $apellidoPrimero = mysqli_real_escape_string($conn, $_POST['apellido_primero']);
            $apellidoSegundo = mysqli_real_escape_string($conn, $_POST['apellido_segundo']);
            $dni = mysqli_real_escape_string($conn, $_POST['dni']);
            $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);
            $fechaNacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
                    
            $sql = "INSERT INTO 73_clientes (usuario,nombre,apellido_primero,apellido_segundo,tipo_id,dni,direccion,telefono,email,contrasena,fecha_nacimiento) VALUES('$usuarioSign','$nombre', '$apellidoPrimero', '$apellidoSegundo', '$tipoID','$dni','$direccion','$telefono','$email','$contrasena','$fechaNacimiento')";
            //Ara guardarem les dades a la bd i comprovarem si ha anat bé.
            if(mysqli_query($conn, $sql)): 
                header('Location: ./login_admin.php');
            else: 
                echo 'Error a la query: ' . mysqli_error($conn);
            endif;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Creando cuenta de administrador - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

    <section>
    <form action="signup_admin.php" method="POST" class="white">
        <fieldset>
            <legend> Crear administrador </legend>
            <label for="usuario"> Nombre de usuario: </label>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuarioSign) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['usuario'])?></div>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['nombre'])?></div>
            <label for="apellido_primero"> Primer apellido: </label>
            <input type="text" name="apellido_primero" value="<?php echo htmlspecialchars($apellidoPrimero) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['apellido_primero'])?></div>
            <label for="apellido_segundo"> Segundo apellido: </label>
            <input type="text" name="apellido_segundo" value="<?php echo htmlspecialchars($apellidoSegundo) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['apellido_segundo'])?></div>
            <label for="dni"> DNI: </label>
            <input type="text" name="dni" value="<?php echo htmlspecialchars($dni) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['dni'])?></div>
            <label for="direccion"> Dirección: </label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($direccion) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['direccion'])?></div>
            <label for="telefono"> Telefono: </label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['telefono'])?></div>
            <label for="email"> Correo electronico: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['email'])?></div>
            <label for="contrasena"> Contraseña: </label>
            <input type="password" name="contrasena" value="<?php echo htmlspecialchars($contrasena) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['contrasena'])?></div>
            <label for="fecha_nacimiento"> Fecha de nacimiento: </label>
            <input type="text" name="fecha_nacimiento" class="datepicker"> 
            <div class="red-text"><?php echo htmlspecialchars($errores['fecha_nacimiento'])?></div>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Crear administrador
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </fieldset>
    </form>
</section>

<?php include('./../templates/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {format: 'yyyy-mm-dd'});
  });
</script>

</body>
</html>
