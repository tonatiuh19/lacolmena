CREATE TABLE admin
(
	username varchar(50),
	password varchar(50),
	PRIMARY KEY(username)
)

CREATE TABLE categorias
(
	id_categoria int NOT NULL AUTO_INCREMENT,
	nombre varchar(50),
	PRIMARY KEY(id_categoria)
)

CREATE TABLE proveedores
(
	id_proveedor int NOT NULL AUTO_INCREMENT,
	nombre varchar(50),
	direccion varchar(100),
	email varchar(50),
	telefono varchar(50),
	fax varchar(50),
	rfc varchar(50),
	PRIMARY KEY(id_proveedor)
)

CREATE TABLE productos
(
	id_producto int NOT NULL AUTO_INCREMENT,
	nombre varchar(50),
	id_categoria int,
	id_proveedor int,
	descripcion varchar(250),
	codigo varchar(50),
	color varchar(50),
	tamano varchar(50),
	precio_distribuidor double,
	precio_cliente double,
	PRIMARY KEY(id_producto)
)

CREATE TABLE clientes
(
	id_cliente int NOT NULL AUTO_INCREMENT,
	nombre varchar(50),
	apellido varchar(50),
	direccion varchar(50),
	email varchar(50),
	telefono varchar(50),
	tipo_precio varchar(50),
	PRIMARY KEY(id_cliente)
)

CREATE TABLE ventas
(
	id_venta int NOT NULL AUTO_INCREMENT,
	id_cliente int,
	codigo varchar(50),
	cantidad_pagada double,
	entregado varchar(50),
	fecha date,
	PRIMARY KEY(id_venta)
)


CREATE TABLE ventas_productos
(
	id_venta int,
	id_producto int,
	cantidad int
)
