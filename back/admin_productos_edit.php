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
	$sql_type="SELECT * FROM productos WHERE id_producto='".@$_GET['id']."'";
	$result_type = mysql_query($sql_type);
	$row = @mysql_fetch_array($result_type, MYSQL_ASSOC);
	} ?>

	<table align="center" class="AdminSystem" width="600" border="0" cellspacing="0" cellpadding="0">
    <tr height="100"><td colspan="2"></td></tr>
    <tr><td><b><font color="#006699">SISTEMA DE ADMINISTRADOR > MENÚ > PRODUCTOS > 
    <?php if (@$_GET['type'] <> "mod"){ ?>AGREGAR NUEVO PRODUCTO<?php } else { ?>EDITAR PRODUCTOS<?php } ?></font></b></td></tr>
    <tr height="10"><td colspan="2"></td></tr>
    <tr><td>ADMINISTRADOR: <?php echo @$_SESSION['adusername']?></td></tr>
    <tr height="30"><td colspan="2"></td></tr>
    <tr><td>
		<table align="center" class="AdminSubSystem" width="400" border="0" cellspacing="0" cellpadding="0">
        <?php if (@$_GET['type'] <> "mod"){?><form name="formdb" action="db_admin.php?type=productos_add" method="post">
        <?php } else {?><form name="formdb" action="db_admin.php?type=productos_mod&id=<?php echo @$_GET['id'] ?>" method="post"><?php }?>
        
		<?php if (@$_GET['type'] == "mod"){ echo "<tr><td width='150'><b>ID</b></td><td>"?>   
        <?php echo "<input name='id_field' type='text' style='width:50px;' readonly value='"
		.@$row['id_producto']."'/></td></tr><tr height='10'><td colspan='2'></td></tr>"; } ?>
        
	    <tr><td><b>CÓDIGO</b></td><td><input name="codigo" type="text" style="width:100px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['codigo']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
        <tr><td><b>NOMBRE</b></td><td><input name="nombre" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['nombre']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>PROVEEDOR</b></td><td>
        
	    <select name="id_proveedor">
        <?php
		$query  = "SELECT * FROM proveedores ";
		$result = mysql_query($query);
        while ($row_type = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<option value='".$row_type['id_proveedor']."'";
			if (@$row_type['id_proveedor'] == @$row['id_proveedor']) { echo " selected "; }
			echo ">".$row_type['nombre']."</option>";
		}?>
        </select>

        </td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>CATEGORÍA</b></td><td>
        
	    <select name="id_categoria">
        <?php
		$query  = "SELECT * FROM categorias ";
		$result = mysql_query($query);
        while ($row_type = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<option value='".$row_type['id_categoria']."'";
			if (@$row_type['id_categoria'] == @$row['id_categoria']) { echo " selected "; }
			echo ">".$row_type['nombre']."</option>";
		}?>
        </select>

        </td></tr>
        <tr height="10"><td colspan="2"></td></tr>
	    <tr><td><b>DESCRIPCION</b></td><td><textarea name="descripcion" cols="30" rows="3"><?php if (@$_GET['type'] == "mod"){ echo @$row['descripcion']; } ?></textarea></td></tr>
	    <tr height="10"><td colspan="2"></td></tr>
        <tr><td><b>COLOR (Opcional)</b></td><td><input name="color" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['color']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
        <tr><td><b>TAMAÑO (Opcional)</b></td><td><input name="tamano" type="text" style="width:200px;" maxlength="100" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['tamano']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
        <tr><td><b>PRECIO DISTRIBUIDOR</b></td><td><input name="precio_distribuidor" type="text" style="width:100px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['precio_distribuidor']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
        <tr><td><b>PRECIO CLIENTE</b></td><td><input name="precio_cliente" type="text" style="width:100px;" maxlength="20" 
		<?php if (@$_GET['type'] == "mod"){ echo "value='".@$row['precio_cliente']."'"; } ?> /></td></tr>
        <tr height="10"><td colspan="2"></td></tr>
    	<?php if (@$_GET["error"] == "blank"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">NO DEJE NINGÚN CAMPO NO OPCIONAL EN BLANCO</font></td></tr>
	    <?php } else if (@$_GET["error"] == "numeric"){ ?>
	    <tr height="10"><td colspan="2"></td></tr>
	    <tr><td colspan="2"><font color="#FF0000">INDIQUE UN VALOR NUMÉRICO VÁLIDO EN EL CAMPO DE PRECIO</font></td></tr>
    	<?php }?>
	    <tr height="20"><td colspan="2"></td></tr>
    	<tr><td colspan="2" align="center">
        <?php if (@$_GET['type'] <> "mod"){?>
        <input name="submit_add" type="submit" value="Registrar nuevo producto"/>
		<?php } else {?>
        <script type="text/javascript">
		function delete_record(id)
		{
			var name = confirm("¿Seguro que quieres eliminar el producto?")
			if (name == true){javascript:document.formdb.action="db_admin.php?type=productos_del&id=" + id;
			document.formdb.submit();}
		}
		</script>
        <input align="right" name="submit_mod" type="submit" value="Modificar producto"/>
        <input align="right" name="submit_del" type="button" value="Eliminar producto" onClick="delete_record('<?php echo @$_GET['id'] ?>');"/>
		<?php }?>
		</td></tr>
	    </form>
	    </table>
    </td></tr>
    <tr height="30"><td></td></tr>
    <tr><td colspan="2"><a href="admin_productos.php">REGRESAR</a></td></tr>
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