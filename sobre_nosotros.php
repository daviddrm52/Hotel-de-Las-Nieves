<?php session_start(); ?>

<?php

    //Hacemos la conexion
    include('./config/config_bd.php');

    //Escribir la consulta
    $sql =  "SELECT * FROM 73_hotel";
    
    //Lanzar la consulta
    $resultados = mysqli_query($conn, $sql);

    $hoteles = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
    
    //Liberar memoria
    mysqli_free_result($resultados);

    //Cerrar conexion
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<title> Sobre nosotros - Hotel de Las Nieves </title>


<?php include('./templates/header.php'); ?>

<div class="center white-text"> 
        <h3> Sobre nosotros </a> </h3> 
    </div>
    <div class="fondoInicio brown lighten-5">
        <div class="center"> 
            <p>
                <img src="./img/condor_logo.png" width="64"><h3>Hotel de Las Nieves</h3>
            </p>
            <p>
                El hotel de Las Nieves lleva abierto desde 1982, sirviendo a clientes que
                desean unas tranquilas vacaciones en Ciudad Madera, junto al Parque Natural
                 del Valle Nevado.
            </p>
            <p>
                Afiliados anteriormente a Chiquitin Airlines Group con su aerolinea vacacional,
                 Air David, pero en 2020 cesó operaciones debido a reestructuración de su matriz,
                 Chiquitin Airlines Group.
            </p>
            <p>
                <img src="./img/B752_N48127.png" height="200px"> </br>
                Aviones de la aerolinea Air David (En proceso de reestructuración).
            </p>
            <p>
                Actualmente estamos filiados a Air Chiquin Group para ofrecer vuelos al hotel, 
                galardonada como mejor aerolinea del mundo desde 2016, Air Chiquin ofrece vuelos
                desde el hub del Aeropuerto Nuevo de Trinity(TRN) con Air Lian y Air Chiquin.
            </p>
            <p>
                <img src="./img/B752_N706TW.jpg" height="400px"> <br>
                Boeing 757-2Q8(WL) con los que se ofrecen vuelos (La pintura no es de la aerolinea).
            </p>
        </div>
        <h4 class="center">Información tecnica del hotel</h4>
        <?php foreach($hoteles as $hotel):?>
        <table class="striped white">
        <tr>
            <td> Nombre del hotel: </td>
            <td><?php echo htmlspecialchars($hotel['nombre']); ?> </td>
        </tr>
        <tr>
            <td> Descripción general: </td>
            <td><?php echo htmlspecialchars($hotel['descripcion'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Numero de habitaciones total: </td>
            <td><?php echo htmlspecialchars($hotel['num_habitaciones'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Dirección postal: </td>
            <td><?php echo htmlspecialchars($hotel['direccion'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Codigo postal: </td>
            <td><?php echo htmlspecialchars($hotel['codigo_postal'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Telefono del hotel: </td>
            <td><?php echo htmlspecialchars($hotel['telefono'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Pagina web: </td>
            <td><?php echo htmlspecialchars($hotel['web'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Correo electronico: </td>
            <td><?php echo htmlspecialchars($hotel['email'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> NIF del hotel: </td>
            <td><?php echo htmlspecialchars($hotel['CIF'])."<br/>"; ?> </td>
        </tr>
        <tr>
            <td> Fotos del hotel: </td>
            <td><img width="400px" src="<?php echo htmlspecialchars($hotel['fotos']) ?>"></img> <?php "<br/>"; ?></td>
        </tr>
        <tr>
            <td> Categoria del hotel: </td>
            <td><?php echo htmlspecialchars($hotel['categoria'])."<br/>"; ?> </td>
        </tr>
    </table>
    <?php endforeach; ?>

</div>

<?php include('./templates/footer.php'); ?>

</body>
</html>
