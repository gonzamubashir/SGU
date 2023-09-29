<?php
    $token = md5(rand(2,20000));
    require_once 'includes/php/Singleton/Sesion.php';
    require_once 'includes/php/Factory/ActiveRecordFactory.php';
    error_reporting(0);

    $oRegistry = Sesion::getInstancia()->getRegistry();
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

        $oUsuario2 = ActiveRecordFactory::getUsuario();
        $nombre = $_POST['Usuario'];  
        $oUsuario2->buscarUsuario($nombre);
        if($oUsuario2->getValueObject()->getNombre() != ''){
            header("location: paso1.php?error=1");
        }
    if (isset($_POST['bt_paso1'])){
        

        $oUsuarioVO->setIdTipoUsuario(2); // 
       
        if (ctype_graph(htmlentities($_POST['Usuario'])) ) {
            $oUsuarioVO->setNombre(htmlentities($_POST['Usuario']));    
        }
        else
            header("location: paso1.php");
        if (ctype_graph(htmlentities($_POST['Contrasenia'])) ) {
                $oUsuarioVO->setContrasenia(htmlentities($_POST['Contrasenia']));    
            }
        else
            header("location: paso1.php");
       
        if (ctype_alpha(htmlentities($_POST['Apellido']))){
                $oPersonaVO->setApellido(htmlentities($_POST['Apellido']));
        } 
        else    
            header("location: paso1.php");
       
        if (ctype_alpha(htmlentities($_POST['Nombre']))){
                $oPersonaVO->setNombre(htmlentities($_POST['Nombre']));
        } 
        else    
            header("location: paso1.php");
        if (ctype_digit(htmlentities($_POST['Documento']))){
            $oPersonaVO->setNumeroDocumento(htmlentities($_POST['Documento']));
        }
        else    
            header("location: paso1.php?");
        
        if (ctype_graph(htmlentities($_POST['Tipo'])) ) {
            $oPersonaVO->setTipoDocumento(htmlentities($_POST['Tipo']));    
        }
        else
            header("location: paso1.php");
        
        if (ctype_alpha(htmlentities($_POST['Nacionalidad']))){
            $oPersonaVO->setNacionalidad(htmlentities($_POST['Nacionalidad']));
        } 
        else    
            header("location: paso1.php");
        
        $oPersonaVO->setSexo(htmlentities($_POST['Sexo']));
       
        $oUsuario = ActiveRecordFactory::getUsuario(); 
	    $oUsuario->setValueObject($oUsuarioVO);
        $oPersona = ActiveRecordFactory::getPersona();
        $oPersona->setValueObject($oPersonaVO);
        
        //if ($oUsuario2->getValueObject()->getNombre())
        if  ($oUsuarioVO->getNombre() =="" or $oUsuarioVO->getContrasenia()=="" or $oPersonaVO->getApellido() ==""
        or $oPersonaVO->getNombre() =="" or $oPersonaVO->getNumeroDocumento() =="" or $oPersonaVO->getNacionalidad() ==""
        or $oPersonaVO->getSexo()=="" ){
            header("location: paso1.php?");
        }
        else if ($oUsuario->validarContrasenia($oUsuarioVO->getContrasenia())
            == false){
             header("location: paso1.php");
            }
        
        
         
    } 

    $aProvincias = array('Entre Rios', 'Sante Fe', 'Cordoba', 'Buenos Aires');

    $oRegistry->add('persona', $oPersonaVO);
    $oRegistry->add('usuario', $oUsuarioVO);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="includes/js/paso22.js" ></script>
    <link rel="stylesheet" href="includes/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        footer{
            margin-top: 16%;
        }
    </style>
    <title>Paso2</title>
</head>

<body>
<?php 
    
    include 'includes/php/cabecera.php';
    
?>
    
    <table class="border border-dark" id="tabla" align="center" width="50%" border="0">
        <tr>
            
		    <td>
		        <fieldset class="bg-danger">
                <legend>Informacion de Contacto</legend>
                <table>
                <form id="formpaso2" action ="paso3.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token?>"/>
                    <table border="0" align="center" width="60%" cellpadding="0" cellspacing="10">
                        <tr>
                            <td><label for="Email" class="form-label">Correo:</label></td>
                            <td><input type="text" id="Email" name="Email" class="form-control bg-danger border border-dark" value="<?php echo $oPersonaVO->getEmail();?>"  size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Telefono" class="form-label">Telefono:</label></td>
                            <td><input type="text" id="Telefono" name="Telefono" class="form-control bg-danger border border-dark" value="<?php echo $oPersonaVO->getTelefono();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Celular" class="form-label">Celular:</label></td>
                            <td><input type="text" id="Celular" name="Celular" class="form-control bg-danger border border-dark" value="<?php echo $oPersonaVO->getCelular();?>"  size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Domicilio" class="form-label">Domicilio:</label></td>
                            <td><input type="text" id="Domicilio" name="Domicilio" class="form-control bg-danger border border-dark" value="<?php echo $oPersonaVO->getDomicilio();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Provincia" class="form-label">Provincia:</label></td>
                            <td>
                                <select class="form-select bg-danger border border-dark" name="Provincia">
                                    <?php foreach($aProvincias as $provincia): ?>
                                        <option
                                            value="<?=$provincia;?>"
                                            <?php
                                                ($oPersonaVO->getProvincia() == $provincia)
                                                ? 'selected="selected"'
                                                : ''
                                            ?>
                                        >
                                            <?=$provincia;?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                              
                                
                            </td> 
                        </tr>
                        <tr>
                            <td><label for="Localidad" class="form-label">Localidad:</label></td>
                            <td><input type="text" id="Localidad" name="Localidad" class="form-control bg-danger border border-dark" value="<?php echo $oPersonaVO->getLocalidad(); ?>" size="18" /></td> 
                        </tr>
                    </table>   
                    <table align ="right"> 
                    <td align="right"><input type="submit" class="form-control btn-primary" id="siguiente" value="siguiente" name="bt_paso2"/></td>
                    </table>
                </form>
                    <table align="left">
                    <form id="formpaso1" action ="paso1.php" method="post">
                        <input type="hidden" name="token" value="<?php echo $token?>"/>
                        <td align="left"><input type="submit" class="form-control btn-primary" id="anterior" value="anterior" name="bt_anterior"/></td>
                    </form>    
                    </table>  

               
                
                </table>
                </fieldset>
            </td>

            
        </tr>
        
    </table>
    <?php 
        error_reporting(0);
        if($_GET['error'] == "si"){
            echo "ALGUNOS DE LOS CAMPOS DE CONTACTO ES INCORRECTO";
        } 
            
        ?>
    <footer>
    <?php include'includes/php/pie.php'; ?>
    </footer>
</body>
</html>




<?php

/*
    if (isset($_POST['bt_paso1'])){
        
        
        $_SESSION['Persona']->setNombre($_POST['Nombre']);
        $_SESSION['Persona']->setApellido($_POST['Apellido']);
        $_SESSION['Persona']->setNumeroDocumento($_POST['Documento']);
        $_SESSION['Persona']->setNacionalidad($_POST['Nacionalidad']);
        foreach($oTiposDocumentos as $tipoDocumento){
            if($tipoDocumento->getIdTipoDocumento() == $_POST['Tipo']){

                $_SESSION['Persona']->setTipoDocumento($tipoDocumento);

            }
        }
        foreach($oSexos as $sexo){
            if($sexo->getIdSexo() == $_POST['Sexo']){

                $_SESSION['Persona']->setSexo($sexo);

            }
        }
        $_SESSION['Persona']->setUsuario(new Usuario($contra, $_POST['Usuario']));
    }
        if (isset($_POST['bt_anterior'])){
            session_start();
            echo "LOCALIDAD: ".$_SESSION['Persona']->getLocalidad();
        }
*/        
?>
