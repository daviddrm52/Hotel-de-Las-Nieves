<?php session_start(); ?>

<?php include_once('./../config/verifica_registrado.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    $entrada='';
    $salida='';
    $habitacionID='';
    $noches='';
    $precio='';
    $pensionID='';
    $tipoHabitacion='';
    //$updateReserva='';
    
    //Query de la base de datos ver las pensiones que hay
    $selectPension = "SELECT id, nombre_corto, nombre_largo FROM 73_pension";

    //Query de la base de datos ver los tipos de habitacion que hay
    $selectHabitacion = "SELECT id, tipo_habitacion, numero, nombre FROM 73_habitacio WHERE cerrada = '1'";

    //Lanzamos la query y capturamos los resultados
    $resultadosPension = mysqli_query($conn, $selectPension);
    $resultadosHabitacion = mysqli_query($conn, $selectHabitacion);


    if (isset($_POST['update'])) {
            //Cliente
            $clienteID = $_SESSION["id"];
            
            //Entrada y salida
            $entrada = htmlspecialchars($_POST['entrada']);
            $salida = htmlspecialchars($_POST['salida']);
            
            //Pensiones
            $preciosPensiones = ["0","0","15","25","60","120"];
            $pensionID = htmlspecialchars($_POST['pension_id']);
            
            //Habitacion
            $habitacionID = $_POST['habitacion_id']; 
            
            //Estado de la reserva
            $estadoReserva = 1;
            
            //Calculo de noches
            $fechaEntrada = new DateTime($entrada);
            $fechaSalida = new DateTime($salida);
            $stallDate = $fechaEntrada->diff($fechaSalida);
            $noches = $stallDate->days;

            //Tipo de habitacion
            $tipoHabitacionBD = $_POST['habitacion_id'];

            //Query de la base de datos ver los tipos de habitacion que hay
            $busquedaTipoHabitacion = "SELECT id, tipo_habitacion FROM 73_habitacio";

            //Lanzamos la query y capturamos los resultados
            $resultadosBusquedaTipoHabitacion = mysqli_query($conn, $busquedaTipoHabitacion);

            //Recogemos los resultados y los metemos en un array
            $vistaBusquedaTipoHabitacion = mysqli_fetch_array($resultadosBusquedaTipoHabitacion);

            //Ponemos en una variable el tipo de habitacion que usamos
            $tipoHabitacionID=$vistaBusquedaTipoHabitacion['tipo_habitacion'];

            //list($precio, $habitacionID) = explode(',', $vistaTipoHabitacion['precio']); 
            $precio = $vistaTipoHabitacion['precio'];

            //Calculo del precio final
            $precioFinal = ($noches * $precio) + $preciosPensiones[$pensionID];

            //Query para poder recoger el identificador de la habitacion
            $selectIdentificacionHabitacion="SELECT id FROM 73_habitacio WHERE id=$habitacionID";
            $resultadosHabitacion = mysqli_query($conn, $selectIdentificacionHabitacion);
            //Recogida de los resultados
            $recogidaHabitacion = mysqli_fetch_array($resultadosHabitacion);

            $habitacion = $recogidaHabitacion['id'];

            //Query para poder recoger el tipo de habitacion
            $selectIdentificacionTipoHabitacion="SELECT * FROM 73_tipusHabitacio WHERE id=$tipoHabitacionBD";
            $resultadosTipoHabitacionBD = mysqli_query($conn, $selectIdentificacionTipoHabitacion);
            //Recogida de los resultados
            $recogidaTipoHabitacionBD = mysqli_fetch_array($resultadosTipoHabitacionBD);

            $tipoHabitacion = $recogidaTipoHabitacionBD['id'];
    }
    
    if(isset($_POST['update'])){
        $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);

        $queryUpdateReserva = "UPDATE 73_reservas SET entrada = '$entrada', salida = '$salida', tipoHabitacion_id = '$tipoHabitacion', noches = '$noches', precio = '$precioFinal', pension_id = '$pensionID', habitacion_id = '$habitacion' WHERE id = '$id_a_actualizar)"; 

        //Lanzamos la query
        if(mysqli_query($conn, $queryUpdateReserva)){
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
        $sqlUpdateReserva = "SELECT * FROM 73_reservas WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlUpdateReserva);

        //Volcar los resultados en un array
        $updateReserva = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title> Actualizar reserva - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<section>
    <form action="update_reservas.php" method="POST" class="white">
        <?php if($updateReserva):?>
        <fieldset>
            <legend>  <b> Reservar una habitación </b>  </legend>
            <label for="entrada">Fecha de entrada:</label>
            <input type="text" name="entrada" class="datepicker" value="<?php echo htmlspecialchars($updateReserva['entrada']); ?>">   
            <br>
            <label for="entrada">Fecha de salida:</label>
            <input type="text" name="salida" class="datepicker" value="<?php echo htmlspecialchars($updateReserva['salida']); ?>""> 
            <br>
            <label for="pension_id"> Tipo de pensión:  </label>                       
            <select name="pension_id" class="browser-default">
                <?php while($vistaPension = mysqli_fetch_array($resultadosPension)){ ?>
                <option value="<?php  echo $vistaPension['id'] ?>"><?php echo  $vistaPension['nombre_corto'] ?> - <?php echo  $vistaPension['nombre_largo'] ?> </option>
                <?php  }  ?>
            </select>
            <br>
            <label for="habitacion_id"> Seleccione una habitación:  </label>
            <select name="habitacion_id" class="browser-default">
                <?php while($vistaHabitacion = mysqli_fetch_array($resultadosHabitacion)){ ?>
                <option value="<?php echo $vistaHabitacion['id'] ?>"> <?php echo $vistaHabitacion['numero']?> - <?php echo $vistaHabitacion['nombre']?> </option>
                <?php  }  ?>
            </select>
            <input type="hidden" name="id_a_actualizar" value="<?php echo $updateReserva['id']?>">    
            <?php endif; ?>
            <br>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="update">Actualizar reserva
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </fieldset>
    </form>
</section>

<div class="fondoAcerca">
        <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
        <section>
            <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Volver a la pagina de inicio </a> </p>
        </section>
    </div>

<?php include('./../templates/footer.php'); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {format: 'yyyy-mm-dd'});
  });
</script>

</body>


</html>