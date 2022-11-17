<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['delete'])){
        $id_a_eliminar = mysqli_real_escape_string($conn, $_POST['id_a_eliminar']);

        //Creamos la query
        $queryDeleteUsuario = "DELETE FROM 73_clientes WHERE id=$id_a_eliminar";

        //Lanzamos la query
        if(mysqli_query($conn, $queryDeleteUsuario)){
            //La cosa ha ido bien
            header('Location: ./../config/logout.php');
        } else {
            //La cosa ha fallado
            echo 'Error en la query: '. mysqli_error($conn);
        }
    }

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlDeleteUsuario = "SELECT * FROM 73_clientes WHERE id = $id";

        //Recuperamos los resultados
        $resultadoDeleteUsuario = mysqli_query($conn, $sqlDeleteUsuario);

        //Volcar los resultados en un array
        $usuarioDelete = mysqli_fetch_assoc($resultadoDeleteUsuario);

        //Liberar memoria
        mysqli_free_result($resultadoDeleteUsuario);
    }

    //Variables para las querys
    $tipoId = $usuarioDelete['tipo_id'];

    //Querys para saber el tipo de usuario
    $sqlSelectTipo = "SELECT * FROM 73_tipos_usuarios WHERE id = $tipoId";
                            
    //Lanzamos la query y capturamos los resultados
    $resultadoSelectTipo = mysqli_query($conn, $sqlSelectTipo);
                            
    //Volcar los resultados en un array
    $tipoUsuario = mysqli_fetch_assoc($resultadoSelectTipo); 
            
    //Cerrar conexión con bd
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title> Eliminar a <?php echo htmlspecialchars($usuarioDelete['usuario'])?> - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center white">
    <h4> <i class="material-icons">info_outline</i> Información de <?php echo htmlspecialchars($usuarioDelete['nombre']);?> <?php echo htmlspecialchars($usuarioDelete['apellido_primero']);?> <?php echo htmlspecialchars($usuarioDelete['apellido_segundo']);  ?> </h4>
    <div class="container white center">
        <?php if($usuarioDelete):?>
            <table>
                <tr>
                    <td> <b>Nombre de usuario (username)</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['usuario']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Nombre</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['nombre']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Primer apellido</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['apellido_primero']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Segundo apellido</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['apellido_segundo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Tipo de usuario</b> </td>
                    <td> <?php echo htmlspecialchars($tipoUsuario['nombre'])?></td>
                </tr>
                <tr>
                    <td> <b>DNI</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['dni']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Dirección</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['direccion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Telefono</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['telefono']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Correo electronico</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['email']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Contraseña</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['contrasena']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Fecha de nacimiento</b> </td>
                    <td> <?php echo htmlspecialchars($usuarioDelete['fecha_nacimiento']) ?> </td>
                </tr>
            </table>
            <?php endif; ?>
            <h5>¿Esta seguro que desea ELIMINAR su usuario?</h5>
            <form action="delete_cliente.php" method="POST">
                <input type="hidden" name="id_a_eliminar" value="<?php echo $usuarioDelete['id']?>">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="delete">Eliminar usuario<i class="material-icons right">delete_forever</i></button>
            </form>
        </div>
    </div>
    <br>
        <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de pagina del cliente </a> </p>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir a la pagina de inicio del hotel </a> </p>  
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>