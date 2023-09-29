<?php


require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';
//require_once '../../../../../xampp/htdocs/Curso/tp5/includes/php/Factory/ActiveRecordFactory.php';
$id = $_GET['idusuario'];
$oUsuario = ActiveRecordFactory::getUsuario();
$oPersona = ActiveRecordFactory::getPersona();
$oTiposDocumentos = ActiveRecordFactory::getTipoDocumento()->fetchAll();
$aTipoUsuario = ActiveRecordFactory::getTipoUsuario()->fetchAll();
$oUsuario->fetch($id);
$idpersona = $oUsuario->getValueObject()->getIdPersona();
$oPersona->fetch($idpersona);

echo "Realmente desea eliminar el Usuario: " .$oUsuario->getValueObject()->getNombre();
echo " perteneciente a " .$oPersona->getValueObject()->getApellido();
echo " ".$oPersona->getValueObject()->getNombre() ."?".'<br/>';
echo '<a href=http://localhost/SGU/eliminar_usuario.php?'.'idusuario='.$id.'&idpersona='.$idpersona.'>Confirmar</a>'; 
echo '<a href=http://localhost/SGU/listar.php?> Volver</a>'; 


?>

