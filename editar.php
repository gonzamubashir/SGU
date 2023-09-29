<?php



require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';

$id = $_GET['idusuario'];
$oUsuario = ActiveRecordFactory::getUsuario();
$oPersona = ActiveRecordFactory::getPersona();
$oTiposDocumentos = ActiveRecordFactory::getTipoDocumento()->fetchAll();
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
   <style>
        footer{
            margin-top: 15px;
        }
        #td{
            font-weight: bold;
        }
    </style>
   <title>Editar</title>
</head>
<body>
    <h2 align="center">Informacion del Usuario a Modificar</h2>
<table align="center" width="40%" border="0">
        <tr>
		    <td>
		        <fieldset>
                <legend>Informacion Personal</legend>

                  
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                    <form action = "editar_usuario.php" method ="post">
                        <input type="hidden" name="idusuario" value="<?= $oUsuario->getValueObject()->getIdUsuario(); ?>">
                        <tr>
                            <td id="td" align="right">Nombre de usuario: </td>
                            <td><input type="text" name="Usuario" value="<?php echo $oUsuario->getValueObject()->getNombre(); ?>" size="18" /></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Contraseña: </td>
                            <td><input type="text" name="Contrasenia" value="<?php echo $oUsuario->getValueObject()->getContrasenia(); ?>" size="18" /></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Apellido: </td>
                            <td><input type="text" name="Apellido" value=<?php echo $oPersona->getValueObject()->getApellido(); ?> "" size="18" /></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Nombre: </td>
                            <td><input type="text" name="Nombre" value=<?php echo $oPersona->getValueObject()->getNombre(); ?> ""  size="18" /></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right">Tipo Documento: </td>
                            <td>
                                <select name="Tipo">
                            
                                <?php foreach($oTiposDocumentos as $tipoDocumento): ?>
                                        <option 
                                            value="<?=$tipoDocumento['idtipodocumento'];?>" 
                                            <?php 
                                                echo
                                                ($oPersona->getValueObject()->getIdTipoDocumento() == $tipoDocumento['idtipodocumento'])
                                                ? 'selected="selected"'
                                                : '' 
                                            ?>
                                        >
                                            <?=$tipoDocumento['nombre'];?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Documento: </td>
                            <td><input type="text" name="Numerodocumento" value="<?php echo $oPersona->getValueObject()->getNumeroDocumento(); ?>" size="18" /></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Sexo: </td>
                            <td>
                                <?php foreach ($oSexos as $sexo): ?>
                                    <input type="radio" name="Sexo"
                                    value=<?=$sexo;?>
                                    <?php 
                                    echo
                                    ( $oPersona->getValueObject()->getSexo() == $sexo)
                                    ? 'checked="checked"'
                                    : ''
                                    ?>
                                >
                                    <?=$sexo;?><br>
                                <?php endforeach ?>
                            
                            </td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Nacionalidad: </td>
                            <td><input type="text" name="Nacionalidad" value=<?php echo $oPersona->getValueObject()->getNacionalidad(); ?> ""  size="18" /></td> 
                        </tr>
            
                     </table>
                                   
               </fieldset>
               </td>  
        </tr>
    </table>
    <table align="center" width="40%" border="0">
        <tr>
		    <td>
               <fieldset>
                <legend>Informacion de Contacto</legend>

                
                    <table border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                            <td id="td">Correo Electronico: </td>
                            <td><input type="text" name="Email" value="<?php echo $oPersona->getValueObject()->getEmail(); ?>" size="18" /></td>
                        </tr>
                        <tr>
                            <td id="td" align="right">Telefono: </td>
                            <td><input type="text" name="Telefono" value=<?php echo $oPersona->getValueObject()->getTelefono(); ?> ""  size="18" /></td> 
                        </tr>
                        <tr>
                            <td id="td" align="right">Celular: </td>
                            <td><input type="text" name="Celular" value=<?php echo $oPersona->getValueObject()->getCelular(); ?> ""  size="18" /></td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Domicilio: </td>
                            <td><input type="text" name="Domicilio" value="<?php echo $oPersona->getValueObject()->getDomicilio(); ?> "  size="18" /></td>  
                        </tr>
                        <tr>
                            <td id="td" align="right">Provincia: </td>
                            <td>
                                <select name="Provincia">
                                    <?php foreach($oProvincias as $provincia): ?>
                                        <option
                                            value="<?=$provincia;?>"
                                            <?php
                                            echo 
                                                ($oPersona->getValueObject()->getProvincia() == $provincia)
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
                            <td id="td" align="right">Localidad: </td>
                            <td><input type="text" name="Localidad" value="<?php echo $oPersona->getValueObject()->getLocalidad(); ?>"   size="18" /></td>  
                        </tr>
                     </table>
                </fieldset>
                <fieldset> 
                     
                    <table align="right">
                     
                        <td align="right"><input type="submit" value="guardar" name="bt_guardar" size="18" /></td>
                     </form>
                     </table>
                     <table align="left">
                     <form action = "listar.php" method ="">
                    <td align="left"><input type="submit" value="anterior" name="bt_anterior" size="18" /></td>
                     </form>
                    </table>      
                  </fieldset>
                  </td>  
        </tr>
    </table> 
    <footer>
    </footer>
</body>
</html>
<?php


$pdo = null;
$stmtpersona = null;
$stmtusuario = null;

?>