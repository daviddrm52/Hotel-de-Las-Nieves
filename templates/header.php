<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/student73/dwes/img/condor_logo.ico">
    <!-- For the icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">

    </script>
    <style type="text/css">
    .brand{
        background: #795548 !important;
    }
    .brand-text{
        color: #FFFFFF !important;
    }
    .fondo{
        background-image: url("/student73/dwes/img/fondos/imagen_principal.jpeg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .fondoAdministracion{
        background-image: url("./../img/fondos/imagen_administracion.png");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .fondoCliente{
        background-image: url("./../img/fondos/imagen_cliente.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .fondoLogIn{
        background-image: url("./../img/fondos/imagen_login.jfif");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .fondoInicio{
        background-color: #efebe9;
        background-repeat: no-repeat;
        background-position: center;
        width: 900px;
        margin: auto;
        border-radius: 30px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .fondoHabitacion{
        background-color: #efebe9;
        background-repeat: no-repeat;
        background-position: center;
        width: 700px;
        margin: auto;
        border-radius: 30px;
        padding: 10px;
        margin-top: 1fr;
    }
    .fondoAcerca{
        background-color: #efebe9;
        background-repeat: no-repeat;
        background-position: center;
        width: 700px;
        margin: auto;
        border-radius: 30px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .fondoLegal{
        background-color: #efebe9;
        background-repeat: no-repeat;
        background-position: center;
        width: 1000px;
        margin: auto;
        border-radius: 30px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .log-in{
        background-color: #efebe9;
        background-repeat: no-repeat;
        background-position: center;
        width: 700px;
        margin: auto;
        border-radius: 30px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .boton{
        align-items: center;
        justify-content: extends;
    }
    form{
        max-width: 560px;
        margin: 20px auto;
        padding: 10px;
        background-color: #FFFFFF;
    }
    footer{
        position:relative;
        width: 100%;
        bottom: 0;
        clear: both;
        background-color: #d7ccc8;
    }
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }
    main {
        flex: 1 0 auto;
    }
    </style>
</head>
<body class = "fondo">
    <nav class="nav-extended brown darken-3 z-deph-0">
        <div class="nav-wrapper container">
        <a href = "/student73/dwes/index.php" class="brand-logo brand-text"> <i class="material-icons left">hotel</i> Hotel de Las Nieves </a>
        <ul id="nav-mobile" class="right">
            <li class="right"> Bienvenido <?php
            if(empty($_SESSION["id"])) {
                echo "anonimo...";
            } else {
                //echo $_SESSION["id"]; 
    
                //Conexion a la base de datos
                $conn = mysqli_connect('localhost', 'david', '1234', 'hotel');

                //Query de la base de datos para recuperar los tipos de habitaci
                $sql = "SELECT * FROM 73_clientes WHERE id = '".$_SESSION["id"]."'";

                //Lanzamos la query y capturamos los resultados
                $resultados = mysqli_query($conn, $sql);

                $usuario = mysqli_fetch_all($resultados, MYSQLI_ASSOC);

                //Liberar memoria
                mysqli_free_result($resultados);

                //Cerramos conexión
                mysqli_close($conn);

                foreach ($usuario as $user){
                   echo $user["usuario"];
                }
            }
            ?></li>
            <br>
            <li><a href="/student73/dwes/reservas/info_reservas.php">Reservar una habitación</a></li>
            <li><a href="
            <?php 
                if(empty($_SESSION["id"])){
                    echo "/student73/dwes/clientes/login_cliente.php";
                } else {
                    echo "/student73/dwes/clientes/index_cliente.php";
                }
            ?>
            " class="brown lighten-2 btn"><i class="material-icons left">account_box</i>Cuenta de usuario</a></li>
        </ul>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
