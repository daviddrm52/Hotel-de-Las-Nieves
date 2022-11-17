<!DOCTYPE html>
<html lang="es">

<?php 

//Conexion a la base de datos
$conn = mysqli_connect('remotehost.es', 'dwes1234', 'test1234.', 'dwesdatabase');

//Comprobación la conexión
if(!$conn) {
    echo 'Error de conexión: '. mysqli_connect_error();
}
else {
    //echo 'Conexión con la base de datos correcta.';
}

?>

</html>