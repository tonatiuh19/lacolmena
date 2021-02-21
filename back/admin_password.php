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
    
    <?php if (@$_GET['type'] == "mod"){ 
	$sql_type="SELECT * FROM clientes WHERE id_cliente='".@$_GET['id']."'";
	$result_type = mysql_query($sql_type);
	$row = @mysql_fetch_array($result_type, MYSQL_ASSOC);
	} ?>

	<table align="center" class="AdminSystem" width="600" border="0" cellspacing="0" cellpadding="0">
    <tr height="60"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > CAMBIAR CONTRASEÑA</font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo @$_SESSION['adusername']?></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td>
		<table align="center" class="AdminSubSystem" width="350" border="0" cellspacing="0" cellpadding="0">
        
        <?php if (@$_GET["success"] == "mod"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2" align="center"><font color="#FF0000">LA CONTRASEÑA FUE MODIFICADA CON ÉXITO</font></td></tr>
        <?php } else { ?>
		
        <form name="formdb" action="db_admin.php?type=password_change" method="post">
        
	    <tr><td><b>CONTRASEÑA ACTUAL</b></td><td>
        <input name="pass_act" type="password" style="width:100px;" maxlength="20" /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>CONTRASEÑA NUEVA</b></td><td>
        <input name="pass_new" type="password" style="width:100px;" maxlength="20" /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>REPETIR NUEVA CONTRASEÑA</b></td><td>
        <input name="pass_rew" type="password" style="width:100px;" maxlength="20" /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
    	<?php if (@$_GET["error"] == "blank"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">NO DEJE NINGÚN CAMPO EN BLANCO</font></td></tr>
    	<?php } else if (@$_GET["error"] == "badpass"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">LA CONTRASEÑA ACTUAL NO ES CORRECTA</font></td></tr>
    	<?php } else if (@$_GET["error"] == "match"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">LAS NUEVAS CONTRASEÑAS NO COINCIDEN</font></td></tr>
    	<?php }?>
	    <tr height="20"><td colspan="2"></td></tr>
    	<tr><td colspan="2" align="center">
        <input name="submit_change" type="submit" value="Cambiar contraseña"/>
		</td></tr>
	    </form>
        
        <?php } ?>
        
	    </table>
    </td></tr>
    <tr height="30"><td></td></tr>
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
	
	@mysql_free_result($result_type); 
	?>

</body>
</html>

<?php
include 'closedb.php';
?> 