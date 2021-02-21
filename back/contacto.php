<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>La Colmena</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
    <link rel="stylesheet" href="css/colmena.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
    <script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"> </script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var standard_message = $('#mensaje').val();
            $('#mensaje').focus(
                function() {
                    if ($(this).val() == standard_message)
                        $(this).val("");
                }
            );
            $('#mensaje').blur(
                function() {
                    if ($(this).val() == "")
                        $(this).val(standard_message);
                }
            );
        });
    </script>
    <script>
        $(function() {
           $( "#registerForm" ).validate({
                   rules: {
                        nombre: "required",
                        email: {
                            required: true,
                            email: true
                        }
                   },
                    messages: {
                        nombre: "Ingresa tu nombre",
                        telefono: "Ingresa un telefono",
                        email: {
                            required: "Ingresa tu email",
                            minlength: "Ingresa un email valido."
                        }
                    }                   
           });


    });        
    </script>    

</head>
<body>
    <div id="container">
        <div id="inner">

            <?php include("header.php") ?>
                <br />
            <div id="contacto">

                <span style="font-size:24px;">Contacto</span>
                <br /><br />
                <span style="font-size:18px;">Contactanos por cualquier duda o comentario que tengas sobre cualquiera de nuestros productos.</span>
                    <br /><br /><br /><br />
                    <form id="registerForm" action="enviarMailContacto.php" method="post">
                        <input type="text" required="true" name="nombre" id="nombre" placeholder="Nombre" style="width:200px;font-size:18px;"/>
                        <br /><br />
                        <input id="email" name="email" placeholder="Email" style="width:200px;font-size:18px;"/>
                        <br /><br />
                        <input type="text" required="true" name="telefono" id="telefono" placeholder="Telefono" style="width:200px;font-size:18px;"/>
                        <br /><br />
                        <textarea id="mensaje" name="mensaje" cols="28" rows="6"> Mensaje </textarea>
                        <br /><br />
                        <input type="submit" value="Enviar" id="submitButton" class="botonEnviarFormulario"/>
                    </form>
                <br /><br />
                Norte 82, No. 4212 Col. Malinche, C.P. 07899, México, D.F.
                Teléfono: 55-51-24-26 y Fax: 57-51-63-91
                <br /><br /><br /><br />
                <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.mx/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=&amp;aq=&amp;sll=19.483181,-99.146976&amp;sspn=0.068293,0.132093&amp;ie=UTF8&amp;ll=19.435211,-99.18103&amp;spn=0.017078,0.033023&amp;t=m&amp;z=16&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.mx/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=&amp;aq=&amp;sll=19.483181,-99.146976&amp;sspn=0.068293,0.132093&amp;ie=UTF8&amp;ll=19.435211,-99.18103&amp;spn=0.017078,0.033023&amp;t=m&amp;z=16" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                <br /><br />


            
            </div>

        </div>
    </div>
</body>
</html>
