<?php
require_once 'includes/php/Singleton/Sesion.php';
require_once 'includes/php/Factory/ActiveRecordFactory.php';
$oRegistry = Sesion::getInstancia()->getRegistry();
$oSesion = Sesion::getInstancia();
$pdo = BaseDeDatos::getInstancia()->getConexion();

    if ($oRegistry->exists('persona') == false){
        $oPersonaVO = new PersonaVO();
   } 
   else 
        $oPersonaVO = $oRegistry->get('persona');

    if ($oRegistry->exists('usuario') == false){
        $oUsuarioVO = new UsuarioVO();
        
   } 
   else 
        $oUsuarioVO = $oRegistry->get('usuario');
    $aTipoDocumento = ActiveRecordFactory::getTipoDocumento()->fetchAll();
   foreach ($aTipoDocumento as $tipoDocumento){
    if($tipoDocumento['nombre'] = $oPersonaVO->getTipoDocumento()){
        $idTipoDocumento = $tipoDocumento['idtipodocumento'];
    }
   }

   $pdo->beginTransaction();

   try {
    $oPersona = ActiveRecordFactory::getPersona();
	$oUsuario = ActiveRecordFactory::getUsuario();

    $oPersona->setValueObject($oPersonaVO);
	$oUsuario->setValueObject($oUsuarioVO);

    $oPersona->insert();
    echo "ID PERSONA DESDE PERSONA: " .$oPersonaVO->getIdPersona()."<br>";
    $oUsuario->getValueObject()->setIdPersona($oPersonaVO->getIdPersona());
    echo "ID PERSONA DESDE USUARIO: " .$oUsuarioVO->getIdPersona()."<br>";
    $oUsuario->insert();
    $pdo->commit();
    $oSesion->destruir();
	header('location: exito.php');

   }
   catch (Exception $e) {
       $pdo->rollBack();
       header('location: error.php');
    }
?>