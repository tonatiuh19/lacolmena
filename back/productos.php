<?php include("opendb.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>La Colmena</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<link rel="stylesheet" href="css/colmena.css" type="text/css" />

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

</head>
<body>
    <div id="container">
        <div id="inner">

            <?php include("header.php") ?>
                <br />

            <form method="GET" action="buscar.php"> 
                &nbsp;&nbsp;&nbsp;<b>Buscar</b> &nbsp;&nbsp;<input type="text" name="busqueda"> &nbsp; <b>En</b> &nbsp;
                <select name ="categoria">
                    <option value="0">Todos los productos</option>
                    <?php   
                        $queryCategorias = mysql_query("select * from categorias ORDER BY nombre");
                        while($row = mysql_fetch_array($queryCategorias)) {
                            echo '<option>',$row["nombre"],'</option>';
                        }
                    ?>
                </select>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
            <br /><br />
                <span style="font-size:21px;margin-left:20px;"> Buscar por categoría de productos </span>
            <br /><br />    
            <div id="categorias">    
                <?php 
                    $categorias= mysql_query("select * from categorias ORDER BY nombre ASC ");
                    while($row = mysql_fetch_array($categorias)) {
                       $nombre= $row["nombre"];
                       $id_categoria = $row["id_categoria"];
                            echo '<div id="categoria">
                                        <a href = "catalogoCategoria.php?id=',$id_categoria,'"><font size ="5">', $nombre ,'</font></a> 
                                        <a href = "catalogoCategoria.php?id=',$id_categoria,'"> <img src="images/',$id_categoria,'.jpg" style="width:250px;height:270px;"/></a>
                                 </div>

                                 ';
                    }
                ?> 
            </div >
            <br /><br />               
        </div>
    </div>
</body>
</html>
