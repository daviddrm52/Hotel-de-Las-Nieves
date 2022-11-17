<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    $errores = array('nombre' => '', 'apellido_primero' => '', 'apellido_segundo' => '', 'dni' => '', 'direccion' => '', 'telefono' => '', 'email' => '', 'contrasena' => '', 'fecha_nacimiento' => '')   ;

    $nombre='';
    $apellidoPrimero=''; 
    $apellidoSegundo='';
    $dni='';
    $direccion='';
    $telefono='';
    $email='';
    $contrasena='';
    $fechaNacimiento='';

    if (isset($_POST['submit'])) {
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
    //Query de la base de datos ver los tipos de usuarios que hay
    $selectTipo = "SELECT id, nombre FROM 73_tipos_usuarios";

    //Lanzamos la query y capturamos los resultados
    $resultadosTipo = mysqli_query($conn, $selectTipo);

    if (isset($_POST['submit'])) {
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
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $apellidoPrimero = mysqli_real_escape_string($conn, $_POST['apellido_primero']);
            $apellidoSegundo = mysqli_real_escape_string($conn, $_POST['apellido_segundo']);
            $dni = mysqli_real_escape_string($conn, $_POST['dni']);
            $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);
            $fechaNacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
                  
            $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);
            
            //Construir la query
            $queryUpdateUsuario = "UPDATE 73_clientes SET nombre = '$nombre', apellido_primero = '$apellidoPrimero', apellido_segundo = '$apellidoSegundo', dni = '$dni', direccion = '$direccion', telefono = '$telefono', email = '$email', contrasena = '$contrasena', fecha_nacimiento = '$fechaNacimiento' WHERE id = '$id_a_actualizar'";

            //Ara guardarem les dades a la bd i comprovarem si ha anat bé.
            if(mysqli_query($conn, $queryUpdateUsuario)): 
                header('Location: ./index_cliente.php');
            else: 
                echo 'Error a la query: ' . mysqli_error($conn);
            endif;
        }
    }

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
    
        //Query de selección
        $sqlUpdateUsuario = "SELECT * FROM 73_clientes WHERE id = $id";
    
        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlUpdateUsuario);
    
        //Volcar los resultados en un array
        $User = mysqli_fetch_assoc($resultado);
    
        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        //mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Actualizar cliente - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

    <section>
    <form action="update_cliente.php" method="POST" class="white">
        <?php if($User): ?>
        <fieldset>
            <legend> Actualizar clientes </legend>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($User['nombre']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['nombre'])?></div>
            <label for="apellido_primero"> Primer apellido: </label>
            <input type="text" name="apellido_primero" value="<?php echo htmlspecialchars($User['apellido_primero']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['apellido_primero'])?></div>
            <label for="apellido_segundo"> Segundo apellido: </label>
            <input type="text" name="apellido_segundo" value="<?php echo htmlspecialchars($User['apellido_segundo']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['apellido_segundo'])?></div>
            <label for="dni"> DNI: </label>
            <input type="text" name="dni" value="<?php echo htmlspecialchars($User['dni']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['dni'])?></div>
            <label for="direccion"> Dirección: </label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($User['direccion']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['direccion'])?></div>
            <label for="telefono"> Telefono: </label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($User['telefono']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['telefono'])?></div>
            <label for="email"> Correo electronico: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($User['email']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['email'])?></div>
            <label for="contrasena"> Contraseña: </label>
            <input type="password" name="contrasena" value="<?php echo htmlspecialchars($User['contrasena']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['contrasena'])?></div>
            <label for="fecha_nacimiento"> Fecha de nacimiento: </label>
            <input type="text" name="fecha_nacimiento" class="datepicker" value="<?php echo htmlspecialchars($User['fecha_nacimiento']) ?>"> 
            <div class="red-text"><?php echo htmlspecialchars($errores['fecha_nacimiento'])?></div>
            <?php endif; ?>
            <input type="hidden" name="id_a_actualizar" value="<?php echo $User['id']?>">    
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Actualizar cliente
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
