<?php session_start();

$mensajeError="";

if(count($_POST)>0){
    include_once('./../config/config_bd.php');    
    $inicioSesion = mysqli_query($conn, "SELECT * FROM 73_clientes WHERE usuario = '".$_POST["username"]."' AND contrasena = '".$_POST["password"]."'");
    $row = mysqli_fetch_array($inicioSesion);
    if(is_array($row)){
        $_SESSION["id"] = $row['id'];
        $_SESSION["username"] = $row['username'];
    } else {
        $mensajeError="¡Usuario o contraseña incorrectos! Vuelva a intentarlo.";
    }
    if(isset($_SESSION["id"])){
        header("Location: ./../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<title> Iniciar sesión en su cuenta de cliente - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<div class="fondoLogIn">
<br>
    <div class="log-in white row center">
        <h4>Iniciar sesión en su cuenta de cliente</h4>
        <form action="login_cliente.php" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <label>Nombre de usuario: </label> <br>
                    <input name="username" type="text" placeholder="Usuario..." required>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label>Contraseña: </label> <br>
                    <input name="password" type="password" placeholder="Contraseña..." required>
                </div>
            </div>
            <div class="red-text"><?php echo htmlspecialchars($mensajeError) ?></div>
            <br>
            <div class="center">
                <button class="btn waves-effect waves-light brown darken-4" type="submit" value="submit" name="submit">Iniciar sesión
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form> 
    </div>
    <div class="log-in white center">
            ¿No tiene cuenta de cliente? <a href="./signup_cliente.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">add</i>Crear cuenta</a>
    </div>
    <?php 
        if(empty($_SESSION["id"])){
            
        } else {
            ?>
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
