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
	$busqueda = $_GET["busqueda"];
	$categoria = $_GET["categoria"];
	$todos_los_productos = false;
	if($categoria == "Todos+los+productos"){
		$id_categoria = 0;
	}else{
		$queryIDCategoria = mysql_fetch_array(mysql_query("select * from categorias where nombre = '$categoria'"));
		$id_categoria  = $queryIDCategoria["id_categoria"];
	}
	if($busqueda == null )
		$todos_los_productos = true;

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
	
	<div align="center" style="margin-top:10px"><b>Busqueda</b> > </div>
	<div align = "center" style="margin-top:10px">

	<font size = "5" >Resultados de tu busqueda</font><br/>

</div>
    <p>
      <?php 
	  
	if($todos_los_productos && $id_categoria == 0){
		$productos= mysql_query("select * from productos ORDER BY nombre ASC ");
	}else if($todos_los_productos && $id_categoria != 0){
		$productos= mysql_query("select * from productos where id_categoria = $id_categoria ORDER BY nombre ASC ");
	}else if($id_categoria == 0) {
		$productos= mysql_query("select * from productos where MATCH(nombre, descripcion) AGAINST ('$busqueda$') ORDER BY nombre ASC ");
	}else{
		$productos= mysql_query("select * from productos where MATCH(nombre, descripcion) AGAINST ('$busqueda$') AND id_categoria = '$id_categoria' ORDER BY nombre ASC ");
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
	  
	        echo '<div align = "center">
					<table> <tr> <td width="400">
					<b>',@$tempCategoria["nombre"],'</b>
					<div id="borderProducto">
					   <table><tr><td> <img src="images/',$id,'.jpg" width="100" height="100"/> </td>
					   <td>		  
						<table> <tr><td width="200"> <font size ="5"><a href = "producto.php?id=',$id,'&&tipo=buscar&&id_cat=',$categoria,'&&busqueda=',$busqueda,'">', $nombre ,'</a> </font></td> </tr> 
							<tr> <td align="left"> <b> Descripcion : </b>',$descripcion,'...</td> </tr> 
							<tr> <td align="left"> <b> Categoria : </b> <a href = "catalogoCategoria.php?id=',$categoria,'">',$nombreCategoria["nombre"] ,'</a></td></tr>
							<tr> <td align="left"> <b> Clave : </b>0',$id,'</td></tr>';
							if($color != null){
								echo '<tr> <td align="left"> <b> Colores disponibles : </b>',$color,'</td></tr>';
								}							
					echo'</table>
						</td></tr></table>
					</div> 
					</table>
				 </div>';
	} 
?>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	
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