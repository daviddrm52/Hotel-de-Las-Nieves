<?php session_start(); ?>

<?php 
if(empty($_SESSION["id"])){
    header('Location: ./../clientes/login_cliente.php');
} else {

}
    //Hacemos la conexion
    include('./../config/config_bd.php');

    $errores = array('entrada' => '', 'salida' => '', 'pension_id' => '', 'habitacion_id' => '');

    $clienteID='';
    $entrada='';
    $salida='';
    $habitacionID='';
    $estadoReserva=''; 
    $noches='';
    $precio='';
    $pensionID='';
    $tipoHabitacion='';

    //Query de la base de datos ver las pensiones que hay
    $selectPension = "SELECT id, nombre_corto, nombre_largo FROM 73_pension";

    //Query de la base de datos ver los tipos de habitacion que hay
    $selectHabitacion = "SELECT id, numero, nombre FROM 73_habitacio  WHERE cerrada = '1'";

    //Lanzamos la query y capturamos los resultados
    $resultadosPension = mysqli_query($conn, $selectPension);
    $resultadosSelectHabitacion = mysqli_query($conn, $selectHabitacion);
    

    if (isset($_POST['submit'])) {
        if(empty($_POST['entrada'])) {
            $errores['entrada'] = 'Debe de escoger una fecha de entrada!';
        }
        if(empty($_POST['salida'])) {
            $errores['salida'] = 'Debe de escoger una fecha de salida!';
        }
        if(empty($_POST['pension_id'])) {
            $errores['pension_id'] = 'Debe de escoger un tipo de pensión!';
        }
        if(empty($_POST['habitacion_id'])) {
            $errores['habitacion_id'] = 'No hay habitaciones libres, contacte con el hotel para saber más información.';
        }
        if(!array_filter($errores)) {    
            //Evitar la injección de codigo malicioso a la bd
            $entrada = mysqli_real_escape_string($conn, $_POST['entrada']);
            $salida = mysqli_real_escape_string($conn, $_POST['salida']);
            $pension = mysqli_real_escape_string($conn, $_POST['pension_id']);
            $habitacionID = mysqli_real_escape_string($conn, $_POST['habitacion_id']);
       
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
                        
            $sql = "INSERT INTO 73_reservas (cliente_id,entrada,salida,tipoHabitacion_id,estado_id,noches,precio,pension_id,habitacion_id) 
            VALUES('$clienteID', '$entrada', '$salida', '$tipoHabitacion','$estadoReserva', '$noches', '$precioFinal', '$pensionID', '$habitacion')";
            if(mysqli_query($conn, $sql)){ 
                //Query de la base de datos para actualizar la habitacion cuando se haya realizado la reserva
                $updateHabitacionReserva = "UPDATE 73_habitacio SET cerrada = '2' WHERE id = $habitacion";
                //Lanzamos la query y capturamos los resultados
                $resultadosHabitacionReserva = mysqli_query($conn, $updateHabitacionReserva);

                header('Location: ./confirmacion_reserva.php');
            }else{ 
                $errorQuery='Error a la query: ' . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<title> Realizar reserva - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<section>
    <form action="form_reservas.php" method="POST" class="white">
        <fieldset>
            <legend>  <b> Reservar una habitación </b>  </legend>
            <label for="entrada">Fecha de entrada:</label>
            <input type="text" name="entrada" class="datepicker">   
            <div class="red-text"><?php echo htmlspecialchars($errores['entrada'])?></div>
            <br>
            <label for="entrada">Fecha de salida:</label>
            <input type="text" name="salida" class="datepicker"> 
            <div class="red-text"><?php echo htmlspecialchars($errores['salida'])?></div>
            <br>
            <label for="pension_id"> Tipo de pensión:  </label>                       
            <select name="pension_id" class="browser-default">
                <option selected="selected"> </option>
                <?php while($vistaPension = mysqli_fetch_array($resultadosPension)){ ?>
                <option value="<?php  echo $vistaPension['id'] ?>"><?php echo  $vistaPension['nombre_corto'] ?> - <?php echo  $vistaPension['nombre_largo'] ?> </option>
                <?php  }  ?>
            </select>
            <div class="red-text"><?php echo htmlspecialchars($errores['pension_id'])?></div>
            <br>
            <label for="habitacion_id"> Seleccione una habitación:  </label>
            <select name="habitacion_id" class="browser-default">
                <option selected="selected"> </option>
                <?php while($vistaHabitacion = mysqli_fetch_array($resultadosSelectHabitacion)){ ?>
                <option value="<?php echo $vistaHabitacion['id'] ?>"> <?php echo $vistaHabitacion['numero']?> - <?php echo $vistaHabitacion['nombre']?> </option>
                <?php  }  ?>
            </select>
            <div class="red-text center"><?php echo htmlspecialchars($errores['habitacion_id'])?></div>
            <br>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Realizar reserva
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