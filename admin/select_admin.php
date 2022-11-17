<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar los tipos de habitaci
    $sql = "SELECT * FROM 73_clientes WHERE tipo_id = 2"; //2 es administrador

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
<title> Administradores activos - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>

<div class="center">
  <h5> Mostrando administradores activos </h5>
</div>

<br>

<table class="highlight white">
        <thead>
          <tr>
              <th>ID</th>
              <th>Nombre de usuario</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Actualizar</th>
              <th>Eliminar</th>
              <th>Información</th>
          </tr>
        </thead>
        <?php foreach($usuarios as $user): ?>
        <tbody>
        <tr>
          <td><?php echo htmlspecialchars($user['id'])?></td>
          <td><?php echo htmlspecialchars($user['usuario'])?></td>
          <td><?php echo htmlspecialchars($user['nombre'])?></td>
          <td><?php echo htmlspecialchars($user['email'])?></td>
          <td><a href="update_admin.php?id=<?php echo $user['id'] ?>">Actualizar administrador</a></td>
          <td><a href="delete_admin.php?id=<?php echo $user['id'] ?>">Eliminar administrador</a></td>
          <td><a href="detalles_admin.php?id=<?php echo $user['id'] ?>">Información del administrador</a></td>

        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
<br>
<div class="fondoAcerca center">
<?php if(count($usuarios) == 1) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($usuarios)?> administrador en el hotel.</h6> </p>
<?php elseif(count($usuarios) >= 2) : ?>
    <p class="center"> <h6>Hay un total de <?php echo count($usuarios)?> administradores en el hotel.</h6> </p>
<?php else :?>
    <p class="center"> 
      <h6>No hay administradores en el hotel, cosa que no puede ser posible, Raiden que has hecho!? </h6><br>
      <h6>Ve a crear un administrador nuevo por favor.</h6> 
      <a href="./signup_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Crear administrador </a>
    </p>
<?php endif; ?>
</div>

<div class="fondoAcerca center">
    <p>Bajo ningun concepto, no puede <b>ELIMINAR</b> todos los administradores.</p>
</div>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
