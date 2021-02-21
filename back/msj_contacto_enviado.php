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
                        firstname: "required",
                        email: {
                            required: true,
                            email: true
                        }
                   },
                    messages: {
                        firstname: "Ingresa tu nombre",
                        telefono: "Ingresa un teléfono",
                        email: {
                            required: "Ingresa tu email",
                            minlength: "Ingresa un email válido."
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

                <span style="font-size:24px;">Gracias</span>
                <br /><br />
                <span style="font-size:19px;">Tu mensaje ha sido enviado, en breve recibirás nuestra respuesta.</span>
                <br /><br /><br /><br /><br /><br />


            
            </div>

        </div>
    </div>
</body>
</html>
