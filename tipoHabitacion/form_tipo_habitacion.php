<?php session_start(); ?>

<?php include_once('./../config/verifica_admin.php'); ?>

<?php

    //Hacemos la conexion
    include('./../config/config_bd.php');

    $errores = array('nombre' => '', 'precio' => '', 'descripcion' => '', 'capacidad' => '', 'codigo' => '', 'fotos' => '', 'extras' => '');

    $nombre='';
    $precio=''; 
    $descripcion='';
    $capacidad='';
    $codigo='';
    $fotos='';
    $extras='';

    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $capacidad = $_POST['capacidad'];
        $codigo = $_POST['codigo'];
        $fotos = $_POST['fotos'];
        $extras = $_POST['extras'];
    }
    if (isset($_POST['submit'])) {

        if(empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio';
        }
        if(empty($_POST['precio'])) {
            $errores['precio'] = 'El precio es obligatorio';
        } else {
            $precio = $_POST['precio'];
            if(!preg_match('/^[0-9]+$/', $precio)) {
                $errores['precio'] = '¡El precio solo puede contener numeros!';
            }
        }
        if(empty($_POST['descripcion'])) {
            $errores['descripcion'] = 'La descripcion es obligatoria';
        }
        if(empty($_POST['capacidad'])) {
            $errores['capacidad'] = 'La capacidad es obligatoria';
        } else {
            $capacidad = $_POST['capacidad'];
            if(!preg_match('/^[0-9]+$/', $capacidad)) {
                $errores['capacidad'] = '¡La capacidad solo puede contener numeros!';
            }
        }
        if(empty($_POST['codigo'])) {
            $errores['codigo'] = 'El precio es obligatorio';
        } else {
            $codigo = $_POST['codigo'];
            if(!preg_match('/^[0-9a-zA-z]+$/', $codigo)) {
                $errores['codigo'] = '¡El codigo solo puede contener numeros y letras!';
            }
        }
        if(empty($_POST['fotos'])) {
            $errores['fotos'] = 'Las fotos son obligatorias';
        }
        if(empty($_POST['extras'])) {
            $errores['extras'] = 'Los extras son obligatorios';
        }
        if(!array_filter($errores)) {    
            //Evitar la injección de codigo malicioso a la bd
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $precio = mysqli_real_escape_string($conn, $_POST['precio']);
            $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
            $capacidad = mysqli_real_escape_string($conn, $_POST['capacidad']);
            $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
            $fotos = mysqli_real_escape_string($conn, $_POST['fotos']);
            $extras = mysqli_real_escape_string($conn, $_POST['extras']);
            
            //Construir la query 
            $sql = "INSERT INTO 73_tipushabitacio (nombre,precio,descripcion,capacidad,codigo,fotos,extras) VALUES('$nombre','$precio','$descripcion','$capacidad','$codigo','$fotos','$extras')";
    
            //Ara guardarem les dades a la bd i comprovarem si ha anat bé.
            if(mysqli_query($conn, $sql)): 
                header('Location: select_tipo_habitacion.php');
            else: 
                echo 'Error a la query: ' . mysqli_error($conn);
            endif;
        }
    }


?>

<!DOCTYPE html>
<html lang="es">
<title>Añadir un tipo de habitación - Hotel de Las Nieves</title>

<?php include('./../templates/header.php'); ?>

<section>
<form action="form_tipo_habitacion.php" method="POST" class="white">
        <fieldset>
            <legend> Tipo de habitación </legend>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['nombre'])?></div>
            <label for="precio"> Precio: </label>
            <input type="text" name="precio" value="<?php echo htmlspecialchars($precio) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['precio'])?></div>
            <label for="descripcion"> Descripción: </label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($descripcion) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['descripcion'])?></div>
            <label for="capacidad"> Capacidad: </label>
            <input type="text" name="capacidad" value="<?php echo htmlspecialchars($capacidad) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['capacidad'])?></div>
            <label for="codigo"> Codigo: </label>
            <input type="text" name="codigo" value="<?php echo htmlspecialchars($codigo) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['codigo'])?></div>
            <label for="fotos"> Fotos: </label>
            <input type="text" name="fotos" value="<?php echo htmlspecialchars($fotos) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['fotos'])?></div>
            <label for="extras"> Extras: </label>
            <input type="text" name="extras" value="<?php echo htmlspecialchars($extras) ?>">
            <div class="red-text"><?php echo htmlspecialchars($errores['extras'])?></div>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-1" type="submit" name="submit">Enviar <i class="material-icons right">send</i> </button>
            </div>
        </fieldset>
    </form>
</section>
<div class="fondoAcerca">
        <section>
        <p class="center"> <a href="./../index_admin.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Cancelar y volver al inicio de administración </a> </p>
        <p class="center"> <a href="./select_tipo_habitacion.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">search</i> Cancelar y buscar tipos de habitación </a> </p>
    </section>
</div>

<br>

<?php include('./../templates/footer.php'); ?>

</body>
</html>