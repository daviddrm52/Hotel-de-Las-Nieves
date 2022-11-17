<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    $errores = array('tipo_habitacion' => '', 'numero' => '', 'nombre' => '', 'cerrada' => '', 'descripcion' => '', 'observaciones' => '');

    $tipoHabitacion='';
    $numero=''; 
    $nombre='';
    $cerrada='';
    $descripcion='';
    $observaciones='';

    //Query de la base de datos ver los tipos de habitacion que hay y el estado de las habitaciones
    $selectEstado = "SELECT id, estado FROM 73_estado_habitacion";
    $selectQueHabitacionEstar = "SELECT id, nombre, codigo FROM 73_tipusHabitacio";


    //Lanzamos la query y capturamos los resultados
    $resultadosEstado = mysqli_query($conn, $selectEstado);
    $resultadosQueHabitacionEstar = mysqli_query($conn, $selectQueHabitacionEstar);


    if (isset($_POST['submit'])) {
        $tipoHabitacion = $_POST['tipo_habitacion'];
        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];
        $cerrada = $_POST['cerrada'];
        $descripcion = $_POST['descripcion'];
        $observaciones = $_POST['observaciones'];
    }

    if (isset($_POST['submit'])) {

        if(empty($_POST['tipo_habitacion'])) {
            $errores['tipo_habitacion'] = 'El tipo de habitación es obligatorio';
        } else {
            $tipoHabitacion = $_POST['tipo_habitacion'];
            if(!preg_match('/^[0-9A-Z]+$/', $tipoHabitacion)) {
                $errores['tipo_habitacion'] = '¡El tipo de habitación debe contener letras y numeros!';
            }
        }
        if(empty($_POST['numero'])) {
            $errores['numero'] = 'El numero es obligatorio';
        } else {
            $numero = $_POST['numero'];
            if(!preg_match('/^[0-9]+$/', $numero)) {
                $errores['numero'] = '¡El numero solo puede contener numeros!';
            }
        }
        if(empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio';
        }
        if(empty($_POST['descripcion'])) {
            $errores['descripcion'] = 'La descripcion es obligatoria';
        }
        if(empty($_POST['observaciones'])) {
            $errores['observaciones'] = 'La observacion es obligatoria';
        }
        if(!array_filter($errores)) {    
            //Evitar la injección de codigo malicioso a la bd
            $tipoHabitacion = mysqli_real_escape_string($conn, $_POST['tipo_habitacion']);
            $numero = mysqli_real_escape_string($conn, $_POST['numero']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
            $observaciones = mysqli_real_escape_string($conn, $_POST['observaciones']);
       
            //Construir la query 
            $sql = "INSERT INTO 73_habitacio (tipo_habitacion,numero,nombre,cerrada,descripcion,observaciones) VALUES('$tipoHabitacion', '$numero', '$nombre', '$cerrada','$descripcion','$observaciones')";
    
            //Ara guardarem les dades a la bd i comprovarem si ha anat bé.
            if(mysqli_query($conn, $sql)): 
                header('Location: select_habitaciones.php');
            else: 
                echo 'Error a la query: ' . mysqli_error($conn);
            endif;
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<title>Añadir una habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<section>
    <form action="form_habitaciones.php" method="POST" class="white">
        <fieldset>
            <legend> Crear una habitación </legend>
            <label for="tipo_habitacion"> Tipo de habitación: </label>
            <select name="tipo_habitacion" class="browser-default">
                <option selected="selected"> </option>
                <?php while($vistaTipoHabitacion = mysqli_fetch_array($resultadosQueHabitacionEstar)){ ?>
                <option value="<?php  echo $vistaTipoHabitacion['id'] ?>"><?php echo  $vistaTipoHabitacion['nombre'] ?> - <?php echo  $vistaTipoHabitacion['codigo'] ?> </option>
                <?php  }  ?>
            </select>            
            <div class="red-text"><?php echo htmlspecialchars($errores['tipo_habitacion'])?></div>
            <label for="numero"> Numero: </label>
            <input type="text" name="numero" value="<?php echo htmlspecialchars($numero) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['numero'])?></div>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['nombre'])?></div>
            <label for="cerrada"> Estado de la habitación: </label>
            <select name="cerrada" class="browser-default">
                <option selected="selected"> </option>
                <?php while($vistaEstado = mysqli_fetch_array($resultadosEstado)){ ?>
                <option value="<?php  echo $vistaEstado['id'] ?>"> <?php echo  $vistaEstado['estado'] ?> </option>
                <?php  }  ?>
            </select>            
            <div class="red-text"><?php echo htmlspecialchars($errores['cerrada'])?></div>
            <label for="descripcion"> Descripción: </label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($descripcion) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['descripcion'])?></div>
            <label for="observaciones"> Observaciones: </label>
            <input type="text" name="observaciones" value="<?php echo htmlspecialchars($observaciones) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['observaciones'])?></div>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </fieldset>
    </form>
</section>
<div class="fondoAcerca">
        <section>
        <p class="center"> <a href="./../index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Cancelar y volver al inicio de administración </a> </p>
        <p class="center"> <a href="./select_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Cancelar y buscar habitaciones </a> </p>
    </section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>
</html>