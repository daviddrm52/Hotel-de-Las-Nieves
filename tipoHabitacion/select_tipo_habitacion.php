<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar los tipos de habitación
    $sql = "SELECT id, nombre, descripcion, fotos FROM 73_tipushabitacio";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $tiposHabitacion = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title>Busqueda de tipos de habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<div class="container">
<div class="row">
    <?php foreach($tiposHabitacion as $tipo){ ?>
    <div class="col s12 m7">
      <div class="card">
        <div class="card-image">
          <img src="<?php echo htmlspecialchars($tipo['fotos'])?>">
          <span class="card-title"><?php echo htmlspecialchars($tipo['nombre'])?></span>
        </div>
        <div class="card-content">
          <p><?php echo htmlspecialchars($tipo['descripcion'])?></p>
        </div>
        <div class="card-action">
            <a href="detalles_tipo_habitacion.php?id=<?php echo $tipo['id'] ?>"> <i class="material-icons left">info_outline</i> Más información </a>
        </div>
        <div class="card-action">
            <a href="delete_tipo_habitacion.php?id=<?php echo $tipo['id'] ?>"> <i class="material-icons left">delete</i> Eliminar tipo de habitación </a>
        </div>
        <div class="card-action">
            <a href="update_tipo_habitacion.php?id=<?php echo $tipo['id'] ?>"> <i class="material-icons left">update</i> Actualizar tipo de habitación </a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<div class="fondoAcerca center">
<?php if(count($tiposHabitacion) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($tiposHabitacion)?> tipo de habitación en el hotel.</h6> </p>
<?php elseif(count($tiposHabitacion) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($tiposHabitacion)?> tipos de habitación en el hotel.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay tipos de habitación en el hotel, crea uno aqui </h6> 
      <a href="./form_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Crear tipo de habitación </a>
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
