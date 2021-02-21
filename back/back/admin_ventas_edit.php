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
	$sql_type="SELECT * FROM ventas WHERE id_venta='".@$_GET['id']."'";
	$result_type = mysql_query($sql_type);
	$row = @mysql_fetch_array($result_type, MYSQL_ASSOC);
	} ?>

	<table align="center" class="AdminSystem" width="600" border="0" cellspacing="0" cellpadding="0">
    <tr height="100"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > VENTAS > 
    <?php if (@$_GET['type'] <> "mod"){ ?>AGREGAR NUEVA VENTA<?php } else { ?>EDITAR VENTAS<?php } ?></font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo @$_SESSION['adusername']?></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td>
		<table align="center" class="AdminSubSystem" width="400" border="0" cellspacing="0" cellpadding="0">
        <?php if (@$_GET['type'] <> "mod"){?><form name="formdb" action="db_admin.php?type=ventas_add" method="post">
        <?php } else {?><form name="formdb" action="db_admin.php?type=ventas_mod&id=<?php echo @$_GET['id'] ?>" method="post"><?php }?>
        
		<?php if (@$_GET['type'] == "mod"){ echo "<tr><td width='150'><b>ID</b></td><td>"?>   
        <?php echo "<input name='id_field' type='text' style='width:50px;' readonly value='"
		.@$row['id_venta']."'/></td></tr><tr height='10'><td colspan='2'></td></tr>"; } ?>
        
	    <tr>
	      <td><b>CÓDIGO (Opcional)</b></td>
	      <td><input name="codigo" type="text" style="width:200px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['codigo']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
   	    <tr><td><b>FECHA (aaaa-mm-dd)</b></td><td><input name="fecha" type="text" style="width:200px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['fecha']."'"; } 
		else { echo "value='".date('Y-m-d')."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>CLIENTE</b></td><td>
        
	    <select size="4" name="id_cliente">
        <?php
		$query  = "SELECT * FROM clientes ";
		$result = mysql_query($query);
        while ($row_type = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<option value='".$row_type['id_cliente']."'";
			if (@$row_type['id_cliente'] == @$row['id_cliente']) { echo " selected "; }
			echo ">".$row_type['nombre']."</option>";
		}?>
        </select>

        </td></tr>
        <tr height="10"><td colspan="2"></td></tr>
   	    <tr><td><b>CANTIDAD PAGADA</b></td><td><input name="cantidad_pagada" type="text" style="width:100px;" maxlength="15" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['cantidad_pagada']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>¿ENTREGADO?</b></td><td>
        <input type="checkbox" name="entregado" 
		<?php if (@$_GET['type'] == "mod"){ if (@$row['entregado'] == "on") { echo "checked"; }} ?>>
        </td></tr>
        <tr height="10"><td colspan="2"></td></tr>
    	<?php if (@$_GET["error"] == "blank"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">NO DEJE NINGÚN CAMPO EN BLANCO</font></td></tr>
	    <?php } else if (@$_GET["error"] == "numeric"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">INDIQUE UN VALOR NUMÉRICO VÁLIDO EN EL CAMPO DE CANTIDAD PAGADA</font></td></tr>
	    <?php } else if (@$_GET["error"] == "date"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">INDIQUE UN VALOR CORRECTO EN EL CAMPO FECHA</font></td></tr>
    	<?php }?>
	    <tr height="20"><td colspan="2"></td></tr>
    	<tr><td colspan="2" align="center">
        <?php if (@$_GET['type'] <> "mod"){?>
        <input name="submit_add" type="submit" value="Registrar nueva venta y agregar productos"/>
		<?php } else {?>
        <script type="text/javascript">
		function delete_record(id)
		{
			var name = confirm("¿Seguro que quieres eliminar la venta?")
			if (name == true){javascript:document.formdb.action="db_admin.php?type=ventas_del&id=" + id;
			document.formdb.submit();}
		}
		</script>
        <input align="right" name="submit_mod" type="submit" value="Modificar venta"/>
        <input align="right" name="submit_del" type="button" value="Eliminar venta" onClick="delete_record('<?php echo @$_GET['id'] ?>');"/>
		<?php }?>
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
	?>

</body>
</html>

<?php
include 'closedb.php';
?> 