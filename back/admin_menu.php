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

	<table align="center" class="AdminSystem" width="400" border="0" cellspacing="0" cellpadding="0">
    <tr height="50"><td></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ</font></b></td></tr>
    <tr height="10"><td></td></tr>
    <tr><td>BIENVENIDO <?php echo $_SESSION['adusername']?></td></tr>
    <tr height="20"><td></td></tr>
    <tr><td>
	    <table width="100%" border="1" cellpadding="5" cellspacing="5">
    	<tr><td><b><a href="admin_ventas_edit.php?from=menu">AGREGAR NUEVA VENTA</a></b></td>
    	</tr></table><br />
    	<table width="100%" border="1" cellpadding="5" cellspacing="5">
    	<tr><td><b><a href="admin_ventas.php">REPORTE DE VENTAS</a></b></td>
    	</tr>
    	<tr><td><b><a href="admin_productos.php">REPORTE DE PRODUCTOS</a></b></td>
    	</tr>
    	<tr><td><b><a href="admin_clientes.php">REPORTE DE CLIENTES</a></b></td>
    	</tr>
        </table><br />
    	<table width="100%" border="1" cellpadding="5" cellspacing="5">
    	<tr><td><b><a href="admin_proveedores.php">ADMINISTRAR PROVEEDORES</a></b></td>
    	</tr>
    	<tr><td><b><a href="admin_categorias.php">ADMINISTRAR CATEGORIAS</a></b></td>
    	</tr>
        </table><br />
		<table width="100%" border="1" cellpadding="5" cellspacing="5">
    	<tr><td><b><a href="admin_password.php">CAMBIAR CONTRASEÑA</a></b></td>
    	</tr>
        </table>
    </td></tr>
    <tr height="30"><td></td></tr>
    <tr><td><a href="db_admin.php?type=logout">SALIR DEL SISTEMA</a></td></tr>
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