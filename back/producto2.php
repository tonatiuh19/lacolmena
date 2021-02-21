<?php include("opendb.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<link rel="stylesheet" href="css/menu_style.css" type="text/css" />
<link rel="stylesheet" href="colmena.css" type="text/css" />
<title>Catalogo</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
a:hover{text-decoration:none;} 
a{text-decoration:none;}  
</style>
</head>
<body>
<body background="images/fondo.png">
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="800" bgcolor="#999900"><img src="images/colmena.jpg"/></td>
  </tr>
  <tr>
    <td>
    <ul id="menu">
    	<li><img src="images/divider.png" /></li>
		<li><a href="index.php" title="">Home</a></li>
		<li><a href="catalogo.php" title="">Catalogo</a></li>
		<li><a href="acerca.php" title="" >Acerca de la colmena</a></li>
		<li><a href="contacto.php" title="">CONTACTO</a></li>
	</ul>
</td>
  </tr>
  <tr>
  <form method="GET" action="buscar.php"> 
    <td height="40" background="images/barraMenu.png">
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
		
	</td></form>
  </tr>
  <tr>
    <td background="images/fondoAdentro.png" bgcolor ="#FFFFFF">
	
  <?php
	if($pag_anterior == "cat"){
	
	$query = mysql_fetch_array( mysql_query("select * from productos where id_producto = $id_producto") );
	$nombreProducto = $query["nombre"];
	$codigo = $query["codigo"];

	    $query = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $id_categoria") );
	    $nombreCategoria = $query["nombre"];
	    if($id_categoria == 0){
			$nombreCategoria = "Todos los productos";
		}
		$link = "catalogoCategoria.php?id=$id_categoria";
		echo '<div align = "center" style="margin-top:10px">
		<a href = "catalogo.php"><b>Catalogo</b></a> > <a href ="',$link,'"><b>',@$anterior, $nombreCategoria,'</b></a> > <b> ',$nombreProducto,' </b><br/><br/>
		<font size = "5">Producto con clave : ',$codigo,'</font><br/> </div>';
	
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

	        echo '<div align = "center">
					<table> <tr> <td width="700">
					   <table><tr><td width="100"> <img src="images/',$id,'.jpg" width="300" height="300"/>  </td>
					   <td>		  
						<table> <tr><td width="200"> <font size ="6">', $nombre ,'</font></td> </tr> 
							<tr> <td class="descriptionText" align="left"> <font size ="3"><b> Descripción : </b>',$row["descripcion"],'</font></td> </tr> 
							<tr> <td align="left"> <font size ="3"><b> Categoria : </b>',$nombreCategoria["nombre"] ,'</font></td></tr>
							<tr> <td align="left"> <font size ="3"><b> Clave : </b>',$codigo,'</font></td></tr>';
							if($color != null){
								echo '<tr> <td align="left"> <font size ="3"><b> Colores disponibles : </b>',$color,'</font></td></tr>';
								}							
						echo'</table>
						</td></tr></table>
					</table>
				 </div>';
	} 
	
		echo ' <div align="center"> <a href="',$link,'"><font size ="4">Regresar </font></a> </div>';
?>
    </td>
  </tr>
  <tr>
    <td height="50" background="images/barraMenu.png" valign="middle" align="center">
    <b>© 2009 La Colmena. México D.F., México. Todos los derechos reservados</b></td>
  </tr>
</table>

</body>
</html>
<?php include("closedb.php"); ?>