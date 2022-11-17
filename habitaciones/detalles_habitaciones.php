<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlDeleteHabitacion = "SELECT * FROM 73_habitacio WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlDeleteHabitacion);

        //Volcar los resultados en un array
        $habitacion = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Detalles de la habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center white">
    <h5> <i class="material-icons">info_outline</i> Información de la habitación <?php echo htmlspecialchars($habitacion['numero']) ?> </h5>
    <div class="container white center">
        <?php if($habitacion):?>
            <table>
                <tr>
                    <td> <b>Tipo de habitación</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['tipo_habitacion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Numero de habitación</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['numero']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Nombre</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['nombre']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Estado de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['cerrada']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Descripción de la habitación</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['descripcion']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Observaciones</b> </td>
                    <td> <?php echo htmlspecialchars($habitacion['observaciones']) ?> </td>
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
        <p class="center"> <a href="./../admin/index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>
        <p class="center"> <a href="./select_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Volver a la busqueda de habitaciones </a> </p>  
    </section>
</div>

</br>

<?php include('./../templates/footer.php'); ?>

</html>