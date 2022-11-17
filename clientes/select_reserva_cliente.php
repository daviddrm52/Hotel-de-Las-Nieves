<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query para tener la información del usuario
    $sqlUser = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

    //Lanzamos la query y capturamos los resultados
    $resultadosUser = mysqli_query($conn, $sqlUser);

    $usuarios = mysqli_fetch_array($resultadosUser, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title> Menu de reservas - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>
 
<br>

<div class="center fondoInicio">
  <h5> Mostrando reservas de <?php echo $usuarios['nombre']?> <?php echo $usuarios['apellido_primero']?> <?php echo $usuarios['apellido_segundo']?>.</h5>
</div>

<br>

<div class="center fondoInicio">
  <table class="">
    <tr>
      <td> <b>Reservas confirmadas</b> </td>
      <td> <a href="./select_confirma_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas confirmadas</a> </td>
    </tr>
    <tr>
      <td> <i class="material-icons right">arrow_upward</i> </td>
    <td> Aqui podrá modificar sus reservas, para poder realizar el check-in, cancelarla, etc...</td>
    </tr>
    <tr>
      <td> <b>Reservas en check-in</b> </td>
      <td> <a href="./select_checkin_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en check-in</a> </td>
    </tr>
    <tr>
      <td> <b>Reservas en check-out</b> </td>
      <td> <a href="./select_checkout_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en check-out</a> </td>
    </tr>
    <tr>
      <td> <b>Reservas en no-show</b> </td>
      <td> <a href="./select_noshow_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en no-show</a> </td>
    </tr>
    <tr>
      <td> <b>Reservas canceladas</b> </td>
      <td> <a href="./select_canceladas_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas canceladas</a> </td>
    </tr>
    <tr>
      <td> <b>Reservas finalizadas</b> </td>
      <td> <a href="./select_finalizadas_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas finalizadas</a> </td>
    </tr>
  </table>
</div>

<br>

<div class="fondoAcerca">
  <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
  <section>
    <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
    <p class="center"> <a href="./index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio personal </a> </p>
  </section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
