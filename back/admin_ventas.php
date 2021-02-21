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

	<table align="center" class="AdminSystem" width="900" border="0" cellspacing="0" cellpadding="0">
    <tr height="60"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > REPORTE DE VENTAS</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo $_SESSION['adusername']?></td></tr>
    <tr height="20"><td colspan="2"></td></tr>
    <form name="formdb" action="db_admin.php?type=filtro_ventas" method="post">
    <tr><td colspan="2">Ordenar por <select name="order_by">
    <option value="ventas.id_venta" <?php if (@$_GET['order_by'] == "ventas.id_venta") { echo "selected"; } ?>>ID</option>
    <option value="ventas.codigo" <?php if (@$_GET['order_by'] == "ventas.codigo") { echo "selected"; } ?>>Codigo</option>
    <option value="fecha" <?php if (@$_GET['order_by'] == "fecha") { echo "selected"; } ?>>Fecha</option>
    <option value="clientes.nombre" <?php if (@$_GET['order_by'] == "clientes.nombre") { echo "selected"; } ?>>Cliente</option>
    <option value="total" <?php if (@$_GET['order_by'] == "total") { echo "selected"; } ?>>Total</option>
    <option value="cantidad_pagada" <?php if (@$_GET['order_by'] == "cantidad_pagada") { echo "selected"; } ?>>Cantidad pagada</option>
    <option value="entregado" <?php if (@$_GET['order_by'] == "entregado") { echo "selected"; } ?>>Entregado</option></select>
	<select name="order_dir">
    <option value="ASC" <?php if (@$_GET['order_dir'] == "ASC") { echo "selected"; } ?>>Ascendente</option>
    <option value="DESC" <?php if (@$_GET['order_dir'] == "DESC") { echo "selected"; } ?>>Descendente</option>
    </select>
    &nbsp; Mostrar <select name="show">
    <option value="todo" <?php if (@$_GET['show'] == "todo") { echo "selected"; } ?>>Todo</option>
    <option value="pagados" <?php if (@$_GET['show'] == "pagados") { echo "selected"; } ?>>Pagados</option>
    <option value="no_pagados" <?php if (@$_GET['show'] == "no_pagados") { echo "selected"; } ?>>No pagados</option>
    <option value="pendientes" <?php if (@$_GET['show'] == "pendientes") { echo "selected"; } ?>>Pendientes</option></select>
    &nbsp; Desde <input name="from" type="text" style="width:80px;" maxlength="20" <?php if (!empty($_GET['from'])){
	echo "value='".@$_GET['from']."'"; } else 
	{ echo "value='".date("Y-m-d",mktime(0, 0, 0, date("m")-2, date("d"), date("y")))."'"; } ?> /> 
    Hasta <input name="to" type="text" style="width:80px;" maxlength="20" <?php if (!empty($_GET['to'])){
	echo "value='".@$_GET['to']."'"; } else 
	{ echo "value='".date("Y-m-d",mktime(0, 0, 0, date("m"), date("d"), date("y")))."'"; } ?> />
    &nbsp; <input type="submit" value="Aplicar" /></td></tr>
    </form>
   	<?php if (@$_GET["error"] == "date"){ ?>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td colspan="2"><font color="#FF0000">INDIQUE UNA FECHA CORRECTA EN LOS CAMPOS DESDE Y HASTA EN EL FORMATO (aaaa-mm-dd)</font></td></tr><?php }?>
    <tr height="20"><td colspan="2"></td></tr>
    <tr><td>
            <?php
			$sumpagado = 0.00; $sumtotal = 0.00;
			if (empty($_GET['from'])) { $from = date("Y-m-d", mktime(0, 0, 0, date("m")-2, date("d"), date("y"))); }
			else { $from=$_GET['from']; }
			if (empty($_GET['to'])) { $to = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y"))); }
			else { $to=$_GET['to']; }
			$query  = "SELECT *, ventas.id_venta, ventas.codigo, IF(tipo_precio = 'distribuidor',sum(precio_distribuidor*cantidad), sum(precio_cliente*cantidad)) AS total FROM ventas LEFT JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta LEFT JOIN productos ON ventas_productos.id_producto = productos.id_producto LEFT JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE fecha >= '".$from."' AND fecha <= '".$to."'";
			if (@$_GET['show'] == "pendientes") { $query = $query." AND entregado <> 'on'"; }
			$query = $query." GROUP BY ventas.id_venta";
			if (!empty($_GET['order_by'])) { $query = $query." ORDER BY ".$_GET['order_by']; }
			if (!empty($_GET['order_dir'])) { if ($_GET['order_dir'] == "DESC"){ $query = $query." DESC"; }}
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			if($count>=1){
			echo "<table width='100%' border='1'>";
			echo "<tr><td><b>ID</b></td><td><b>CÓDIGO</b></td>";			
			echo "<td><b>FECHA</b></td><td><b>CLIENTE</b></td><td><b>PRODUCTOS</b></td><td><b>ENTREGADO</b></td>";
			echo "<td><b>CANTIDAD PAGADA</b></td><td><b>TOTAL</b></td><td></td></tr>";
			while ($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
			if (!(@$_GET['show'] == "pagados" && @$row['cantidad_pagada'] < @$row['total']) && !(@$_GET['show'] == "no_pagados" && @$row['cantidad_pagada'] >= @$row['total'])){
				echo "<tr><td>".@$row['id_venta']."</td><td>".@$row['codigo']."</td>".
				"<td>".@$row['fecha']."</td><td>".@$row['nombre']."</td>";
				echo "<td><a href='admin_ventas_productos.php?id=".@$row['id_venta']."'>"; 
				$query_ext  = "SELECT * FROM ventas_productos WHERE ventas_productos.id_venta = ".@$row['id_venta']; 
				$result_ext = mysql_query($query_ext); @$count_ext = mysql_num_rows($result_ext); 
				if (empty($count_ext)) { echo "0"; } else { echo $count_ext; }; @mysql_free_result($result_ext); 
                echo "</a></td>";
				echo "<td>"; if (@$row['entregado'] == "on") { echo "Sí"; } else { echo "No"; } echo "</td>";
				$sumpagado=$sumpagado+@$row['cantidad_pagada'];
				echo "<td>".@$row['cantidad_pagada']."</td><td>";
				if ($row['tipo_precio'] == "distribuidor"){ $total_val = @$row['total']; } else { $total_val = @$row['total'];}
				if (empty($total_val)) { echo "0.00"; } else { echo $total_val; } echo "</td>";
				$sumtotal=$sumtotal+$total_val;
				echo "<td width='110'><a href='admin_ventas_edit.php?type=mod&id=".@$row['id_venta']."'>MODIFICAR</a></td></tr>";
			}}
			echo "<tr height='20'><td colspan='9'></td></tr>";
			echo "<tr><td colspan='6'><b>TOTALES</b></td><td>".$sumpagado."</td><td>".$sumtotal."</td><td></td></tr>";
			echo "</table><br />";
			
			} else {
			echo "<br><b>No existen ventas registradas</b>";
			}
			@mysql_free_result($result); 
			?>        
    </tr></td>
   	<?php if (@$_GET["success"] == "add"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">LA VENTA FUE AGREGADA</font></td></tr>
    <?php } else if (@$_GET["success"] == "mod"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">LA VENTA FUE MODIFICADA</font></td></tr>
    <?php } else if (@$_GET["success"] == "del"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">LA VENTA FUE ELIMINADA</font></td></tr>
    <?php } ?>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><a href="admin_ventas_edit.php">AGREGAR NUEVA VENTA</a></td></tr>
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