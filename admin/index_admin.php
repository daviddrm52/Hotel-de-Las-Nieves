<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<!DOCTYPE html>
<html lang="es">
<title> Inicio administración - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<?php 
    $idCliente = '';
    
    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Query de la base de datos para recuperar los tipos de habitaci
    $sql = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

    //Lanzamos la query y capturamos los resultados
    $resultados = mysqli_query($conn, $sql);

    $informacionAdmin = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerramos conexión
    mysqli_close($conn);

?>

<div class = "fondoAdministracion">
    <div class="center white-text"> 
        <h3> Bienvenido al area de Administración </h3> 
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
           <span class="brown-text darken-4-text "> <h4> Mensaje de administración </h4> </span> 
        </div>
        <section>
            <p> Aqui podra interactuar con las habitaciones, tipos de habitación, reservas y usuarios.</p>
            <p> Los botones deshabilitados estan asi debido a que un administrador no puede borrar, añadir o actualizar reservas y usuarios.</p>
            <p> Solo puede hacerlo el usuario.</p>
            <p> En las habitaciones y tipo de habitación, los botones deshabilitados se tiene que acceder desde la busqueda, para poder seleccionar un registro en especifico.</p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
           <span class="brown-text darken-4-text "> <h4> Tipos de habitación </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./../tipoHabitacion/form_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Añadir un tipo de habitación </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../tipoHabitacion/select_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar los tipos de habitación </a></p>
        </section >
        <section>
            <p class="center"> <a href="./../tipoHabitacion/delete_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">delete</i> Eliminar un tipo de habitación </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../tipoHabitacion/update_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">update</i> Actualizar un tipo de habitación </a></p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
            <span class="brown-text darken-4-text "> <h4> Habitaciones </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./../habitaciones/form_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Añadir una habitación </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../habitaciones/select_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar las habitaciones </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../habitaciones/delete_habitaciones.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">delete</i> Eliminar una habitación </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../habitaciones/update_habitaciones.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">update</i> Actualizar una habitación </a></p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
            <span class="brown-text darken-4-text "> <h4> Reservas </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./../reservas/select_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar todas las reservas del hotel </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../reservas/select_check_in_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en check-in </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../reservas/select_check_out_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en check-out </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../reservas/select_noshow_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas en no-show (No presentado) </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../reservas/select_canceled_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas canceladas </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../reservas/select_terminated_reservas.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar reservas finalizadas </a></p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
            <span class="brown-text darken-4-text "> <h4> Clientes </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./../clientes/signup_cliente.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">add</i> Añadir un cliente de prueba </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../clientes/select_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar los clientes actuales </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../clientes/delete_cliente.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">delete</i> Eliminar un cliente inactivo </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../clientes/update_cliente.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">update</i> Actualizar un cliente </a></p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
            <span class="brown-text darken-4-text "> <h4> Administradores </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./signup_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i> Añadir un administrador </a></p>
        </section>
        <section>
            <p class="center"> <a href="./select_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Buscar los administradores actuales </a></p>
        </section>
        <section>
            <p class="center"> <a href="./delete_admin.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">delete</i> Eliminar un administrador antiguo </a></p>
        </section>
        <section>
            <p class="center"> <a href="./update_admin.php" class="waves-effect waves-light brown darken-4 btn disabled"><i class="material-icons left">update</i> Actualizar un administrador </a></p>
        </section>
    </div>
    <br>
    <div class="fondoHabitacion">
        <div class="center"> 
            <span class="brown-text darken-4-text "> <h4> Manuales de información (en evolución) </h4> </span> 
        </div>
        <section>
            <p class="center"> <a href="./../documentacion/manualTecnicoDavidRuedaMadrid.pdf" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">book</i> Ver manual tecnico de la pagina </a></p>
        </section>
        <section>
            <p class="center"> <a href="./../documentacion/manualUsuarioDavidRuedaMadrid.pdf" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">book</i> Ver manual de usuario de la pagina </a></p>
        </section>
    </div>
    <br>
    <?php foreach($informacionAdmin as $admin):?>
    <div class="center fondoHabitacion"> 
        <?php 
            if(empty($_SESSION["id"])){
                
            } else {
                ?>
                <span class="brown-text darken-4-text "> <h5> Bienvenido <?php echo $admin["nombre"];?> <?php echo $admin["apellido_primero"];?> <?php echo $admin["apellido_segundo"];?> </h5> </span> 
                ¿Quiere cerrar su sesión?  <a href="./../config/logout.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">close</i> Cerrar sesión </a>
            <?php
            }
        ?>
        </div>
        <br>
    </div>
    <?php endforeach; ?>
</div>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
