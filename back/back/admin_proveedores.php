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
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > PROVEEDORES</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo $_SESSION['adusername']?></td></tr>
    <tr height="20"><td colspan="2"></td></tr>
    <tr><td>
            <?php
			$query  = "SELECT * FROM proveedores"; $result = mysql_query($query);
			$count=mysql_num_rows($result);
			if($count>=1){
			echo "<table width='100%' border='1'>";
			echo "<tr><td><b>ID</b></td><td><b>NOMBRE</b></td>";			
			echo "<td><b>DIRECCIÓN</b></td><td><b>E-MAIL</b></td><td><b>TELÉFONO</b></td><td><b>FAX</b></td><td><b>RFC</b></td><td><b>TELÉFONO</b></td></tr>";			
			while ($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "<tr><td>".@$row['id_proveedor']."</td><td>".@$row['nombre']."</td>".
				"<td>".@$row['direccion']."</td><td>".@$row['email']."</td><td width='150'>".@$row['telefono']."</td>".
				"<td width='150'>".@$row['fax']."</td><td>".@$row['rfc']."</td>".
				"<td width='110'><a href='admin_proveedores_edit.php?type=mod&id=".@$row['id_proveedor']."'>MODIFICAR</a></td></tr>";
			}
			echo "</table><br />";
			} else {
			echo "<br><b>No existen proveedores registrados</b>";
			}
			@mysql_free_result($result); 
			?>        
    </tr></td>
   	<?php if (@$_GET["success"] == "add"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PROVEEDOR FUE AGREGADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "mod"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PROVEEDOR FUE MODIFICADO</font></td></tr>
    <?php } else if (@$_GET["success"] == "del"){ ?>
    <tr height="10"><td></td></tr><tr><td><font color="#FF0000">EL PROVEEDOR FUE ELIMINADO</font></td></tr>
    <?php } ?>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><a href="admin_proveedores_edit.php">AGREGAR NUEVO PROVEEDOR</a></td></tr>
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