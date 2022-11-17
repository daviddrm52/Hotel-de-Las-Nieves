<footer class="page-footer brown lighten-1">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text"><i class="material-icons left">hotel</i> Hotel de Las Nieves *****</h5>
        <p class="grey-text text-lighten-4">Pagina en construcción, disculpa las molestias ^_^ </p>
        <p> <i class="tiny material-icons">build</i><a href="
        <?php 
                if(empty($_SESSION["id"])){
                    echo "/student73/dwes/admin/login_admin.php";
                } else {
                    echo "/student73/dwes/admin/index_admin.php";
                }
            ?>
        " style="color:#FFFFFF;"> Area de administración </a> </p>
        <p> <i class="tiny material-icons">build</i><a href="
        <?php 
                if(empty($_SESSION["id"])){
                    echo "/student73/dwes/clientes/login_cliente.php";
                } else {
                    echo "/student73/dwes/clientes/index_cliente.php";
                }
            ?>
        " style="color:#FFFFFF;"> Area del cliente </a> </p>
        <?php 
                if(!empty($_SESSION["id"])){ ?>
                  <p> <i class="tiny material-icons">account_box</i><a href="/student73/dwes/config/logout.php" style="color:#FFFFFF;"> Cerrar sesión </a> </p>
                <?php } else { ?>
                
                <?php }
            ?>
      </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">¿Desea contactar con nosotros?</h5>
          <ul>
            <li><i class="tiny material-icons">contact_phone</i><a href="tel:672093508" style="color:#FFFFFF;"> Teléfono de contacto </a></li>
            <li><i class="tiny material-icons">email</i><a href="mailto:dawbdmadridrueda@iesjoanramis.org" style="color:#FFFFFF;"> Correo electrónico </a></li>
            <li><i class="tiny material-icons">local_phone</i><a href="fax:971363600" style="color:#FFFFFF;"> Teléfono local </a></li>
            <li><i class="tiny material-icons">map</i><a href="https://www.google.es/maps/place/IES+Joan+Ramis+i+Ramis/@39.887561,4.2545092,19z/data=!4m5!3m4!1s0x1295879499ca9293:0x67689d7fe11f1c6f!8m2!3d39.8874818!4d4.2548197" target="_blank" style="color:#FFFFFF;"> Nuestra ubicación </a></li>
            <li><i class="tiny material-icons">book</i><a href="/student73/dwes/documentacion/manualUsuarioDavidRuedaMadrid.pdf" style="color:#FFFFFF;"> Manual de usuario </a></li>
          </ul>
        </div>  
      </div>
    </div>
    <div class="footer-copyright brown darken-3">
      <div class="container">
        <a href="/student73/dwes/index.php" style="color:#FFFFFF;">Hotel de Las Nieves</a> - © 2021 ~ Afiliados con <a href="https:\\www.airchiquin.com\" style="color:#FFFFFF;">Air Chiquin Group</a> | <a href="/student73/dwes/aviso_legal.php" style="color:#FFFFFF;"> Aviso legal </a> | <a href="/student73/dwes/aviso_legal.php#cookies" style="color:#FFFFFF;"> Politica de cookies </a> | <a class="grey-text text-lighten-4 right" href="/student73/dwes/sobre_nosotros.php"><i class="material-icons left">info</i> Sobre nosotros </a>
      </div>
    </div>
  </footer>