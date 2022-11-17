<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<!DOCTYPE html>
<html lang="es">
<title> Inicio cliente - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<?php 
    $idCliente = '';
    
    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar los tipos de habitaci
    $sql = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $informacionCliente = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<div class = "fondoCliente">
    <div class="center white-text"> 
        <h3> Bienvenido al inicio del cliente </h3> 
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
           <span class="brown-text darken-4-text "> <h4> Mensaje de administración </h4> </span> 
        </div>
        <section>
            <p> Bienvenido, esperamos que tenga una estancia agradable en el Hotel de Las Nieves</p>
            <p> Desde esta pagina podra ver los detalles de su usuario, actualizar sus datos, o en caso de no volver, eliminar su cuenta.</p>
            <p> Aqui tambien podrá realizar nuevas reservas, ver sus reservas activas, actualizar los datos de su reserva, o en caso de no poder acudir a una reserva, cancelarla. </p>
        </section>
    </div>
    <?php foreach($informacionCliente as $cliente) { ?>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
           <span class="brown-text darken-4-text "> <h4> Administración de nuestro usuario </h4> </span> 
        </div>
        <section class="boton">
            <p class="center"> <a href="./detalles_cliente.php?id=<?php echo $cliente["id"];?>" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">info_outline</i> Detalles de nuestra cuenta </a></p>
        </section >
        <section class="boton">
            <p class="center"> <a href="./update_cliente.php?id=<?php echo $cliente["id"];?>" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">edit</i> Actualizar nuestra cuenta </a></p>
        </section >
        <section class="boton">
            <p class="center"> <a href="./delete_cliente.php?id=<?php echo $cliente["id"];?>" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">delete</i> Eliminar nuestra cuenta </a></p>
        </section >
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
           <span class="brown-text darken-4-text "> <h4> Administración de reservas </h4> </span> 
        </div>
        <section class="boton">
            <p class="center"> <a href="./select_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">info_outline</i> Administrar nuestras reservas</a></p>
        </section >
    </div>
    <br>
    <div class="fondoHabitacion">
    <div class="center"> 
        <?php 
            if(empty($_SESSION["id"])){
                
            } else {
                ?>
                <span class="brown-text darken-4-text "> <h5> Bienvenido <?php echo $cliente["nombre"];?> <?php echo $cliente["apellido_primero"];?> <?php echo $cliente["apellido_segundo"];?> </h5> </span> 
                ¿Quiere cerrar su sesión?  <a href="./../config/logout.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">close</i> Cerrar sesión </a>
            <?php
            }
        ?>
        </div>
    </div>
    <?php } ?>
    <br>
</div>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
