<?php


require_once '../SGU/includes/php/Singleton/Sesion.php';
require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';
$oRegistry = Sesion::getInstancia()->getRegistry();
if ($oRegistry->exists('usuario') == false){
    header("location: index.php");
}
//echo "SESION: " .$_SESSION['id'];
$id =  $_SESSION['id'];
//$id = $_GET['idusuario'];
//echo "EL ID ES: " .$id;
$oUsuario = ActiveRecordFactory::getUsuario();
$oPersona = ActiveRecordFactory::getPersona();
$aTiposDocumentos = ActiveRecordFactory::getTipoDocumento()->fetchAll();
$aTipoUsuario = ActiveRecordFactory::getTipoUsuario()->fetchAll();
//echo "EL ID USUARIO ES: " .$id."<br>";
$oUsuario->fetch($id);
//echo "ID PERSONA DESDE USUARIO: ".$oUsuario->getValueObject()->getIdPersona()."<br>";
$idpersona = $oUsuario->getValueObject()->getIdPersona();
//echo "ID PERSONA idpersona: " .$idpersona."<br>";
$oPersona->fetch($idpersona);
//echo "ID PERSONA DESDE PERSONA: ".$oPersona->getValueObject()->getIdPersona()."<br>";
$oProvincias = array('Entre Rios', 'Sante Fe', 'Cordoba', 'Buenos Aires');
$oSexos = array('M','F');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <style>
    footer{
            margin-top: 7%;
        }
        #td{
            font-weight: bold;
        }
        #derechos{
           font-family: 'Courier New', Courier, monospace;
            font-size: 15px;
        }
    </style>
   <title>Editar</title>
</head>
<body>
    <h2 align="center">Informacion del Usuario</h2>
<table class="border border-dark" align="center" width="40%" border="0">
        <tr>
		    <td>
		        <fieldset class="bg-danger">
                <legend>Informacion Personal</legend>

                  
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                    <form action = "index.php" method ="post">
                        <input type="hidden" name="idusuario" value="<?= $oUsuario->getValueObject()->getIdUsuario(); ?>">
                        <tr>
                            <td id="td" align="right">Nombre de usuario: </td>
                            <td><?php echo $oUsuario->getValueObject()->getNombre(); ?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Contraseña: </td>
                            <td><?php echo $oUsuario->getValueObject()->getContrasenia(); ?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Apellido: </td>
                            <td><?php echo $oPersona->getValueObject()->getApellido(); ?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Nombre: </td>
                            <td><?php echo $oPersona->getValueObject()->getNombre(); ?></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right">Tipo Documento: </td>
                            <td><?php
                                    foreach ($aTiposDocumentos as $oTipoDocumento){
                                        if($oPersona->getValueObject()->getIdTipoDocumento() == $oTipoDocumento['idtipodocumento']){
                                            echo $oTipoDocumento['nombre'];
                                        }
                                    }
                                ?>
                            </td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Documento: </td>
                            <td><?php echo $oPersona->getValueObject()->getNumeroDocumento(); ?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Sexo: </td>
                            <td><?php echo $oPersona->getValueObject()->getSexo()?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Nacionalidad: </td>
                            <td><?php echo $oPersona->getValueObject()->getNacionalidad(); ?></td> 
                        </tr>
            
                     </table>
                                   
               </fieldset>
               </td>  
        </tr>
    </table>
    <table class="border border-dark"  align="center" width="40%" border="0">
        <tr>
		    <td>
               <fieldset class="bg-danger">
                <legend>Informacion de Contacto</legend>

                
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                            <td id="td">Correo Electronico: </td>
                            <td><?php echo $oPersona->getValueObject()->getEmail(); ?></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Telefono: </td>
                            <td><?php echo $oPersona->getValueObject()->getTelefono(); ?></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right">Celular: </td>
                            <td><?php echo $oPersona->getValueObject()->getCelular(); ?></td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Domicilio: </td>
                            <td><?php echo $oPersona->getValueObject()->getDomicilio(); ?></td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Provincia: </td>
                            <td><?php echo $oPersona->getValueObject()->getProvincia(); ?></td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Localidad: </td>
                            <td><?php echo $oPersona->getValueObject()->getLocalidad(); ?></td>  
                        </tr>
                     </table>
                </fieldset>
                <fieldset class="bg-danger border border-dark"> 
                     
                <table align="right">
                    <form action = "" method ="">
                        <td align="right"><input type="submit" value="Salir" name="bt_guardar" size="18" /></td>
                    </form>
                </table>
                    
                          
                  </fieldset>
                  </td>  
        </tr>
    </table> 
    <footer>
            <div class="container-fluid text-wrap" id="derechos">
                <p>Mubashir Gonzalo       -                 Lab GUGLER             -      Para Modificar datos enviar a: <a href="admin@gugler.com.ar/">admin@gugler.com.ar</a></p>
            </div>
    </footer>
</body>
</html>


