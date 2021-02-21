<?php include("opendb.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<body background="images/fondo.png">
<?php 
	if( ($id_categoria = $_GET['id']) == null){
		$id_categoria = 0;
	}
	if($id_categoria == 0){
		$nombreCategoria = "Todos los productos";
	}
	else{
		$query = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $id_categoria") );
		$nombreCategoria = $query["nombre"];
	}
?>

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
	
	<table border = "0">
			<tr>
				<td valign="top" align="center">
                	&nbsp;
					<div align = "center">
	<font size="5">Categoria</font><br/>

				 <table> <tr> <td width="170"> 
					<div id="borderCategoria">
						<table><tr><td> <img src="images/7.jpg" width="30" height="30"/> </td>
						<td>
						<table> <tr><td width="200" align="left"> <a href = "catalogoCategoria.php?id=0"><font size ="4">Todos</font></a></td> </tr> 
						</table>
					    </td></tr></table>
					</div> 
				 </table>
</div>
                      <?php 
	$categorias= mysql_query("select * from categorias ORDER BY nombre ASC ");
	while($row = mysql_fetch_array($categorias)) {
       $nombre= $row["nombre"];
	   $id = $row["id_categoria"];
	        echo '<div align = "left">
				 <table> <tr> <td width="170"> 
					<div id="borderCategoria">
					  <table><tr><td> <img src="images/',$id,'.jpg" width="30" height="30"/> </td>
					    <td>
						<table> <tr><td width="200"> <a href = "catalogoCategoria.php?id=',$id,'"><font size ="4">', $nombre ,'</font></a></td> </tr> 
						</table>
				  </td></tr></table>
					</div>
				 </table>
				 </div>';
	} 
?>
                </td>
				<td width="500" valign="top" align="center">
				

	<div align = "center" style="margin-top:10px">
	<a href = "catalogo.php"><b>Catalogo</b></a> > <b><?php echo $nombreCategoria;?></b></a> > <br/><br/>
	<font size = "5" ><?php echo $nombreCategoria?></font><br/>

</div>
<?php 
	
	if($id_categoria == 0){
		$queryProductos= mysql_query("select * from productos ORDER BY nombre ASC");
	}else{
		$queryProductos= mysql_query("select * from productos where id_categoria = '$id_categoria' ORDER BY nombre ASC");
	}
	while($row = mysql_fetch_array($queryProductos)) {
       $nombre= $row["nombre"];
	   $id= $row["id_producto"];
	   $categoria = $row["id_categoria"];
	   $descripcion = substr($row["descripcion"],0,150);
	   $codigo = $row["codigo"];
	   $color = $row["color"];
	   $nombreCategoria = mysql_fetch_array( mysql_query("select nombre from categorias where id_categoria = $categoria") );
	        echo '<div align = "center">
					<table> <tr> <td width="400">
					<b>',@$tempCategoria["nombre"],'</b>
					<div id="borderProducto">
					   <table><tr><td>'; 
			if (file_exists("images/".$id.".jpg")){
				echo '<img src="images/',$id,'.jpg" width="100" height="100" />'; 
			} else {
				echo '<img src="images/NA.png" width="100" height="100" />'; 
			}
			echo'</td>
					   <td>		  
						<table> <tr><td width="200"> <font size ="5"><a href = "producto.php?id=',$id,'&&id_cat=',$id_categoria,'&&tipo=cat">', $nombre ,'</a> </font></td> </tr> 
							<tr> <td> <b> Descripcion : </b>',$descripcion,'...</td> </tr> 
							<tr> <td> <b> Categoria : </b> ',$nombreCategoria["nombre"],'</td></tr>
							<tr> <td> <b> Clave : </b>0',$codigo,'</td></tr>';
							if($color != null){
								echo '<tr> <td> <b> Colores disponibles : </b>',$color,'</td></tr>';
								}
						echo '</table>
						</td></tr></table>
					</div> 
					</table>
				 </div>';
	} 
?>
	
			</td>
		</tr>
		</table>
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