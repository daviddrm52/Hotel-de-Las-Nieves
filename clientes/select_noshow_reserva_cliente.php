<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar las reservas a nombre del usuario
    $sql = "SELECT * FROM 73_reservas WHERE cliente_id = '".$_SESSION["id"]."' AND estado_id = '4'";

    //Query para tener la información del usuario
    $sqlUser = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);
    $resultadosUser = mysqli_query($conn, $sqlUser);

    $reservas = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
    $usuarios = mysqli_fetch_array($resultadosUser, MYSQLI_ASSOC);


    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title> Reservas en no-show - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>
 
<br>

<div class="center fondoInicio">
  <h5> Mostrando reservas en no-show de <?php echo $usuarios['nombre']; ?> </h5>
</div>

<br>

<table class="highlight white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Noches</th>
            <th>Precio</th>
            <th>Cancelar</th>
            <th>Información</th>
        </tr>
    </thead>
    <?php foreach($reservas as $rev): ?>
    <tbody>
        <tr>
            <td><?php echo htmlspecialchars($rev['id'])?></td>
            <td><?php echo htmlspecialchars($rev['entrada'])?></td>
            <td><?php echo htmlspecialchars($rev['salida'])?></td>
            <td><?php echo htmlspecialchars($rev['noches'])?></td>
            <td><?php echo htmlspecialchars($rev['precio'])?>€</td>
            <td><a href="./../reservas/delete_reservas.php?id=<?php echo $rev['id'] ?>">Cancelar reserva</a></td>
            <td><a href="./../reservas/detalles_reserva.php?id=<?php echo $rev['id'] ?>">Información de la reserva</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br>

<div class="fondoAcerca center">
<?php if(count($reservas) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($reservas)?> reserva en no-show a su nombre.</h6> </p>
<?php elseif(count($reservas) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($reservas)?> reservas en no-show a su nombre.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay reservas en no-show a su nombre. </h6> 
    </p>
<?php endif; ?>
</div>

<br>

<div class="fondoAcerca">
  <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
  <section>
    <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
    <p class="center"> <a href="./index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver al inicio personal </a> </p>
    <p class="center"> <a href="./select_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a la administración de nuestras reservas </a> </p>  
</section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
