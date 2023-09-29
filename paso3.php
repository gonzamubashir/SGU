<?php
$token = md5(rand(2,20000));
require_once 'includes/php/Singleton/Sesion.php';
require_once 'includes/php/Factory/ActiveRecordFactory.php';
$oRegistry = Sesion::getInstancia()->getRegistry();

   if ($oRegistry->exists('usuario') == false){
        $oUsuarioVO = new UsuarioVO;
   } 
   else 
        $oUsuarioVO = $oRegistry->get('usuario');
    if ($oRegistry->exists('persona') == false){
        $oPersonaVO = new PersonaVO();
    } 
    else 
        $oPersonaVO = $oRegistry->get('persona'); 
   
    $aProvincias = array('Entre Rios', 'Sante Fe', 'Cordoba', 'Buenos Aires');
    if (isset($_POST['bt_paso2'])){
        if (ctype_graph(htmlentities($_POST['Email'])) ) {
                $oPersonaVO->setEmail(htmlentities($_POST['Email']));    
            }
        else
            header("location: paso2.php");
        $oPersonaVO->setTelefono(htmlentities($_POST['Telefono']));
        $oPersonaVO->setCelular(htmlentities($_POST['Celular']));
        $oPersonaVO->setDomicilio(htmlentities($_POST['Domicilio']));
        if (htmlentities($_POST['Provincia'])){
            $oPersonaVO->setProvincia(htmlentities($_POST['Provincia']));    
        }
        else
            header("location: paso2.php");
        if (ctype_alpha(htmlentities($_POST['Localidad']))){
            $oPersonaVO->setLocalidad(htmlentities($_POST['Localidad']));
        } 
        else    
            header("location: paso2.php");    
    
        $oRegistry->add('persona', $oPersonaVO);
        $oUsuario = ActiveRecordFactory::getUsuario(); 
        $oUsuario->setValueObject($oUsuarioVO);
        $oPersona = ActiveRecordFactory::getPersona();
        $oPersona->setValueObject($oPersonaVO);

        //Valido Contactos

        if ($oPersona->validarContacto(Persona::TIPO_EMAIL, $oPersonaVO->getEmail()) == false){
            header("location: paso2.php");
        }
        if($oPersonaVO->getCelular()!= ''){
            if ($oPersona->validarContacto(Persona::TIPO_TELEFONO, $oPersonaVO->getCelular()) == false){
                header("location: paso2.php");
            }
        }
        if($oPersonaVO->getTelefono()!= ''){
            if ($oPersona->validarContacto(Persona::TIPO_TELEFONO, $oPersonaVO->getTelefono()) == false){
                header("location: paso2.php");
            }
        }
        if($oPersonaVO->getDomicilio() == '' or $oPersonaVO->getLocalidad() == '' ){
            header("location: paso2.php");
        }
        
  }
 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="includes/js/paso3.js" ></script>
    <link rel="stylesheet" href="includes/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        #td{
            font-weight: bold;
        }
        p{
            margin-right: 10px;
        }
    </style>
    <title>Paso3</title>
</head>
<body>
<?php 
    
    include 'includes/php/cabecera.php';
    
?>
<h2  id="tabla" align="center">Informacion del Usuario</h2>
<table class="border border-dark" id="tabla" align="center" width="40%" border="0">
        <tr>
		    <td>
		        <fieldset class="bg-danger">
                <legend>Informacion Personal</legend>

                  
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                            <td id="td" align="right"><p>Nombre de usuario:</p></td>
                            <td><p><?php echo $oUsuarioVO->getNombre()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Contraseña:</p></td>
                            <td><p><?php echo $oUsuario->getContraseniaEnmascarada($oUsuarioVO->getContrasenia());?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Apellido:</p></td>
                            <td><p><?php echo $oPersonaVO->getApellido();?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Nombre:</p></td>
                            <td><p><?php echo $oPersonaVO->getNombre();?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Tipo Documento:</p></td>
                            <td align="left"><p><?php echo $oPersonaVO->getTipoDocumento()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Documento:</p></td>
                            <td><p><?php echo $oPersonaVO->getNumeroDocumento();?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Sexo:</p></td>
                            <td><p><?php echo $oPersonaVO->getSexo()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Nacionalidad:</p></td>
                            <td><p><?php echo $oPersonaVO->getNacionalidad();?></p></td> 
                        </tr>
                     </table>
                                   
               </fieldset>
               </td>  
        </tr>
    </table>
    <table class="border border-dark" id="tabla" align="center" width="40%" border="0">
        <tr>
		    <td>
               <fieldset class="bg-danger">
                <legend>Informacion de Contacto</legend>

                
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                            <td id="td"><p>Correo Electronico:</p></td>
                            <td><p><?php echo $oPersonaVO->getEmail()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Telefono:</p></td>
                            <td><p><?php echo $oPersonaVO->getTelefono()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Celular:</p></td>
                            <td align="left"><p><?php echo $oPersonaVO->getCelular()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Domicilio:</p></td>
                            <td><p><?php echo $oPersonaVO->getDomicilio()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Provincia:</p></td>
                            <td><p><?php echo $oPersonaVO->getProvincia()?></p></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right"><p>Localidad:</p></td>
                            <td><p><?php echo $oPersonaVO->getLocalidad()?></p></td> 
                        </tr>
                     </table>
                </fieldset>
                <fieldset class="bg-danger border border-dark"> 
                     <table align="left">
                     <form action = "paso2.php" method ="post">
                        <input type="hidden" name="token" value="<?php echo $token?>"/>
                        <td align="left"><input type="submit" class="form-control btn-primary" value="anterior" name="bt_anterior" size="18" /></td>
                     </form>
                    </table>
                    <table align="right">
                     <form action = "finalizar.php" method ="post">
                        <input type="hidden" name="token" value="<?php echo $token?>"/>
                        <td align="right"><input type="submit" class="form-control btn-primary" value="guardar" name="bt_guardar" size="18" /></td>
                     </form>
                     </table>      
                  </fieldset>
                  </td>  
        </tr>
    </table> 
    <footer>
        <?php
            include'includes/php/pie.php';
        ?>
    </footer>
</body>
</html>


