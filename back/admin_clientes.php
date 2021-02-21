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

	<table align="center" class="AdminSystem" width="1000" border="0" cellspacing="0" cellpadding="0">
    <tr height="60"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > CLIENTES</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo $_SESSION['adusername']?></td></tr>
    <tr height="20"><td colspan="2"></td></tr>
    <form name="formdb" action="db_admin.php?type=filtro_clientes" method="post">
    <tr><td colspan="2">Ordenar por <select name="order_by">
    <option value="id_cliente" <?php if (@$_GET['order_by'] == "id_cliente") { echo "selected"; } ?>>ID</option>
    <option value="nombre" <?php if (@$_GET['order_by'] == "nombre") { echo "selected"; } ?>>Nombre</option>
    <option value="apellido" <?php if (@$_GET['order_by'] == "apellido") { echo "selected"; } ?>>Apellido</option>
    <option value="tipo_precio" <?php if (@$_GET['order_by'] == "tipo_precio") { echo "selected"; } ?>>Tipo de precio</option></select>
	<select name="order_dir">
    <option value="ASC" <?php if (@$_GET['order_dir'] == "ASC") { echo "selected"; } ?>>Ascendente</option>
    <option value="DESC" <?php if (@$_GET['order_dir'] == "DESC") { echo "selected"; } ?>>Descendente</option>
    </select>
    &nbsp; Mostrar <select name="show">
    <option value="todo" <?php if (@$_GET['show'] == "todo") { echo "selected"; } ?>>Todo</option>
    <option value="deudores" <?php if (@$_GET['show'] == "deudores") { echo "selected"; } ?>>Deudores</option></select>
    &nbsp; <input type="submit" value="Aplicar" /></td></tr>
    </form>
    <tr height="20"><td colspan="2"></td></tr>
    <tr><td>
            <?php
			$query  = "SELECT clientes.id_cliente, clientes.nombre, apellido, direccion, email, telefono, tipo_precio, IF(tipo_precio = 'distribuidor',sum(precio_distribuidor*cantidad), sum(precio_cliente*cantidad)) - sum(cantidad_pagada) AS deuda FROM clientes LEFT JOIN ventas ON clientes.id_cliente = ventas.id_cliente LEFT JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta LEFT JOIN productos ON ventas_productos.id_producto = productos.id_producto";
			$query = $query." GROUP BY clientes.id_cliente";
			if (!empty($_GET['order_by'])) { $query = $query." ORDER BY ".$_GET['order_by']; }
			if (!empty($_GET['order_dir'])) { if ($_GET['order_dir'] == "DESC"){ $query = $query." DESC"; }}
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			if($count>=1){
			echo "<table width='100%' border='1'>";
			echo "<tr><td><b>ID</b></td><td><b>NOMBRE</b></td><td><b>APELLIDO</b></td>";			
			echo "<td><b>DIRECCIÓN</b></td><td><b>E-MAIL</b></td><td><b>TELÉFONO</b></td><td width='90'><b>TIPO DE PRECIO</b></td>".
			"<td><b>DEUDA</b></td><td></td></tr>";			
			while ($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
			if (!(@$_GET['show'] == "deudores" && @$row['deuda'] < 0)){
				echo "<tr><td>".@$row['id_cliente']."</td><td>".@$row['nombre']."</td><td>".@$row['apellido']."</td>".
				"<td>".@$row['direccion']."</td><td>".@$row['email']."</td><td width='110'>".@$row['telefono']."</td>".
				"<td>".@$row['tipo_precio']."</td><td>".@$row['deuda']."</td>".
				"<td width='110'><a href='admin_clientes_edit.php?type=mod&id=".@$row['id_cliente']."'>MODIFICAR</a></td></tr>";
			}}
			echo "</table><br />";
			} else {
			echo "<br><b>No existen clientes registrados</b>";
			}
			@mysql_free_result($result); 
			?>        
    </tr></td>
   	<?php if (@$_GET["success"] == "add"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL CLIENTE FUE AGREGADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "mod"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL CLIENTE FUE MODIFICADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "del"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL CLIENTE FUE ELIMINADO</font></td></tr>
    <?php } ?>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><a href="admin_clientes_edit.php">AGREGAR NUEVO CLIENTE</a></td></tr>
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