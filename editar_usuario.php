<?php
require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';
//require_once '../../../../../xampp/htdocs/Curso/tp5/includes/php/Factory/ActiveRecordFactory.php';
$oPersona = ActiveRecordFactory::getPersona();
$oUsuario = ActiveRecordFactory::getUsuario();



If (isset($_POST['bt_guardar'])){

    $oUsuario->fetch($_POST['idusuario']);
	$oPersona->fetch($oUsuario->getValueObject()->getIdPersona());

	$oUsuarioVO = $oUsuario->getValueObject();
	$oPersonaVO = $oPersona->getValueObject();

/*
    $oUsuarioVO->setNombre($_POST['Usuario']);
    $oUsuarioVO->setContrasenia($_POST['Contrasenia']);
    $oPersonaVO->setApellido($_POST['Apellido']);
    $oPersonaVO->setNombre($_POST['Nombre']);
    $oPersonaVO->setNumeroDocumento($_POST['Numerodocumento']);
    $oPersonaVO->setSexo($_POST['Sexo']);
    $oPersonaVO->setNacionalidad($_POST['Nacionalidad']);
    $oPersonaVO->setEmail($_POST['Email']);
    $oPersonaVO->setTelefono($_POST['Telefono']);
    $oPersonaVO->setCelular($_POST['Celular']);
    $oPersonaVO->setIdTipoDocumento($_POST['Tipo']);
    $oPersonaVO->setDomicilio($_POST['Domicilio']);
    $oPersonaVO->setProvincia($_POST['Provincia']);
    $oPersonaVO->setLocalidad($_POST['Localidad']);
*/
if (ctype_graph(htmlentities($_POST['Usuario'])) ) {
    $oUsuarioVO->setNombre(htmlentities($_POST['Usuario']));    
}
else
    header("location: editar.php");
if (ctype_graph(htmlentities($_POST['Contrasenia'])) ) {
        $oUsuarioVO->setContrasenia(htmlentities($_POST['Contrasenia']));    
    }
else
    header("location: editar.php");

if (ctype_alpha(htmlentities($_POST['Apellido']))){
        $oPersonaVO->setApellido(htmlentities($_POST['Apellido']));
} 
else    
    header("location: editar.php");

if (ctype_alpha(htmlentities($_POST['Nombre']))){
        $oPersonaVO->setNombre(htmlentities($_POST['Nombre']));
} 
else    
    header("location: editar.php");
if (ctype_digit(htmlentities($_POST['Documento']))){
    $oPersonaVO->setNumeroDocumento(htmlentities($_POST['Documento']));
}
else    
    header("location: editar.php?");

if (ctype_graph(htmlentities($_POST['Tipo'])) ) {
    $oPersonaVO->setTipoDocumento(htmlentities($_POST['Tipo']));    
}
else
    header("location: editar.php");

if (ctype_alpha(htmlentities($_POST['Nacionalidad']))){
    $oPersonaVO->setNacionalidad(htmlentities($_POST['Nacionalidad']));
} 
else    
    header("location: editar.php");
    
$oPersonaVO->setSexo(htmlentities($_POST['Sexo']));

if (ctype_graph(htmlentities($_POST['Email'])) ) {
    $oPersonaVO->setEmail(htmlentities($_POST['Email']));    
}
else
header("location: editar.php");
$oPersonaVO->setTelefono(htmlentities($_POST['Telefono']));
$oPersonaVO->setCelular(htmlentities($_POST['Celular']));
$oPersonaVO->setDomicilio(htmlentities($_POST['Domicilio']));
if (htmlentities($_POST['Provincia'])){
$oPersonaVO->setProvincia(htmlentities($_POST['Provincia']));    
}
else
header("location: editar.php");
if (htmlentities($_POST['Localidad'])){
$oPersonaVO->setLocalidad(htmlentities($_POST['Localidad']));
} 
else    
header("location: editar.php");    



    $oUsuario->setValueObject($oUsuarioVO);
	$oPersona->setValueObject($oPersonaVO);
    $pdo = BaseDeDatos::getInstancia()->getConexion();
    $pdo->beginTransaction(); 
        if  ($oUsuarioVO->getNombre() =="" or $oUsuarioVO->getContrasenia()==""){
            echo "NOMBRE DE USUARIO O CONTRASENIA VACIO";
            $pdo->rollBack();
        }
        else if ($oUsuario->validarContrasenia($oUsuarioVO->getContrasenia()) == false){
             echo "LA CONTRASENIA NO CUMPLE CON LO REQUIERIDO";
             $pdo->rollBack();
            }
        else if ($_POST['Sexo'] ==""){
            echo "EL SEXO ES UN CAMPO REQUIERIDO";
            $pdo->rollBack();
        }
        try
		{
			$oUsuario->update();
			$oPersona->update();

			$pdo->commit();

			header('location: listar.php');
		}
		catch(Exception $e)
		{
			$pdo->rollBack();
		}
    }

  
echo '<a href=listar.php?></a>';
?>