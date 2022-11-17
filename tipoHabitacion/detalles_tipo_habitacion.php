<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sql = "SELECT * FROM 73_tipushabitacio WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sql);

        //Volcar los resultados en un array
        $tipo = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Detalles del tipo de habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container white center">
    <h5> <i class="material-icons">info_outline</i> Información del tipo de habitación: <?php echo htmlspecialchars($tipo['nombre']) ?> </h5>
        <?php if($tipo):?>
            <table>
                <tr>
                    <td> <b>Foto de la habitación</b> </td>
                    <td> <img class="responsive-img" src="<?php echo htmlspecialchars($tipo['fotos'])?>"/> </td>
                </tr>
                <tr>
                    <td> <b>Precio de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipo['precio']) ?>€ </td>
                </tr>
                <tr>
                    <td> <b>Descripción de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipo['descripcion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Capacidad maxima de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipo['capacidad']) ?> persona/s. </td>
                </tr>
                <tr>
                    <td> <b>Codigo de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipo['codigo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Extras de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipo['extras']) ?> </td>
                </tr>
            </table>
            <?php endif; ?>
        </br>
        </div>
    </br>
    <div class="fondoAcerca">
        <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
        <section>
            <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
            <p class="center"> <a href="./../index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>
            <p class="center"> <a href="./select_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Volver a la busqueda de tipos de habitación </a> </p>  
        </section>
    </div>

</body>

<?php include('./../templates/footer.php'); ?>

</html>