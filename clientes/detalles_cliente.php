<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

        //Variables para las querys
        //$tipoId = $usuarios['tipo_id'];

        //Querys para saber el tipo de usuario
        //$sqlSelectTipo = "SELECT * FROM 73_tipos_usuarios WHERE id = $tipoId";
    
        //Lanzamos la query y capturamos los resultados
        //$resultadoSelectTipo = mysqli_query($conn, $sqlSelectTipo);
    
        //Volcar los resultados en un array
        //$tipoUsuario = mysqli_fetch_assoc($resultadoSelectTipo);  
    
    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlDeleteUsuario = "SELECT * FROM 73_clientes WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlDeleteUsuario);

        //Volcar los resultados en un array
        $usuarios = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }  

?>

<!DOCTYPE html>
<html lang="es">
<title> Información del cliente <?php echo htmlspecialchars($usuarios['usuario'])?> - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center white fondoInicio">
    <h4> <i class="material-icons">info_outline</i> Información de <?php echo htmlspecialchars($usuarios['nombre']);?> <?php echo htmlspecialchars($usuarios['apellido_primero']);?> <?php echo htmlspecialchars($usuarios['apellido_segundo']);  ?> </h4>
    <div class="container white center">
        <?php if($usuarios):?>
            <table>
                <tr>
                    <td> <b>Nombre de usuario (username)</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['usuario']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Nombre</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['nombre']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Primer apellido</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['apellido_primero']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Segundo apellido</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['apellido_segundo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>DNI</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['dni']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Dirección</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['direccion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Telefono</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['telefono']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Correo electronico</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['email']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Contraseña</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['contrasena']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Fecha de nacimiento</b> </td>
                    <td> <?php echo htmlspecialchars($usuarios['fecha_nacimiento']) ?> </td>
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
                <p class="center"> <a href="./index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir a tu pagina de inicio </a> </p>
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>