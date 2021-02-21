<?php
session_start();
include 'opendb.php';
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>La Colmena - Sistema de Administración</title>
<link href="colmena.css" rel="stylesheet" type="text/css" />
</head>
<body class="TextFont">
	
	<?php
	$sql="SELECT * FROM admin WHERE username='".@$_SESSION['adusername']."' AND password='".@$_SESSION['adpassword']."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count>=1){
	?>

	<table align="center" class="AdminSystem" width="1100" border="0" cellspacing="0" cellpadding="0">
    <tr height="60"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > PRODUCTOS</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo $_SESSION['adusername']?></td></tr>
    <tr height="20"><td colspan="2"></td></tr>
    <form name="formdb" action="db_admin.php?type=filtro_productos" method="post">
    <tr><td colspan="2">Ordenar por <select name="order_by">
    <option value="productos.id_producto" <?php if (@$_GET['order_by'] == "productos.id_venta") { echo "selected"; } ?>>ID</option>
    <option value="codigo" <?php if (@$_GET['order_by'] == "codigo") { echo "selected"; } ?>>Codigo</option>
    <option value="productos.nombre" <?php if (@$_GET['order_by'] == "productos.nombre") { echo "selected"; } ?>>Nombre</option>
    <option value="proveedores.nombre" <?php if (@$_GET['order_by'] == "proveedores.nombre") { echo "selected"; } ?>>Proveedor</option>
    <option value="categorias.nombre" <?php if (@$_GET['order_by'] == "categorias.nombre") { echo "selected"; } ?>>Categoría</option>
    <option value="precio_distribuidor" <?php if (@$_GET['order_by'] == "precio_distribuidor") { echo "selected"; } ?>>Precio distribuidor</option>
    <option value="precio_cliente" <?php if (@$_GET['order_by'] == "precio_cliente") { echo "selected"; } ?>>Precio cliente</option>
    <option value="num_vendidos" <?php if (@$_GET['order_by'] == "num_vendidos") { echo "selected"; } ?>># de productos vendidos</option></select>
	<select name="order_dir">
    <option value="ASC" <?php if (@$_GET['order_dir'] == "ASC") { echo "selected"; } ?>>Ascendente</option>
    <option value="DESC" <?php if (@$_GET['order_dir'] == "DESC") { echo "selected"; } ?>>Descendente</option>
    </select>
    &nbsp; Proveedor <select name="id_proveedor">
    	<option value="todos">Mostrar todos</option>
        <?php
		$query_aux  = "SELECT * FROM proveedores";
		$result_aux = mysql_query($query_aux);
        while ($row_type_aux = mysql_fetch_array($result_aux, MYSQL_ASSOC)) {
			echo "<option value='".$row_type_aux['id_proveedor']."'";
			if (@$row_type_aux['id_proveedor'] == @$_GET['id_proveedor']) { echo " selected "; }
			echo ">".@$row_type_aux['nombre']."</option>";
		}?>
    </select>
    &nbsp; Categoría <select name="id_categoria">
    	<option value="todos">Mostrar todas</option>
        <?php
		$query_aux  = "SELECT * FROM categorias ";
		$result_aux = mysql_query($query_aux);
        while ($row_type_aux = mysql_fetch_array($result_aux, MYSQL_ASSOC)) {
			echo "<option value='".$row_type_aux['id_categoria']."'";
			if (@$row_type_aux['id_categoria'] == @$_GET['id_categoria']) { echo " selected "; }
			echo ">".$row_type_aux['nombre']."</option>";
		}?>
    </select>
    &nbsp; <input type="submit" value="Aplicar" /></td></tr>
    </form>
    <tr height="20"><td colspan="2"></td></tr>
    <tr><td>
            <?php
			$query  = "SELECT productos.nombre AS nombre_prd, proveedores.nombre AS nombre_prv, categorias.nombre AS nombre_cat, productos.id_producto, codigo, descripcion, color, tamano, precio_distribuidor, precio_cliente, sum(cantidad) AS num_vendidos FROM productos LEFT JOIN ventas_productos ON productos.id_producto = ventas_productos.id_producto LEFT JOIN proveedores ON productos.id_proveedor = proveedores.id_proveedor LEFT JOIN categorias ON productos.id_categoria = categorias.id_categoria"; 
			if (!empty($_GET['id_proveedor']) && $_GET['id_proveedor']<>"todos"){
				$query = $query." WHERE productos.id_proveedor = ".$_GET['id_proveedor']; 
				if (!empty($_GET['id_categoria']) && $_GET['id_categoria']<>"todos")
				{ $query = $query." AND productos.id_categoria = ".$_GET['id_categoria']; }
			} else {
				if (!empty($_GET['id_categoria']) && $_GET['id_categoria']<>"todos")
				{ $query = $query." WHERE productos.id_categoria = ".$_GET['id_categoria']; }
			}
			$query = $query." GROUP BY productos.id_producto";
			if (!empty($_GET['order_by'])) { $query = $query." ORDER BY ".$_GET['order_by']; }
			if (!empty($_GET['order_dir'])) { if ($_GET['order_dir'] == "DESC"){ $query = $query." DESC"; }}
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			if($count>=1){
			echo "<table width='100%' border='1'>";
			echo "<tr><td><b>ID</b></td><td><b>CÓDIGO</b></td><td><b>NOMBRE</b></td><td><b>PROVEEDOR</b></td>";			
			echo "<td><b>CATEGORÍA</b></td><td><b>DESCRIPCIÓN</b></td><td><b>COLOR</b></td><td><b>TAMAÑO</b></td>";			
			echo "<td><b>PRECIO DISTRIBUIDOR</b></td><td><b>PRECIO CLIENTE</b></td><td><b># DE PRODUCTOS VENDIDOS</b></td><td></td></tr>";
			while ($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "<tr><td>".@$row['id_producto']."</td><td>".@$row['codigo']."</td><td>".@$row['nombre_prd']."</td>".
				"<td>".@$row['nombre_prv']."</td><td>".@$row['nombre_cat']."</td><td>";
				if (strlen(@$row['descripcion'])>60) { echo substr(@$row['descripcion'],0,20).".."; } else { echo @$row['descripcion']; }
				echo "</td><td>".@$row['color']."</td><td>".@$row['tamano']."</td><td width='110'>".
				@$row['precio_distribuidor']."</td><td>".@$row['precio_cliente']."</td><td>".@$row['num_vendidos']."</td>".
				"<td width='90'><a href='admin_productos_edit.php?type=mod&id=".@$row['id_producto']."'>MODIFICAR</a></td></tr>";
			}
			echo "</table><br />";
			} else {
			echo "<br><b>No existen productos registrados</b>";
			}
			@mysql_free_result($result); 
			?>        
    </tr></td>
   	<?php if (@$_GET["success"] == "add"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PRODUCTO FUE AGREGADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "mod"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PRODUCTO FUE MODIFICADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "del"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PRODUCTO FUE ELIMINADO</font></td></tr>
    <?php } ?>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><a href="admin_productos_edit.php">AGREGAR NUEVO PRODUCTO</a></td></tr>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><a href="admin_menu.php">REGRESAR</a></td></tr>
    </table>
    
   	<?php
	} else {
	?>
    
	<table class="LoginBar" width="225" border="0" cellspacing="0" cellpadding="0">
    <tr><td><font color="#FF0000">ERROR DE ACCESO</font></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td><a href="admin.php">REGRESAR</a></td></tr>
    </table>
    
    <?php
	}
	?>

</body>
</html>

<?php
include 'closedb.php';
?> 