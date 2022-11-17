<?php session_start(); ?>

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
<title>Información de las reservas - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>

<div class="center fondoInicio">
<h4> Tipos de habitación que hay en el hotel </h4>
<p> Abajo podrá encontrar que habitaciones hay dentro del hotel. Si desea realizar una reserva, pulse abajo. </p>
<section>
    <p class="center"> <a href="./form_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add_box</i> Realizar una reserva </a></p>
</section>
</div>

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
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<div class="fondoAcerca">
    <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
    <section>
        <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
        <p class="center"> <a href="./../clientes/index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir a nuestra pagina de cliente </a> </p>  
    </section>
</div>

<!--<section class="center">
    <p class="white-text">Pagina en construcción, de momento, disfurta con musica del evento de Halloween 2021 del SCP: Secret Laboratory</p>
    <iframe width="740" height="360" src="https://www.youtube.com/embed/be5ZFB8Nnm0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</section>
<section>
    <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a la pagina de inicio </a></p>
</section>
<section>
    <p class="center"> <a href="./form_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add_box</i> Añadir una reserva </a></p>
</section> -->



<?php include('./../templates/footer.php'); ?>

</body>

</html>