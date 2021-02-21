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

	<table align="center" class="AdminSystem" width="300" border="0" cellspacing="0" cellpadding="0">
    <tr height="100"><td colspan="2"></td></tr>
    <form action="db_admin.php?type=login" method="post">
    <tr><td colspan="2"><b><font color="#006699">SISTEMA DE ADMINISTRADOR</font></b></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td><b>USUARIO</b></td><td><input type="text" name="user" style="width:85px;" /></td></tr>
    <tr height='10'><td colspan='2'></td></tr>
    <tr><td><b>CONTRASEÑA</b></td><td><input type="password" name="password" style="width:85px;" /></td></tr>
	<tr height="20"><td colspan="2"></td></tr>
    <tr height='10'><td colspan='2'></td></tr>
	<tr><td colspan="2"><input name="registersubmit" type="submit" value="Ingresar" /></td></tr>
    <?php if (@$_GET["error"] == "true"){ ?>
    <tr height="20"><td></td></tr>
    <tr><td colspan="2"><font color="#FF0000">NOMBRE DE USUARIO O CONTRASEÑA INCORRECTAS</font></td></tr>
	<?php }?>
    <tr height="30"><td></td></tr>
    <tr><td colspan="2"><a href="index.php">REGRESAR A LA PÁGINA DE INICIO</a></td></tr>
    </form>
    </table>

</body>
</html>

<?php
include 'closedb.php';
?> 