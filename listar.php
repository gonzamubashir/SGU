
<?php

require_once '../SGU/includes/php/Singleton/Sesion.php';
require_once '../SGU/includes/php/Singleton/BaseDeDatos.php';


$oRegistry = Sesion::getInstancia()->getRegistry();

if ($oRegistry->exists('usuario') == false){
        header("location: index.php");
}

$pdo = BaseDeDatos::getInstancia()->getConexion();



$query1 = "SELECT U.idusuario, U.nombre as 'nombreusuario', P.idpersona, P.nombre, P.apellido, P.nombre, T.nombre as'tipodocumento', P.numerodocumento, P.email 
        FROM usuario U inner join persona P on U.idpersona = P.idpersona
        inner join tipodocumento T on P.idtipodocumento = T.idtipodocumento 
        order by U.idusuario asc ";
//var_dump($query1);
//$query2 = "SELECT nombre from usuario where "

$stmt1 = $pdo->prepare($query1);
$stmt1->execute();
//var_dump($pdo);
//$stmt2 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
//var_dump($stmt2);
//echo "<br>";

while ($unaFila = $stmt1->fetch(PDO::FETCH_ASSOC)){
        echo "Identificador Usuario: " .$unaFila['idusuario'].'<br/>';
        echo "Usuario: " .$unaFila['nombreusuario'].'<br/>';
        echo "Apellido y Nombre: " .$unaFila['apellido']. " " .$unaFila['nombre']. '<br/>';
        echo "Tipo Documento: " .$unaFila['tipodocumento'].'<br/>';
        echo "Numero de Documento: " .$unaFila['numerodocumento'].'<br/>';
        echo "Email: " .$unaFila['email'].'<br/>';
        echo "Acciones: " .'<a href=http://localhost/SGU/editar.php?'.'idusuario='.$unaFila['idusuario'].'&idpersona='.$unaFila['idpersona'].'>Editar</a>'; 
        echo '<a href=http://localhost/SGU/eliminar.php?'.'idusuario='.$unaFila['idusuario'].'&idpersona='.$unaFila['idpersona'].'> Eliminar</a>';
        echo '<br/>'.'<br/>';
}
echo '<a href=http://localhost/SGU/index.php?>SALIR</a>';
echo '<br/>'.'<br/>';
$pdo = null;
$stmtpersona = null;
$stmtusuario = null;


?>