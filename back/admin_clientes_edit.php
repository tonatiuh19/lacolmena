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
    <tr height="100"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > CLIENTES > 
    <?php if (@$_GET['type'] <> "mod"){ ?>AGREGAR NUEVO CLIENTE<?php } else { ?>EDITAR CLIENTES<?php } ?></font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo @$_SESSION['adusername']?></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td>
		<table align="center" class="AdminSubSystem" width="350" border="0" cellspacing="0" cellpadding="0">
        <?php if (@$_GET['type'] <> "mod"){?><form name="formdb" action="db_admin.php?type=clientes_add" method="post">
        <?php } else {?><form name="formdb" action="db_admin.php?type=clientes_mod&id=<?php echo @$_GET['id'] ?>" method="post"><?php }?>
        
		<?php if (@$_GET['type'] == "mod"){ echo "<tr><td width='120'><b>ID</b></td><td>"?>   
        <?php echo "<input name='id_field' type='text' style='width:50px;' readonly value='"
		.@$row['id_cliente']."'/></td></tr><tr height='10'><td colspan='2'></td></tr>"; } ?>
        
	    <tr><td><b>NOMBRE</b></td><td><input name="nombre" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['nombre']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>APELLIDO</b></td><td><input name="apellido" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['apellido']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>DIRECCION</b></td><td><input name="direccion" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['direccion']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>E-MAIL (Opcional)</b></td><td><input name="email" type="text" style="width:200px;" maxlength="50" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['email']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>TELEFONO</b></td><td><input name="telefono" type="text" style="width:200px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['telefono']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
		<tr><td><b>TIPO DE PRECIO</b></td><td>
        <select name="tipo_precio">
			<option value="distribuidor" 
			<?php if (@$_GET['type'] == "mod"){ if (@$row['tipo_precio'] == "distribuidor") { echo " selected "; }} ?>>
            Precio distribuidor</option>
			<option value="cliente" 
			<?php if (@$_GET['type'] == "mod"){ if (@$row['tipo_precio'] == "cliente") { echo " selected "; }}?>>
            Precio cliente</option>
        </select></td></tr>
   	    <tr height="10"><td colspan="2"></td></tr>
    	<?php if (@$_GET["error"] == "blank"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">NO DEJE NINGÚN CAMPO EN BLANCO</font></td></tr>
    	<?php }?>
	    <tr height="20"><td colspan="2"></td></tr>
    	<tr><td colspan="2" align="center">
        <?php if (@$_GET['type'] <> "mod"){?>
        <input name="submit_add" type="submit" value="Registrar nuevo cliente"/>
		<?php } else {?>
        <script type="text/javascript">
		function delete_record(id)
		{
			var name = confirm("¿Seguro que quieres eliminar el cliente?")
			if (name == true){javascript:document.formdb.action="db_admin.php?type=clientes_del&id=" + id;
			document.formdb.submit();}
		}
		</script>
        <input align="right" name="submit_mod" type="submit" value="Modificar cliente"/>
        <input align="right" name="submit_del" type="button" value="Eliminar cliente" onClick="delete_record('<?php echo @$_GET['id'] ?>');"/>
		<?php }?>
		</td></tr>
	    </form>
	    </table>
    </td></tr>
    <tr height="30"><td></td></tr>
    <tr><td colspan="2"><a href="admin_clientes.php">REGRESAR</a></td></tr>
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