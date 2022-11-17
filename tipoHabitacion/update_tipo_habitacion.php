<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    $nombre='';
    $precio=''; 
    $descripcion='';
    $capacidad='';
    $codigo='';
    $fotos='';
    $extras='';

    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $capacidad = $_POST['capacidad'];
        $codigo = $_POST['codigo'];
        $fotos = $_POST['fotos'];
        $extras = $_POST['extras'];
    }

    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['submit'])){
        $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);

        //Creamos la query
        $queryUpdateTipoHabitacion = "UPDATE 73_tipushabitacio SET nombre = '$nombre', precio = '$precio', descripcion = '$descripcion', capacidad = '$capacidad', codigo = '$codigo', fotos = '$fotos', extras = '$extras' WHERE id = '$id_a_actualizar'";


        //Lanzamos la query
        if(mysqli_query($conn, $queryUpdateTipoHabitacion)){
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
        $sqlUpdateTipoHabitacion = "SELECT * FROM 73_tipushabitacio WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlUpdateTipoHabitacion);

        //Volcar los resultados en un array
        $tipoHabitacion = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title>Actualizar un tipo de habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<section>
    <form action="update_tipo_habitacion.php" method="POST" class="white">
    <?php if($tipoHabitacion):?>
    <fieldset>
            <legend> Actualizar un tipo de habitación </legend>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($tipoHabitacion['nombre']) ?>">
            <label for="precio"> Precio: </label>
            <input type="text" name="precio" value="<?php echo htmlspecialchars($tipoHabitacion['precio']) ?>">
            <label for="descripcion"> Descripción de la habitación: </label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($tipoHabitacion['descripcion']) ?>">
            <label for="capacidad"> Capacidad de la habitación: </label>
            <input type="text" name="capacidad" value="<?php echo htmlspecialchars($tipoHabitacion['capacidad']) ?>">
            <label for="codigo"> Codigo de la habitación: </label>
            <input type="text" name="codigo" value="<?php echo htmlspecialchars($tipoHabitacion['codigo'])?>">
            <label for="fotos"> Foto de la habitación: </label>
            <input type="text" name="fotos" value="<?php echo htmlspecialchars($tipoHabitacion['fotos'])?>">
            <label for="extras"> Extras de la habitación: </label>
            <input type="text" name="extras" value="<?php echo htmlspecialchars($tipoHabitacion['extras'])?>">
            <?php endif; ?>
            <input type="hidden" name="id_a_actualizar" value="<?php echo $tipoHabitacion['id']?>">    
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Actualizar tipo de habitación
                    <i class="material-icons right">update</i>
                </button>
            </div>
        </fieldset>
    </form>
</section>
<div class="fondoAcerca">
    <section>
        <p class="center"> <a href="./../admin/index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a></p>
        <p class="center"> <a href="./select_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Cancelar actualización y volver a la busqueda de tipos de habitación </a> </p>
    </section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>
</html>