<?php include("opendb.php"); ?>
<?php 
	if( ($id_producto = $_GET['id']) == null){
		$id_producto = 0;
	}
	if( ($id_categoria = $_GET['id_cat']) == null){
		$id_categoria = 0;
	}
	if( ($pag_anterior = $_GET['tipo']) == null){
		$pag_anterior = "cat";
	}
	if( (@$busqueda = $_GET['busqueda']) == null){
		$busqueda = "";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
                    <option>Todos los productos</option>
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

		  <?php
			if($pag_anterior == "cat"){
			$query = mysql_fetch_array( mysql_query("select * from productos where id_producto = $id_producto") );
			$nombreProducto = $query["nombre"];
			$codigo = $query["codigo"];

		    $queryCategoria = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $id_categoria") );
		    $nombreCategoria = $queryCategoria["nombre"];
		    if($id_categoria == 0){
				$nombreCategoria = "Todos los productos";
			}
			$link = "catalogoCategoria.php?id=$id_categoria";
			echo '<a href = "productos.php"><b>Catalogo</b></a> > <a href ="',$link,'"><b>',$nombreCategoria,'</b></a> > <b> ',$nombreProducto,' </b><br/><br/>
		 		  <div id="detalleProductos">    
		               <span style="font-size:26px;">',$nombreProducto,' </span>
		            	<br /><br /> ';
			
			}else{
				$query = mysql_fetch_array( mysql_query("select * from productos where id_producto = $id_producto") );
				$nombreProducto = $query["nombre"];
			    $query = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $id_categoria") );
			    $nombreCategoria = $query["nombre"];
				$codigo = $query["codigo"];
			    if($id_categoria == 0){
					$nombreCategoria = "Todos los productos";
				}		
				$link = "buscar.php?busqueda=$busqueda&&categoria=$nombreCategoria";
				echo '<div align = "center">
				<a href = "',$link,'"><b>Busqueda</b></a> > <b> ',$nombreProducto,' </b><br/><br/>
				<br/> </div>';	
			
			}
			
		?>
			    
		  <?php 
			
			$productos= mysql_query("select * from productos where id_producto = $id_producto");
			while($row = mysql_fetch_array($productos)) {
		       $nombre= $row["nombre"];
			   $id= $row["id_producto"];
			   $categoria = $row["id_categoria"];
			   $descripcion= $row["descripcion"];
			   $codigo = $row["codigo"];
		       $nombreCategoria = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $categoria") );
			   $color = $row["color"];

			        echo '<div style="float:left;margin-right:10px;"> <img src="images/',$codigo,'.jpg" width="300" height="300"/> </div >
								<div style="text-align:justify;font-size:18px;"> <b> Descripcion : </b>',$row["descripcion"],'</div> <br /><br />
								<font size ="3"><b> Categoria : </b>',$nombreCategoria["nombre"] ,'</font><br /><br />';
									if($color != null){
										echo '<font size ="3"><b> Colores disponibles : </b>',$color,'</font>';
										}
					echo '<br /><br />
						  <div style="font-size:18px;font-weight:bold;"> Informacion adicional : </div >';
							if (file_exists("images/".$codigo."_adic.jpg")){
								echo '<div style="margin-right:110px;float:right;"> <img src="images/',$codigo,'_adic.jpg" width="500" height="250"/> </div >'; 
							} else {
								echo '<img src="images/noadic.jpg" width="100" height="100" />'; 
							}						  
						  
			} 
			
		?>



            </div >
            <br /><br />               
        </div>
    </div>
</body>
</html>
