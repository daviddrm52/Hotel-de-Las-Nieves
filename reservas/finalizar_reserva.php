<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php 
    $mensajeError="";

    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(isset($_POST['finalizar'])){
        $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);

        //Creamos la query
        $queryfinalizar = "UPDATE 73_reservas SET estado_id = 6 WHERE id = '$id_a_actualizar'";

        //Creamos la query de certificacion de la reserva
        $queryResultadosfinalizar = "SELECT * FROM 73_reservas WHERE id = '$id_a_actualizar'";
 
        $resultadosfinalizar = mysqli_query($conn, $queryResultadosfinalizar);
        
        $confirmacionfinalizar = mysqli_fetch_array($resultadosfinalizar);
        
        $reservaConfirma = $confirmacionfinalizar['estado_id'];      
                        //Query de la base de datos para actualizar la habitacion cuando se haya realizado la reserva
                        $updateHabitacionReserva = "UPDATE 73_habitacio SET cerrada = 1 WHERE id = '$id_a_actualizar'";
                        //Lanzamos la query y capturamos los resultados
                        $resultadosHabitacionReserva = mysqli_query($conn, $updateHabitacionReserva);
            //Lanzamos la query
            if(mysqli_query($conn, $queryfinalizar)){

                //La cosa ha ido bien
                header('Location: ./../clientes/select_reserva_cliente.php');
            } else {
                //La cosa ha fallado
                echo 'Error en la query: '. mysqli_error($conn);
            }
    }

    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlfinalizar = "SELECT * FROM 73_reservas WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlfinalizar);

        //Volcar los resultados en un array
        $reserva = mysqli_fetch_array($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        //mysqli_close($conn);
    }

    //Querys para poder conseguir los datos que nos interesan, y no las id
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
<title> Finalización de la reserva - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<br>

<div class="container center white fondoInicio">
    <h4> <i class="material-icons">info_outline</i> Información de su reserva <?php echo htmlspecialchars($reserva['id']) ?> </h4>
    <div class="container white center">
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
                    <td> <?php echo htmlspecialchars($reserva['noches']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Precio de la reserva</b> </td>
                    <td> <?php echo htmlspecialchars($reserva['precio']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Pensión seleccionada</b> </td>
                    <td> <?php echo htmlspecialchars($Pension['nombre_largo']) ?> </td>
                </tr>
                <tr>
                    <td> <b>Habitación en la que esta alojado el cliente</b> </td>
                    <td> <?php echo htmlspecialchars($Habitacion['numero']) ?> </td>
                </tr>
            </table>
            <?php endif; ?>
            <h5>Cuando finalice la reserva, recibira en su correo un cuestionario de como ha sido su experiencia</h5>
            <p class="red-text"> <i class="material-icons tiny">warning</i> Recuerde, una vez finalizada la reserva, no podra realizar reclamaciones.</p>
            <h5>Gracias por visitar el Hotel de Las Nieves. </h5>
            <form action="finalizar_reserva.php" method="POST">
                <input type="hidden" name="id_a_actualizar" value="<?php echo $reserva['id']?>">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="finalizar">Finalizar reserva
                    <i class="material-icons right">check</i>
                </button>
            </form>
        </div>
    </div>
    <br>
        <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
                <p class="center"> <a href="./../clientes/index_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a su inicio personal </a> </p>
                <p class="center"> <a href="./../clientes/select_reserva_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a la busqueda de reservas a su nombre </a> </p>  
            </section>
        </div>
    </br>
    <?php include('./../templates/footer.php'); ?>

</html>