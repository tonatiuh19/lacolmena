<?php include("opendb.php"); ?>
<?php 
	$busqueda = $_GET["busqueda"];
	$id_categoria = $_GET["categoria"];
	$todos_los_productos = false;

	if($busqueda == null){
		$todos_los_productos = true;
	}

	if($id_categoria == 0){
		$categoria = "Todos los productos";
	}else{
		$queryIDCategoria = mysql_fetch_array(mysql_query("select * from categorias where id_categoria = '$id_categoria'"));
		$categoria  = $queryIDCategoria["nombre"];
	}

?>
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
                            echo '<option value="',$row["id_categoria"],'">',$row["nombre"],'</option>';
                        }
                    ?>
                </select>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
            <br /><br />
   
            <div id="productos">    
            	<br /><br /> 
		      <?php 
			if($todos_los_productos && $id_categoria == 0){
				$productos= mysql_query("select * from productos ORDER BY nombre ASC ");
			}else if($todos_los_productos && $id_categoria != 0){
				$productos= mysql_query("select * from productos where id_categoria = $id_categoria ORDER BY nombre ASC ");
			}else if($id_categoria == 0) {
				$productos= mysql_query("select * from productos where MATCH(nombre,descripcion) AGAINST('".$busqueda."' IN BOOLEAN MODE) ORDER BY nombre ASC");
			}else{
				$productos= mysql_query("select * from productos where MATCH(nombre, descripcion) AGAINST('".$busqueda."' IN BOOLEAN MODE) AND id_categoria = '$id_categoria' ORDER BY nombre ASC ");
			}
			$contadorResultados = mysql_num_rows($productos);
			echo '<div align="center"><b> Se encontraron (',$contadorResultados,') resultados 
				con <i>',$busqueda,'</i> en categoria ',$categoria,'</b></div>';
			while($row = mysql_fetch_array($productos)) {
		       $nombre= $row["nombre"];
			   $id= $row["id_producto"];
			   $categoria = $row["id_categoria"];
			   $descripcion = substr($row["descripcion"],0,150);
		       $nombreCategoria = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $categoria") );
			   $color = $row["color"];
			   $codigo = $row["codigo"];
			  
					   		echo '<div id="producto">
					   				<div style="float:left;margin-right:10px;">';
							if (file_exists("images/".$codigo.".jpg")){
								echo '<img src="images/',$codigo,'.jpg" width="155" height="150" />'; 
							} else {
								echo '<img src="images/NA.png" width="100" height="100" />'; 
							}
							echo '</div>';
							echo'<span id="nombreProducto"> <a href = "producto.php?id=',$id,'&&id_cat=',$id_categoria,'&&tipo=cat">', $nombre ,'</a> </span>';
							echo '<br /><br />  <span style="font-size"> Descripcion : </b>',$descripcion,'...
									<br /><br /> <b> Categoria : </b> ',$nombreCategoria["nombre"];
											if($color != null){
												echo '<br /><br /> <b> Colores disponibles : </b>',$color,'';
												}
							echo '</div>';	
			} 
		?>




            </div >
            <br /><br />               
        </div>
    </div>
</body>
</html>
