# SGU
Sistema de Gestion de Usuarios
$dsn = 'mysql:host=127.0.0.1:port=3306';
$user = 'id21240636_sgu_usuario';
$pass ='Gonzi_011'

$dbh = new PDO($dsn, $user, $pass);

$result = $dbh->exec('CREATE DATABASE sgu ')

if(!result){
	print_r($dbh->errorInfo());
}

$dbh->exec('USE sgu');

$sql = "CREATE TABLE tipodocumento(
idtipodocumento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(60) NOT NULL,
descripcion VARCHAR(60);)";

$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$sql = "CREATE TABLE tipousuario(
idtipousuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(60),
descripcion VARCHAR(60)
);";

$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$sql = "CREATE TABLE persona(
idpersona INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idtipodocumento int NOT NULL,
apellido VARCHAR(60) NOT NULL,
nombre VARCHAR(60) NOT NULL,
numerodocumento INT NOT NULL,
sexo VARCHAR(1) NOT NULL,
nacionalidad VARCHAR(10),
email VARCHAR(100) NOT NULL,
telefono VARCHAR(20),
celular VARCHAR(20),
provincia VARCHAR(100),
localidad VARCHAR(100),
domicilio VARCHAR(100),
FOREIGN KEY (idtipodocumento) REFERENCES tipodocumento (idtipodocumento););";

$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$sql = "CREATE TABLE usuario(
idusuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
idpersona INT(11) NOT NULL,
idtipousuario INT(11) NOT NULL,
nombre VARCHAR(60) NOT NULL,
contrasenia VARCHAR(60) NOT NULL,
FOREIGN KEY (idpersona) REFERENCES persona (idpersona););";

$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO tipodocumento (nombre,descripcion) VALUES ("DNI","Documento Nacional de Identidad");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO tipodocumento (nombre,descripcion) VALUES ("LC","Libreta Civica");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO tipodocumento (nombre,descripcion) VALUES ("LE","Libreta de Enrolamiento");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO tipousuario (nombre,descripcion) VALUES ("Administrador","Usuario Administrador");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO tipousuario (nombre,descripcion) VALUES ("Normal","Usuario Normal");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO persona (idtipodocumento,apellido, nombre, numerodocumento, sexo, email) VALUES (1,"Administrador","Usuario",0, "M", "admin@sgu.com.ar");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}

$insert = "INSERT INTO usuario (idpersona, idtipousuario, nombre, contrasenia) VALUES (1,1,"admin","admin");";
$result = $dbh->exec($sql);

if(!$result){
	print_r($dbh->errorInfo());
}
