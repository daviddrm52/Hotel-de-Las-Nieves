<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<title> Acceso no autorizado - Hotel de Las Nieves </title>

<?php include('./../templates/header.php'); ?>

<div class="center fondoInicio"> 
    <h3> Oops, acceso no autorizado </h3> 
    <h5> No tiene acceso a esta pagina actualmente, pruebe más tarde o contacte con un administrador de la pagina. </h5>
    <img src="./../img/error.gif" alt="">
</div>

<div class="fondoAcerca">
            <p class="center"> <h5 class="center">¿Has encontrado lo que buscabas?</h5> </p>
            <section>
                <p class="center"> <a href="./../index.php" class="waves-effect waves-light brown darken-4 btn"><i class="material-icons left">home</i> Ir al inicio del hotel </a> </p>
            </section>
        </div>
</div>


<?php include('./../templates/footer.php'); ?>

</body>
</html>
