<?php session_start(); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

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
<title> Detalles del administrador <?php echo htmlspecialchars($Usuarios['username'])?> - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center white">
    <h4> <i class="material-icons">info_outline</i> Información del usuario <?php echo htmlspecialchars($Usuarios['id']) ?> </h4>
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
        </div>
    </div>
    <br>
        <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
                <p class="center"> <a href="./index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>