<!DOCTYPE html>
<html>

<head>
	<title>Inicio de sesión</title>
	
	<!-- Icono -->
	<link rel="icon" type="image/png" href="<?php echo SERVERURL; ?>public/img/logo.ico">

    <!--Bootsrap 4-->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/lib/bootstrap4/bootstrap.min.css">

    <!--Icomoon-->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/lib/icomoon/fonts/style.css">

    <!--Estilos propios-->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>public/css/style_login.css">

</head>

<body>
    <div class="container">
        <h2 class="titulo_login">Sistema de Registro y Control de Experticias de Tránsito</h2>
        <div class="d-flex justify-content-center h-100">

            <div class="card">
                <div class="card-header">
                    <h3>Iniciar sesión</h3>
                    <div class="d-flex justify-content-end social_icon">

                        <span style="font-size:50px"><a
                                href="https://www.facebook.com/Cuerpo-de-Polic%C3%ADa-Nacional-Bolivariana-231509720527789/"
                                class="icon-facebook2 icon-menu" target="_blank"></a></span>

                        <span style="font-size:55px"><a href="https://www.youtube.com/channel/UC6y3LxVw2iiuYnfVP-nAtEw"
                                target="_blank" class="icon-youtube icon-menu"></a></span>

                        <span style="font-size:50px"><a
                                href="https://twitter.com/CPNB_VE?ref_src=twsrc%5Etfw%7Ctwcamp%5Eembeddedtimeline%7Ctwterm%5Eprofile%3ACPNB_VE&ref_url=http%3A%2F%2Fwww.policianacional.gob.ve%2F"
                                target="_blank" class="icon-twitter icon-menu"></a></span>

                    </div>
                </div>
                <div class="card-body">

                    <div id="aviso">Error de usuario o contraseña</div>

                    <form id="formLogin">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="civ" name="civ" placeholder="Cédula">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-key6"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Contraseña">
                        </div>

                        <div class="form-group">
                            <input type="submit" id="iniciar" value="Ingresar" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="olvidar">Olvidaste la contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery de boostrap 4 -->
    <script src="<?php echo SERVERURL; ?>public/lib/bootstrap4/bootstrap.min.js"></script>
    <!-- Jquery -->
	<script src="<?php echo SERVERURL; ?>public/lib/jquery.min.js"></script>
	<!-- Login JS -->
    <script src="<?php echo SERVERURL; ?>public/js/login.js"></script>

</body>

</html>