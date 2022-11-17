<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar las reservas canceladas
    $sql = "SELECT * FROM `73_reservas` WHERE `estado_id` = '5'";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $reservas = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title> Mostrando reservas canceladas - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>

<div class="center fondoInicio">
  <h5> Mostrando todas las reservas que estan canceladas </h5>
</div>

<br>

<table class="highlight white">
        <thead>
          <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Entrada</th>
              <th>Salida</th>
              <th>Tipo de habitación</th>
              <th>Estado</th>
              <th>Noches</th>
              <th>Precio</th>
              <th>Pensión</th>
              <th>Habitación</th>
              <th>Información</th>
          </tr>
        </thead>
        <?php foreach($reservas as $rev): ?>
        <tbody>
        <tr>
          <td><?php echo htmlspecialchars($rev['id'])?></td>
          <td><?php echo htmlspecialchars($rev['cliente_id'])?></td>
          <td><?php echo htmlspecialchars($rev['entrada'])?></td>
          <td><?php echo htmlspecialchars($rev['salida'])?></td>
          <td><?php echo htmlspecialchars($rev['tipoHabitacion_id'])?></td>
          <td><?php echo htmlspecialchars($rev['estado_id'])?></td>
          <td><?php echo htmlspecialchars($rev['noches'])?></td>
          <td><?php echo htmlspecialchars($rev['precio'])?></td>
          <td><?php echo htmlspecialchars($rev['pension_id'])?></td>
          <td><?php echo htmlspecialchars($rev['habitacion_id'])?></td>
          <td><a href="detalles_reserva.php?id=<?php echo $rev['id'] ?>">Información de la reserva</a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
 <br>
 
<div class="fondoAcerca center">
<?php if(count($reservas) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($reservas)?> reserva canceladas.</h6> </p>
<?php elseif(count($reservas) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($reservas)?> reservas canceladas.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay reservas canceladas.</h6> 
    </p>
<?php endif; ?>
</div>

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
