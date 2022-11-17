<?php    
    //Hacemos la conexion
    include('./../config/config_bd.php');

    if(empty($_SESSION["id"])){
        header('Location: /student73/dwes/config/acceso_restringido.php');
    } else {
        //Query de la base de datos para recuperar los tipos de habitaci
        $sql = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

        //Lanzamos la query y capturamos los resultados
        $resultados = mysqli_query($conn, $sql);

        $informacionCliente = mysqli_fetch_array($resultados);

        $tipoID = $informacionCliente['tipo_id'];

        if($tipoID==1){
            //echo "Acceso autorizado...";
        } else if($tipoID==2){
            //echo "Acceso autorizado...";
        } else {
            header('Location: /student73/dwes/config/acceso_restringido.php');
        }
    }

    //Cerramos conexión
    mysqli_close($conn);

?>