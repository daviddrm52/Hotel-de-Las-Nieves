<?php session_start(); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['delete'])){
        $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);

        //Creamos la query
        $queryDeleteUsuario = "DELETE FROM 73_clientes WHERE id=$id_a_eliminar";

        //Lanzamos la query
        if(mysqli_query($conn, $queryDeleteUsuario)){
            //La cosa ha ido bien
            header('Location: ./../index.php');
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
        $resultado = mysqli_query($conn, $sqlDeleteUsuario);

        //Volcar los resultados en un array
        $Usuarios = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        //mysqli_close($conn);
    }

    //Variables para las querys
    $tipoId = $Usuarios['tipo_id'];

    //Querys para saber el tipo de usuario
    $sqlSelectTipo = "SELECT * FROM 73_tipos_usuarios WHERE id = $tipoId";

    //Lanzamos la query y capturamos los resultados
    $resultadoSelectTipo = mysqli_query($conn, $sqlSelectTipo);

    //Volcar los resultados en un array
    $tipoUsuario = mysqli_fetch_assoc($resultadoSelectTipo);    

?>

<!DOCTYPE html>
<html lang="es">
<title> Eliminar a <?php echo htmlspecialchars($Usuarios['username'])?> - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center white">
    <h4> <i class="material-icons">info_outline</i> Información del administrador <?php echo htmlspecialchars($Usuarios['id']) ?> </h4>
    <div class="container white center">
        <?php if($Usuarios):?>
            <table>
                <tr>
                    <td> <b>Nombre de usuario (username)</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['usuario']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Nombre</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['nombre']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Primer apellido</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['apellido_primero']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Segundo apellido</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['apellido_segundo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Tipo de usuario</b> </td>
                    <td> <?php echo htmlspecialchars($tipoUsuario['nombre'])?></td>
                </tr>
                <tr>
                    <td> <b>DNI</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['dni']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Dirección</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['direccion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Telefono</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['telefono']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Correo electronico</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['email']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Contraseña</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['contrasena']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Fecha de nacimiento</b> </td>
                    <td> <?php echo htmlspecialchars($Usuarios['fecha_nacimiento']) ?> </td>
                </tr>
            </table>
            <?php endif; ?>
            <h5>¿Esta seguro que desea ELIMINAR este administrador?</h5>
            <form action="delete_usuarios.php" method="POST">
                <input type="hidden" name="id_a_actualizar" value="<?php echo $Usuarios['id']?>">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="delete">Eliminar administrador<i class="material-icons right">delete_forever</i></button>
            </form>
        </div>
    </div>
    <br>
        <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio de pagina del cliente </a> </p>
                <p class="center"> <a href="./../index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>
                <p class="center"> <a href="./select_usuarios.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Volver a la busqueda de usuarios </a> </p>  
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>