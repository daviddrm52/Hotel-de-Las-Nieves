<?php session_start(); ?>

<?php 
if(empty($_SESSION["id"])){ header('Location: ./../clientes/login_cliente.php'); }
else { }
?>

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

<!DOCTYPE html>
<html lang="es">
<title> Reserva confirmada - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>
 
<br>

<div class="center fondoInicio">
    <h4> ¡Enhorabuena, su reserva se ha realizado con exito!</h4>
    <?php foreach($informacionCliente as $cliente) { ?>
    <span class="brown-text darken-4-text "> <h5> Gracias <?php echo $cliente["nombre"];?> <?php echo $cliente["apellido_primero"];?> <?php echo $cliente["apellido_segundo"];?> por confiar en el Hotel de Las Nieves</h5> </span> 
    <?php } ?>
    <p> Puede consultar su reserva en su pagina de inicio personal </p>
    <p class="center"> <a href="./../clientes/index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir a la pagina personal de inicio </a> </p>

</div>

<div class="center fondoInicio">

<h4> Servicios disponibles en el Hotel de Las Nieves </h4>

<h5> Ahora que ha realizado su reserva, puede ver los servicios que le ofrecemos.*</h5>

<table>
    <tr>
        <td> <b>Wi-Fi</b> <i class="material-icons tiny">wifi</i> </td>
        <td> Conexión a Internet en todo el hotel</td>
    </tr>
    <tr>
        <td> <b>Televisión</b> <i class="material-icons tiny">tv</i> </td>
        <td> Televisión por cable en todas las habitaciones</td>
    </tr>
    <tr>
        <td> <b>Seguridad</b> <i class="material-icons tiny">security</i> </td>
        <td> Cajas fuertes en todas las habitaciones </td>
    </tr>
    <tr>
        <td> <b>Piscinas</b> <i class="material-icons tiny">pool</i> </td>
        <td> Piscinas para niños, jovenes y adultos</td>
    </tr>
    <tr>
        <td> <b>SPA</b> <i class="material-icons tiny">spa</i> </td>
        <td> SPA disponible de 10:00 a 20:00</td>
    </tr>
    <tr>
        <td> <b>Playas</b> <i class="material-icons tiny">beach_access</i> </td>
        <td> Transbordo a las playas de Ciudad Madera de 7:00 a 23:00</td>
    </tr>
    <tr>
        <td> <b>Lavanderia</b> <i class="material-icons tiny">local_laundry_service</i> </td>
        <td> Servicio de lavanderia disponible para los clientes</td>
    </tr>
    <tr>
        <td> <b>Sala de juegos</b> <i class="material-icons tiny">games</i> </td>
        <td> Zona de juegos para niños y jovenes </td>
    </tr>
    <tr>
        <td> <b>Restaurante</b> <i class="material-icons tiny">restaurant</i> </td>
        <td> Restaurante con buffet libre disponible todo el dia </td>
    </tr>
    <tr>
        <td> <b>Cafeteria</b> <i class="material-icons tiny">free_breakfast</i> </td>
        <td> Servicio de cafeteria todas las mañanas de 05:00 a 12:00 </td>
    </tr>
    <tr>
        <td> <b>Bares</b> <i class="material-icons tiny">local_bar</i> </td>
        <td> Bares de copas y discotecas cerca del hotel </td>
    </tr>
    <tr>
        <td> <b>Recuerdos</b> <i class="material-icons tiny">shopping_bag</i> </td>
        <td> Tienda de souvenirs y recuerdos del hotel y Ciudad Madera </td>
    </tr>
    <tr>
        <td> <b>Transporte</b> <i class="material-icons tiny">transfer_within_a_station</i> </td>
        <td> Bonos para el transporte publico de Ciudad Madera </td>
    </tr>
    <tr>
        <td> <b>Aviación</b> <i class="material-icons tiny">videogame_asset</i> </td>
        <td> Simulador de un Boeing 757-2AC donado por Air Chiquin Group. </td>
    </tr>
</table>

</div>

<div class="center fondoInicio">
    <p>* Algunos servicios no pueden estar disponibles, pregunte en recepción si desea saber su estado.</p>
</div>

<?php include('./../templates/footer.php'); ?>

</body>
</html>
