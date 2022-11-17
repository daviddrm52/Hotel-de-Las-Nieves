<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar los tipos de habitaci
    $sql = "SELECT * FROM 73_clientes WHERE tipo_id = 1";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $usuarios = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<title> Clientes activos - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>

<div class="center fondoInicio">
  <h5> Mostrando clientes activos </h5>
</div>

<br>

<table class="highlight white">
        <thead>
          <tr>
              <th>ID</th>
              <th>Nombre de usuario</th>
              <th>Nombre</th>
              <th>DNI</th>
              <th>Telefono</th>
              <th>Correo</th>
              <th>Información</th>
          </tr>
        </thead>
        <?php foreach($usuarios as $usuario): ?>
        <tbody>
        <tr>
          <td><?php echo htmlspecialchars($usuario['id'])?></td>
          <td><?php echo htmlspecialchars($usuario['usuario'])?></td>
          <td><?php echo htmlspecialchars($usuario['nombre'])?></td>
          <td><?php echo htmlspecialchars($usuario['dni'])?></td>
          <td><?php echo htmlspecialchars($usuario['telefono'])?></td>
          <td><?php echo htmlspecialchars($usuario['email'])?></td>
          <td><a href="detalles_cliente.php?id=<?php echo $usuario['id'] ?>">Información del cliente</a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>

      <br>

<div class="fondoAcerca center">
<?php if(count($usuarios) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($usuarios)?> cliente en el hotel.</h6> </p>
<?php elseif(count($usuarios) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($usuarios)?> clientes en el hotel.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay clientes en el hotel, espera a que se registren, o crea uno para probar si funciona el sistema. </h6> 
      <a href="./signup_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Crear usuario de prueba </a>
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
