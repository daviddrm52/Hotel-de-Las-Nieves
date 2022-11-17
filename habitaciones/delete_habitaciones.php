<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['delete'])){
        $id_a_eliminar = mysqli_real_escape_string($conn, $_POST['id_a_eliminar']);

        //Creamos la query
        $queryDeleteHabitacion = "DELETE FROM 73_habitacio WHERE id=$id_a_eliminar";

        //Lanzamos la query
        if(mysqli_query($conn, $queryDeleteHabitacion)){
            //La cosa ha ido bien
            header('Location: select_habitaciones.php');
        } else {
            //La cosa ha fallado
            echo 'Error en la query: '. mysqli_error($conn);
        }
    }

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
<title>Eliminar una habitación - Hotel de Las Nieves</title>

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
            <h5> ¿Esta seguro de eliminar esta habitación? </h5>
            <?php endif; ?>
            <form action="delete_habitaciones.php" method="POST">
                <input type="hidden" name="id_a_eliminar" value="<?php echo $habitacion['id']?>">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="delete">Borrar habitación
                    <i class="material-icons right">delete_forever</i>
                </button>
            </form>
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