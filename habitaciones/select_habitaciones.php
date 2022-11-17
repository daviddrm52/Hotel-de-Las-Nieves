<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar las habitaciones
    $sql = "SELECT id, numero, nombre, descripcion FROM 73_habitacio";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $habitaciones = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title>Busqueda de habitaciones - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<div class="center">

</div>

<div class="container">
    <div class="row">
        <?php foreach($habitaciones as $habitacion){ ?>
        <div class="col s6 md3">
            <div class="card z-depth-0">
                <div class="card-content center">
                    <h5>Habitación <?php echo htmlspecialchars($habitacion['numero']) ?></h5>
                    <h6>Nombre: <?php echo htmlspecialchars($habitacion['nombre']) ?></h6>
                    <h6>Descripción: <?php echo htmlspecialchars($habitacion['descripcion']) ?></h6>
                </div>
                <div class="card-action right-align">
                    <a href="detalles_habitaciones.php?id=<?php echo $habitacion['id'] ?>"><i class="material-icons left">info_outline</i> Más información </a>
                </div>
                <div class="card-action right-align">
                    <a href="delete_habitaciones.php?id=<?php echo $habitacion['id'] ?>"><i class="material-icons left">delete</i> Eliminar habitación </a>
                </div>
                <div class="card-action right-align">
                    <a href="update_habitaciones.php?id=<?php echo $habitacion['id'] ?>"> <i class="material-icons left">update</i> Actualizar habitación </a>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>

<div class="fondoAcerca center">
<?php if(count($habitaciones) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($habitaciones)?> habitación en el hotel.</h6> </p>
<?php elseif(count($habitaciones) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($habitaciones)?> habitaciones en el hotel.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay habitaciones en el hotel, crea uno aqui </h6> 
      <a href="./form_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Crear habitación </a>
    </p>
<?php endif; ?>
</div>

<br>

<div class="fondoAcerca">
    <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
    <section>
        <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
        <p class="center"> <a href="./../admin/index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio de administración </a> </p>  
    </section>
</div>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
