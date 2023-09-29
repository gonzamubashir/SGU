<?php

require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';
//require_once '../../../../../xampp/htdocs/Curso/tp5/includes/php/Factory/ActiveRecordFactory.php';
$oPersona = ActiveRecordFactory::getPersona();
$oUsuario = ActiveRecordFactory::getUsuario();
$oUsuario->fetch($_GET['idusuario']);
$oPersona->fetch($oUsuario->getValueObject()->getIdPersona());

$oUsuarioVO = $oUsuario->getValueObject();
$oPersonaVO = $oPersona->getValueObject();

echo "ID PERSONA DESDE USUARIO: ".$oUsuario->getValueObject()->getIdPersona()."<br>";
echo "ID USUARIO DESDE USUARIO: ".$oUsuario->getValueObject()->getIdUsuario()."<br>";
echo "ID PERSONA DESDE PERSONA: ".$oPersona->getValueObject()->getIdPersona()."<br>";
echo "NOMBRE PERSONA DESDE PERSONA: ".$oPersona->getValueObject()->getNombre()."<br>";
$pdo = BaseDeDatos::getInstancia()->getConexion();
$pdo->beginTransaction();
try
		{
			$oUsuario->delete();
			$oPersona->delete();

			$pdo->commit();

			header('location: listar.php');
		}
		catch(Exception $e)
		{
			$pdo->rollBack();
		}


echo '<a href=listar.php?> Volver</a>';

?>