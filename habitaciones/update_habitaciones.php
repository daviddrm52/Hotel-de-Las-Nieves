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

    if (isset($_POST['submit'])) {
        $tipoHabitacion = $_POST['tipo_habitacion'];
        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];
        $cerrada = $_POST['cerrada'];
        $descripcion = $_POST['descripcion'];
        $observaciones = $_POST['observaciones'];
    }

    //Query de la base de datos ver los tipos de habitacion que hay y el estado de las habitaciones
    $selectEstado = "SELECT id, estado FROM 73_estado_habitacion";
    $selectTipoHabitacion = "SELECT id, nombre, codigo, fotos FROM 73_tipusHabitacio";


    //Lanzamos la query y capturamos los resultados
    $resultadosEstado = mysqli_query($conn, $selectEstado);
    $resultadosTipoHabitacion = mysqli_query($conn, $selectTipoHabitacion);

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
        } else {
            $nombre = $_POST['nombre'];
            if(!preg_match('/^([a-zA-z\s]+)(\s*[a-zA-z\s]*)*$/', $nombre)) {
                $errores['nombre'] = '¡El nombre debe solo contener letras sin espacios!';
            }
        }
        if(empty($_POST['descripcion'])) {
            $errores['descripcion'] = 'La descripcion es obligatoria';
        }
        if(empty($_POST['observaciones'])) {
            $errores['observaciones'] = 'La observacion es obligatoria';
        } else {
            $observaciones = $_POST['observaciones'];
            if(!preg_match('/^([a-zA-z\s]+)(\s*[a-zA-z\s]*)*$/', $observaciones)) {
                $errores['observaciones'] = '¡La observación tiene que tener numeros y letras con espacios!';
            }
        }
        if(!array_filter($errores)) {    
            //Evitar la injección de codigo malicioso a la bd
            $tipoHabitacion = mysqli_real_escape_string($conn, $_POST['tipo_habitacion']);
            $numero = mysqli_real_escape_string($conn, $_POST['numero']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
            $observaciones = mysqli_real_escape_string($conn, $_POST['observaciones']);
       
            $id_a_actualizar = mysqli_real_escape_string($conn, $_POST['id_a_actualizar']);

            //Construir la query 
            $queryUpdateHabitacion = "UPDATE 73_habitacio SET tipo_habitacion = '$tipoHabitacion', numero = '$numero', nombre = '$nombre', descripcion = '$descripcion', observaciones = '$observaciones' WHERE id = '$id_a_actualizar'";
    
            //Lanzamos la query
            if(mysqli_query($conn, $queryUpdateHabitacion)){
                //La cosa ha ido bien
                header('Location: select_habitaciones.php');
            } else {
                //La cosa ha fallado
                echo 'Error en la query: '. mysqli_error($conn);
            }
        }
    }
    
    //Comrpobar si llega la información
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //Query de selección
        $sqlUpdateHabitacion = "SELECT * FROM 73_habitacio WHERE id = $id";

        //Recuperamos los resultados
        $resultado = mysqli_query($conn, $sqlUpdateHabitacion);

        //Volcar los resultados en un array
        $habitacion = mysqli_fetch_assoc($resultado);

        //Liberar memoria
        mysqli_free_result($resultado);

        //Cerrar conexión con bd
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="es">
<title> Actualizar habitación - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<section>
    <form action="update_habitaciones.php" method="POST" class="white">
    <?php if($habitacion):?>
    <fieldset>
            <legend> Actualizar una habitación </legend>
            <label for="tipo_habitacion"> Tipo de habitación: </label>
            <select name="tipo_habitacion" class="browser-default">
                <?php while($vistaTipoHabitacion = mysqli_fetch_array($resultadosTipoHabitacion)){ ?>
                <option value="<?php  echo $vistaTipoHabitacion['id'] ?>" data-icon="<?php  echo $vistaTipoHabitacion['fotos'] ?>"><?php echo  $vistaTipoHabitacion['nombre'] ?> - <?php echo  $vistaTipoHabitacion['codigo'] ?> </option>
                <?php  }  ?>
            </select>            
            <div class="red-text"><?php echo htmlspecialchars($errores['tipo_habitacion'])?></div>
            <label for="numero"> Numero: </label>
            <input type="text" name="numero" value="<?php echo htmlspecialchars($habitacion['numero']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['numero'])?></div>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($habitacion['nombre']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['nombre'])?></div>
            <label for="cerrada"> Estado de la habitación: </label>
            <select name="cerrada" class="browser-default">
                <?php while($vistaEstado = mysqli_fetch_array($resultadosEstado)){ ?>
                <option value="<?php  echo $vistaEstado['id'] ?>"> <?php echo  $vistaEstado['estado'] ?> </option>
                <?php  }  ?>
            </select>            
            <div class="red-text"><?php echo htmlspecialchars($errores['cerrada'])?></div>
            <label for="descripcion"> Descripción: </label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($habitacion['descripcion']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['descripcion'])?></div>
            <label for="observaciones"> Observaciones: </label>
            <input type="text" name="observaciones" value="<?php echo htmlspecialchars($habitacion['observaciones']) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['observaciones'])?></div>
            <?php endif; ?>
            <input type="hidden" name="id_a_actualizar" value="<?php echo $habitacion['id']?>">    
            <div class="center">
                <!--<input type="submit" name="submit" value="Enviar" class="btn brand z-depth-0">-->
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Actualizar habitación
                    <i class="material-icons right">update</i>
                </button>
            </div>
        </fieldset>
    </form>
</section>
<div class="fondoAcerca">
    <section>
        <p class="center"> <a href="./../admin/index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Cancelar y volver al inicio de administración </a> </p>
        <p class="center"> <a href="./select_habitaciones.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Cancelar y buscar las habitaciones </a> </p>
    </section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });
</script>

</html>

