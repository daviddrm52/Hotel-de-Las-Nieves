<?php 

//Conexion a la base de datos
$conn = mysqli_connect('localhost', 'david', '1234', 'hotel');

//Comprobación la conexión
if(!$conn) {
    echo 'Error de conexión: '. mysqli_connect_error();
}
else {
    //echo 'Conexión con la base de datos correcta.';
}

?>