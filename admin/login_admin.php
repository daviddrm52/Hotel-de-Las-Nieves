<?php session_start();

$mensajeError="";
$tipoId="";

if(count($_POST)>0){
    include_once('./../config/config_bd.php');    
    $inicioSesion = mysqli_query($conn, "SELECT * FROM 73_clientes WHERE usuario = '".$_POST["username"]."' AND contrasena = '".$_POST["password"]."'");
    $row = mysqli_fetch_array($inicioSesion);
    $verificarAdmin = mysqli_query($conn,"SELECT tipo_id FROM 73_clientes WHERE id = '".$_SESSION["id"]."'");
    $resultadoAdmin = mysqli_fetch_all($verificarAdmin);
    $tipoId=$resultadoAdmin["tipo_id"];
    if($tipoId=="2"){
        if(is_array($row)){
            $_SESSION["id"] = $row['id'];
        } else {
            $mensajeError="¡Usuario o contraseña incorrectos! Vuelva a intentarlo.";
        }
        if(isset($_SESSION["id"])){
            header("Location: index_admin.php");
            exit();
        }
    } else {
        $mensajeError="¡Este usuario no es administrador!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<title> Iniciar sesión en su cuenta de administrador - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<div class="fondoAdministracion">
<br>
<br>
    <div class="log-in white row center">
        <h4>Iniciar sesión en su cuenta de administrador</h4>
        <form action="login_admin.php" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <label>Nombre de usuario: </label> <br>
                    <input name="username" type="text" placeholder="Usuario..." required disabled>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label>Contraseña: </label> <br>
                    <input name="password" type="password" placeholder="Contraseña..." required disabled>
                </div>
            </div>
            <div class="red-text"><?php echo htmlspecialchars($mensajeError) ?></div>
            <br>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-4 disabled" type="submit" value="submit" name="submit">Iniciar sesión
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <br>
            <div class="red-text"> Inicio de sesión no disponible, contacte con customerservices@hoteldelasnieves.com </div>
        </form> 
    </div>
    <?php 
        if(empty($_SESSION["id"])){
            ?>
            <br>
            <div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Desea volver al inicio?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
            </section>
            </div>
            <br>
            <?php
        } else {
            ?>
    <div class="log-in white center">
        ¿No tiene cuenta de cliente? <a href="./signup_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i>Crear cuenta</a>
    </div>
    <div class="log-in white center">
        ¿Quiere cerrar su sesión? <a href="./../config/logout.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">close</i> Cerrar sesión </a>
    </div>
            <?php
        }
            ?>
    <br>
</div>

<?php include('./../templates/footer.php'); ?>
    
</body>
</html>
