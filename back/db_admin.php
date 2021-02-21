<?php
session_start(); 
include 'opendb.php';

function isDate($i_sDate)
{
  $blnValid = TRUE;
   // check the format first (may not be necessary as we use checkdate() below)
   if(!ereg ("^[0-9]{4}-[0-9]{2}-[0-9]{2}$", $i_sDate))
   {
    $blnValid = FALSE;
   }
   else //format is okay, check that days, months, years are okay
   {
      $arrDate = explode("-", $i_sDate); // break up date by slash
      $intDay = $arrDate[2];
      $intMonth = $arrDate[1];
      $intYear = $arrDate[0];
 
      $intIsDate = checkdate($intMonth, $intDay, $intYear);
   
     if(!$intIsDate)
     {
        $blnValid = FALSE;
     }
 
   }//end else
   
   return ($blnValid);
} //end function isDate

if ($_GET["type"] == "login"){

	$adusername = $_POST['user']; 
	$adpassword = $_POST['password'];
	$adusername = stripslashes($adusername);
	$adpassword = stripslashes($adpassword);
	$adusername = mysql_real_escape_string($adusername);
	$adpassword = mysql_real_escape_string($adpassword);

	$sql="SELECT * FROM admin WHERE username='$adusername' and password='$adpassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);
	if($count>=1){
		$_SESSION['adusername'] = $adusername;
		$_SESSION['adpassword'] = $adpassword;
		header("location:admin_menu.php");
	} else {
		header("location:admin.php?error=true");
	}	

ob_end_flush();

} else if ($_GET["type"] == "logout"){

	session_destroy();
	header("location:admin.php");
	
} else if ($_GET["type"] == "categorias_add"){

	if (empty($_POST["nombre"])){
		header("location:admin_categorias_edit.php?error=blank");
	} else {
		$sql = "INSERT INTO categorias (nombre) ".
		"VALUES ('$_POST[nombre]')";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_categorias.php?success=add");
	}

} else if ($_GET["type"] == "categorias_mod"){

	if (empty($_POST["nombre"])){
		header("location:admin_categorias_edit.php?type=mod&id=".$_GET["id"]."&error=blank");
	} else {
		$sql = "UPDATE categorias SET nombre='$_POST[nombre]' WHERE id_categoria='".$_GET['id']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_categorias.php?success=mod");
	}

} else if ($_GET["type"] == "categorias_del"){

	$sql = "DELETE FROM categorias WHERE id_categoria='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_categorias.php?success=del");

} else if ($_GET["type"] == "proveedores_add"){

	if (empty($_POST["nombre"]) || empty($_POST["direccion"]) || empty($_POST["telefono"])){
		header("location:admin_proveedores_edit.php?error=blank");
	} else {
		$sql = "INSERT INTO proveedores (nombre,direccion,email,telefono,fax,rfc) ".
		"VALUES ('$_POST[nombre]','$_POST[direccion]','$_POST[email]','$_POST[telefono]','$_POST[fax]','$_POST[rfc]')";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_proveedores.php?success=add");
	}

} else if ($_GET["type"] == "proveedores_mod"){

	if (empty($_POST["nombre"]) || empty($_POST["direccion"]) || empty($_POST["telefono"])){
		header("location:admin_proveedores_edit.php?type=mod&id=".$_GET["id"]."&error=blank");
	} else {
		$sql = "UPDATE proveedores SET nombre='$_POST[nombre]', direccion='$_POST[direccion]', email='$_POST[email]', telefono='$_POST[telefono]', fax='$_POST[fax]', rfc='$_POST[rfc]' WHERE id_proveedor='".$_GET['id']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_proveedores.php?success=mod");
	}

} else if ($_GET["type"] == "proveedores_del"){

	$sql = "DELETE FROM proveedores WHERE id_proveedor='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_proveedores.php?success=del");

} else if ($_GET["type"] == "clientes_add"){

	if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["direccion"]) || empty($_POST["telefono"])){
		header("location:admin_clientes_edit.php?error=blank");
	} else {
		$sql = "INSERT INTO clientes (nombre,apellido,direccion,email,telefono,tipo_precio) ".
		"VALUES ('$_POST[nombre]','$_POST[apellido]','$_POST[direccion]','$_POST[email]','$_POST[telefono]','$_POST[tipo_precio]')";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_clientes.php?success=add");
	}

} else if ($_GET["type"] == "clientes_mod"){

	if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["direccion"]) || empty($_POST["telefono"])){
		header("location:admin_clientes_edit.php?type=mod&id=".$_GET["id"]."&error=blank");
	} else {
		$sql = "UPDATE clientes SET nombre='$_POST[nombre]', apellido='$_POST[apellido]', direccion='$_POST[direccion]',  email='$_POST[email]', telefono='$_POST[telefono]', tipo_precio='$_POST[tipo_precio]' WHERE id_cliente='".$_GET['id']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_clientes.php?success=mod");
	}

} else if ($_GET["type"] == "clientes_del"){

	$sql = "DELETE FROM clientes WHERE id_cliente='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_clientes.php?success=del");
	
} else if ($_GET["type"] == "productos_add"){

	if (empty($_POST["codigo"]) || empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["precio_distribuidor"]) || empty($_POST["precio_cliente"])){
		header("location:admin_productos_edit.php?error=blank");
	} else if (!is_numeric($_POST["precio_distribuidor"]) || !is_numeric($_POST["precio_cliente"])){
		header("location:admin_productos_edit.php?error=numeric");
	} else {
		$sql = "INSERT INTO productos (codigo,nombre,id_proveedor,id_categoria,descripcion,color,tamano,precio_distribuidor,precio_cliente) ".
		"VALUES ('$_POST[codigo]', '$_POST[nombre]', '$_POST[id_proveedor]', '$_POST[id_categoria]', '$_POST[descripcion]', '$_POST[color]', '$_POST[tamano]', '$_POST[precio_distribuidor]', $_POST[precio_cliente])";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_productos.php?success=add");
	}

} else if ($_GET["type"] == "productos_mod"){

	if (empty($_POST["codigo"]) || empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["precio_distribuidor"]) || empty($_POST["precio_cliente"])){
		header("location:admin_productos_edit.php?type=mod&id=".$_GET["id"]."&error=blank");
	} else if (!is_numeric($_POST["precio_distribuidor"]) || !is_numeric($_POST["precio_cliente"])){
		header("location:admin_productos_edit.php?type=mod&id=".$_GET["id"]."&error=numeric");
	} else {
		$sql = "UPDATE productos SET codigo='$_POST[codigo]', nombre='$_POST[nombre]', id_proveedor='$_POST[id_proveedor]', id_categoria='$_POST[id_categoria]', descripcion='$_POST[descripcion]', color='$_POST[color]', tamano='$_POST[tamano]', precio_distribuidor='$_POST[precio_distribuidor]', precio_cliente='$_POST[precio_cliente]' WHERE id_producto='".$_GET['id']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_productos.php?success=mod");
	}

} else if ($_GET["type"] == "productos_del"){

	$sql = "DELETE FROM productos WHERE id_producto='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_productos.php?success=del");
	
} else if ($_GET["type"] == "ventas_add"){

	if (empty($_POST["fecha"]) || empty($_POST["id_cliente"])){
		header("location:admin_ventas_edit.php?error=blank");
	} else if (!isDate($_POST["fecha"])){
		header("location:admin_ventas_edit.php?error=date");
	} else if (!is_numeric($_POST["cantidad_pagada"])){
		header("location:admin_ventas_edit.php?error=numeric");
	} else {
		$sql = "INSERT INTO ventas (codigo,fecha,id_cliente,cantidad_pagada,entregado) ".
		"VALUES ('$_POST[codigo]','$_POST[fecha]','$_POST[id_cliente]',$_POST[cantidad_pagada],'$_POST[entregado]')";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
		$query_ext  = "SELECT max(id_venta) AS Last FROM ventas";
		$result_ext = mysql_query($query_ext); $row_ext = @mysql_fetch_array($result_ext, MYSQL_ASSOC);
 		header("location:admin_ventas_productos.php?id=".$row_ext['Last']);
	}

} else if ($_GET["type"] == "ventas_mod"){

	if (empty($_POST["fecha"]) || empty($_POST["id_cliente"])){
		header("location:admin_ventas_edit.php?type=mod&id=".$_GET["id"]."&error=blank");
	} else if (!isDate($_POST["fecha"])){
		header("location:admin_ventas_edit.php?type=mod&id=".$_GET["id"]."&error=date");
	} else if (!is_numeric($_POST["cantidad_pagada"])){
		header("location:admin_ventas_edit.php?type=mod&id=".$_GET["id"]."&error=numeric");
	} else {
		$sql = "UPDATE ventas SET codigo='$_POST[codigo]', fecha='$_POST[fecha]', id_cliente='$_POST[id_cliente]', cantidad_pagada=$_POST[cantidad_pagada], entregado='$_POST[entregado]' WHERE id_venta='".$_GET['id']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_ventas.php?success=mod");
	}

} else if ($_GET["type"] == "ventas_del"){

	$sql = "DELETE FROM ventas WHERE id_venta='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_ventas.php?success=del");
	
} else if ($_GET["type"] == "ventas_productos_add"){

	if (!is_numeric($_POST["cantidad"])){
		header("location:admin_ventas_productos.php?error=numeric");
	} else {
		$sql = "INSERT INTO ventas_productos (id_venta, id_producto, cantidad) ".
		"VALUES ('$_POST[id_venta]', '$_POST[id_producto]', $_POST[cantidad])";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
 		header("location:admin_ventas_productos.php?id=".$_POST[id_venta]);
	}
	
} else if ($_GET["type"] == "ventas_productos_del"){

	$sql = "DELETE FROM ventas_productos WHERE id_venta_producto='".$_GET['id']."'";
	if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
	header("location:admin_ventas_productos.php?id=".$_GET['id_venta']);
	
} else if ($_GET["type"] == "password_change"){

	if (empty($_POST["pass_act"]) || empty($_POST["pass_new"]) || empty($_POST["pass_rew"])){
		header("location:admin_password.php?error=blank");
	} else if ($_POST["pass_act"] <> @$_SESSION['adpassword']){
		header("location:admin_password.php?error=badpass");
	} else if ($_POST["pass_new"] <> $_POST["pass_rew"]){
		header("location:admin_password.php?error=match");
	} else {
		$sql = "UPDATE admin SET password='$_POST[pass_new]'".
		"WHERE username='".@$_SESSION['adusername']."' and password='".@$_SESSION['adpassword']."'";
		if (!mysql_query($sql,$conn)) { die('Error: ' . mysql_error()); }
		@$_SESSION['adpassword'] = $_POST[pass_new];
 		header("location:admin_password.php?success=mod");
	}
	
} else if ($_GET["type"] == "filtro_ventas"){

	if (!isDate($_POST["from"]) || !isDate($_POST["to"])){
		header("location:admin_ventas.php?order_by=".$_POST["order_by"]."&order_dir=".$_POST["order_dir"].
		"&show=".$_POST["show"]."&clientes.nombre=".$_POST["clientes.nombre"]."&error=date");
	} else {
 		header("location:admin_ventas.php?order_by=".$_POST["order_by"]."&order_dir=".$_POST["order_dir"].
		"&show=".$_POST["show"]."&clientes.nombre=".$_POST["clientes.nombre"]."&from=".$_POST["from"]."&to=".$_POST["to"]);
	}
	
} else if ($_GET["type"] == "filtro_productos"){

 	header("location:admin_productos.php?order_by=".$_POST["order_by"]."&order_dir=".$_POST["order_dir"].
	"&id_proveedor=".$_POST["id_proveedor"]."&id_categoria=".$_POST["id_categoria"]);

} else if ($_GET["type"] == "filtro_clientes"){

 	header("location:admin_clientes.php?order_by=".$_POST["order_by"]."&order_dir=".$_POST["order_dir"].
	"&show=".$_POST["show"]);
}

include 'closedb.php';
?> 
