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
	$sql="SELECT * FROM admin WHERE username='".@$_SESSION['adusername']."' and password='".@$_SESSION['adpassword']."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count>=1){
	?>

	<table align="center" class="AdminSystem" width="600" border="0" cellspacing="0" cellpadding="0">
    <tr height="100"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > VENTAS > AGREGAR PRODUCTO A LA VENTA</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo @$_SESSION['adusername']?></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td>
		<table align="center" class="AdminSubSystem" width="400" border="0" cellspacing="0" cellpadding="0">
        
        <?php
		$sql_aux="SELECT * FROM ventas LEFT JOIN clientes ON clientes.id_cliente = ventas.id_cliente WHERE id_venta='".
		@$_GET['id']."'";
		$result_aux = mysql_query($sql_aux);
		$row_aux = mysql_fetch_array($result_aux, MYSQL_ASSOC);
		$sql_type="SELECT * FROM ventas_productos LEFT JOIN productos ON ventas_productos.id_producto = productos.id_producto WHERE id_venta='".@$_GET['id']."'";
		$result_type = mysql_query($sql_type);
		@$count_type = mysql_num_rows($result_type);
		if($count_type>=1){?>
        	<tr><td colspan='2'><table width="100%" border="1" align="center">
			<tr><td colspan='5' align="center"><b>LISTA DE PRODUCTOS AGREGADOS A LA VENTA
            <?php if ($row_aux['tipo_precio'] == "distribuidor"){ echo "( DISTRIBUIDOR )";} else { echo "( CLIENTE )";}?></b></td></tr>
			<tr><td align="center"><b>PRODUCTO</b></td><td align="center"><b>CANTIDAD</b></td><td align="center"><b>PRECIO UNITARIO</b></td><td align="center"><b>PRECIO TOTAL</b></td><td></td></tr>
            
			<?php $sumcost=0; while ($row_type = mysql_fetch_array($result_type, MYSQL_ASSOC)) {
				echo "<tr><td>".$row_type['nombre']."</td><td>".$row_type['cantidad']."</td><td>";
				if ($row_aux['tipo_precio'] == "distribuidor") { echo $row_type['precio_distribuidor']; }
				else { echo $row_type['precio_cliente']; } echo "</td><td>";
				if ($row_aux['tipo_precio'] == "distribuidor"){ echo $row_type['precio_distribuidor']*$row_type['cantidad']; 
				$sumcost = $sumcost + ($row_type['precio_distribuidor']*$row_type['cantidad']); }
				else { echo $row_type['precio_cliente']*$row_type['cantidad']; 
				$sumcost = $sumcost + ($row_type['precio_cliente']*$row_type['cantidad']); } echo "</td>";
				echo "<td align='center'><a href='db_admin.php?type=ventas_productos_del&id="
				.$row_type['id_venta_producto']."&id_venta=".@$_GET['id']."'>ELIMINAR</a></td></tr>";
			}
			echo "<tr><td colspan='3'><b>VENTA TOTAL</b></td><td>".$sumcost."</td><td></td></tr>";
			?>
            
            </table></td></tr><tr height="30"><td colspan="2"></td></tr>
            <?php
		}
		?>
        
        <form name="formdb" action="db_admin.php?type=ventas_productos_add&id=<?php echo @$_GET['id'] ?>" method="post">
        
		<?php echo "<tr><td width='150'><b>ID</b></td><td>" 
        ."<input name='id_venta' type='text' style='width:50px;' readonly value='"
		.@$_GET['id']."'/></td></tr><tr height='10'><td colspan='2'></td></tr>"; ?>
        
	    <tr><td><b>PRODUCTO</b></td><td>
        
	    <select size="4" name="id_producto">
        <?php
		$query  = "SELECT * FROM productos ";
		$result = mysql_query($query);
		$firstopt = true;
        while ($row_type = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<option value='".$row_type['id_producto']."'";
			if ($firstopt==true){ echo "selected"; $firstopt=false; }
			echo ">".$row_type['nombre']."</option>";
		}?>
        </select>

        </td></tr>
        <tr height="10"><td colspan="2"></td></tr>
   	    <tr><td><b>CANTIDAD</b></td><td><input name="cantidad" 
        type="text" style="width:100px;" maxlength="15" value="0" /></td></tr>
	    <tr height="20"><td colspan="2"></td></tr>
    	<tr><td colspan="2" align="center">
        <input name="submit_add" type="submit" value="Agregar producto"/>
		</td></tr>
	    </form>
	    </table>
    </td></tr>
    <tr height="30"><td></td></tr>
    <tr><td colspan="2"><a href="<?php if (@$_GET["from"] == "menu"){ echo "admin_menu.php"; } else { echo "admin_ventas.php"; }?>">REGRESAR</a></td></tr>
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
	
	@mysql_free_result($result_type); 
	@mysql_free_result($result_aux); 
	?>

</body>
</html>

<?php
include 'closedb.php';
?> 