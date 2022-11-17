<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['delete'])){
        $id_a_eliminar = mysqli_real_escape_string($conn, $_POST['id_a_eliminar']);

        //Creamos la query
        $query = "DELETE FROM 73_tipushabitacio WHERE id=$id_a_eliminar";

        //Lanzamos la query
        if(mysqli_query($conn, $query)){
            //La cosa ha ido bien
            header('Location: select_tipo_habitacion.php');
        } else {
            //La cosa ha fallado
            echo 'Error en la query: '. mysqli_error($conn);
        }
    }

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

        //print_r($pizza);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Eliminar un tipo de habitación - Hotel de Las Nieves</title>

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
            <h5> ¿Esta seguro de eliminar este tipo de habitación? </h5>
            <h6>  Hagalo unicamente si este tipo de habitación no esta asociada a ninguna habitación abierta. </h6>
            <?php endif; ?>
            <form action="delete_tipo_habitacion.php" method="POST">
                <input type="hidden" name="id_a_eliminar" value="<?php echo $tipo['id']?>">
                <!-- <input type="submit" name="delete" value="Borrar habitación" class="btn brand z-depth-0"> -->
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="delete">Borrar tipo de habitación
                    <i class="material-icons right">delete_forever</i>
                </button>
            </form>
        </br>
        </div>
    </br>
    <div class="fondoAcerca">
        <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
        <section>
            <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
            <p class="center"> <a href="./../admin/index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>
            <p class="center"> <a href="./select_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Volver a la busqueda de tipos de habitaciones </a> </p>  
        </section>
    </div>

</body>

<?php include('./../templates/footer.php'); ?>

</html>