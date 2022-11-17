<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php 
    //Hacemos la conexion
    include('./../config/config_bd.php');

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlDeleteReserva = "SELECT * FROM 73_reservas WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlDeleteReserva);

        //Volcar los resultados en un array
        $reserva = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        //mysqli_close($conn);
    }

    //Variables para las querys
    $idCliente = $reserva['cliente_id'];
    $idTipoHabitacion = $reserva['tipoHabitacion_id'];
    $idEstadoReserva = $reserva['estado_id'];
    $idPension = $reserva['pension_id'];
    $idHabitacion = $reserva['habitacion_id'];

    //Querys para cambiar los id de los textos, a su valor que interesa, nombres, fechas, etc.
    $sqlSelectCliente = "SELECT * FROM 73_clientes WHERE id = $idCliente";
    $sqlSelectTipoHabitacion = "SELECT * FROM 73_tipusHabitacio WHERE id = $idTipoHabitacion";
    $sqlSelectEstado = "SELECT * FROM 73_estado_reserva WHERE id = $idEstadoReserva";
    $sqlSelectPension = "SELECT * FROM 73_pension WHERE id = $idPension";
    $sqlSelectHabitacion = "SELECT * FROM 73_habitacio WHERE id = $idHabitacion";

    //Lanzamos la query y capturamos los resultados
    $resultadoSelectCliente = mysqli_query($conn, $sqlSelectCliente);
    $resultadoSelectTipoHabitacion = mysqli_query($conn, $sqlSelectTipoHabitacion);
    $resultadoSelectEstado = mysqli_query($conn, $sqlSelectEstado);
    $resultadoSelectPension = mysqli_query($conn, $sqlSelectPension);
    $resultadoSelectHabitacion = mysqli_query($conn, $sqlSelectHabitacion);

    //Volcar los resultados en un array
    $nombreCliente = mysqli_fetch_assoc($resultadoSelectCliente);    
    $tipoHabitacion = mysqli_fetch_assoc($resultadoSelectTipoHabitacion);
    $EstadoReserva = mysqli_fetch_assoc($resultadoSelectEstado);
    $Pension = mysqli_fetch_assoc($resultadoSelectPension);
    $Habitacion = mysqli_fetch_assoc($resultadoSelectHabitacion);

?>

<!DOCTYPE html>
<html lang="es">
<title> Información de la reserva - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>
<div class="container center fondoInicio">
    <h4> <i class="material-icons">info_outline</i> Información de la reserva <?php echo htmlspecialchars($reserva['id']) ?> </h4>
    <div class="container center">
        <?php if($reserva):?>
            <table>
                <tr>
                    <td> <b>Nombre de usuario del cliente de la reserva</b> </td>
                    <td> <?php echo htmlspecialchars($nombreCliente['usuario']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Fecha de entrada</b> </td>
                    <td> <?php echo htmlspecialchars($reserva['entrada']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Fecha de salida</b> </td>
                    <td> <?php echo htmlspecialchars($reserva['salida']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Tipo de habitación</b> </td>
                    <td> <?php echo htmlspecialchars($tipoHabitacion['nombre']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Estado de la reserva</b> </td>
                    <td> <?php echo htmlspecialchars($EstadoReserva['nombre'])?> - <?php echo htmlspecialchars($EstadoReserva['descripcion'])?></td>
                </tr>
                <tr>
                    <td> <b>Noches</b> </td>
                    <td> <?php echo htmlspecialchars($reserva['noches']) ?> noches</td>
                </tr>
                <tr>
                    <td> <b>Precio de la reserva</b> </td>
                    <td> <?php echo htmlspecialchars($reserva['precio']) ?> €</td>
                </tr>
                <tr>
                    <td> <b>Pensión seleccionada</b> </td>
                    <td> <?php echo htmlspecialchars($Pension['nombre_largo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Habitación en la que esta alojado el cliente</b> </td>
                    <td> Habitación <?php echo htmlspecialchars($Habitacion['numero']) ?> - <?php echo htmlspecialchars($Habitacion['nombre']) ?></td>
                </tr>
            </table>
            <?php endif; ?>
        </div>
    </div>
    <br>
        <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a la pagina de inicio </a> </p>
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>