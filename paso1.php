<?php
$token = md5(rand(2,20000));
require_once 'includes/php/Singleton/Sesion.php';
require_once 'includes/php/Factory/ActiveRecordFactory.php';
error_reporting(0);
?>
<?php
$oRegistry = Sesion::getInstancia()->getRegistry();
  
   if ($oRegistry->exists('usuario') == false){
        $oUsuarioVO = new UsuarioVO();
   } 
   else 
        $oUsuarioVO = $oRegistry->get('usuario');
    

        if ($oRegistry->exists('persona') == false){
            $oPersonaVO = new PersonaVO();
       } 
       else 
            $oPersonaVO = $oRegistry->get('persona');
            
  $aTipoDocumento = ActiveRecordFactory::getTipoDocumento()->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="includes/js/paso1.js" ></script>
    <link rel="stylesheet" href="includes/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        #p{
            position: absolute;
            top: 480px;
            right: 32em;
        }
    </style>
    <title>Cabecera</title>
</head>
<body>
    
    <?php 
    
    include 'includes/php/cabecera.php';
    
    ?>

<table class="border border-dark" id="tabla" align="center"  width="50%" border="0">
        <tr>
		    <td>
		        <fieldset class="bg-danger">
                <legend>Formulario</legend>

                <form name="validar" id="formpaso1" action ="paso2.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token?>"/>
                    <table border="0" align="center" width="60%" cellpadding="0" cellspacing="10">
                        <tr>
                            <td><label for="Usuario" class="form-label">Nombre de usuario:</label></td>                 <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion -->
                            <td><input type="text" id="Usuario" class="form-control bg-danger border border-dark" name="Usuario" value="<?php echo $oUsuarioVO->getNombre();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Contrasenia" class="form-label">Contraseña:</label></td>                                <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion  -->
                            <td><input type="password" id="Contrasenia" class="form-control bg-danger border border-dark" name="Contrasenia" value="<?php echo $oUsuarioVO->getContrasenia();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Apellido" class="form-label">Apellido:</label></td>                          <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion  -->     
                            <td><input type="text" id="Apellido" class="form-control bg-danger border border-dark" name="Apellido" value="<?php echo  $oPersonaVO->getApellido();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Nombre" class="form-label">Nombre:</label></td>                            <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion  -->
                            <td><input type="text" id="Nombre" class="form-control bg-danger border border-dark" name="Nombre" value="<?php echo $oPersonaVO->getNombre();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td>Tipo Documento:</td>
                            <td>
                                <select class="form-select bg-danger border border-dark"  name="Tipo">
                            
                                <?php foreach($aTipoDocumento as $oTipoDocumento): ?>
                                        <option 
                                            value="<?=$oTipoDocumento['nombre'];?>" 
                                            <?php 
                                                ($oPersonaVO->getTipoDocumento() == $oTipoDocumento['nombre'])
                                                ? 'selected="selected"'
                                                : '' 
                                            ?>
                                        >
                                            <?=$oTipoDocumento['nombre'];?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td><label for="Documento" class="form-label">Documento:</label></td>
                            <td><input type="text" id="Documento" class="form-control bg-danger border border-dark" name="Documento" value="<?php echo $oPersonaVO->getNumeroDocumento();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Sexo" class="form-label">Sexo</label></td>
                            <td>
                            <input class="form-check-input bg-primary border border-dark" type="radio" id="Sexo" name="Sexo" value="M"<?= ( $oPersonaVO->getSexo() == 'M' ) ? 'checked="checked"' : ''  ?>>Masculino<br>
					        <label class="form-check-label" for="Masculino"></label>
                            <input class="form-check-input bg-primary border border-dark" type="radio" id="Sexo" name="Sexo" value="F" <?= ( $oPersonaVO->getSexo() == 'F' ) ? 'checked="checked"' : ''  ?>>Femenino
                            <label class="form-check-label" for="Femenino"></label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Nacionalidad" class="form-label">Nacionalidad:</label></td>
                            <td><input type="text" id="Nacionalidad" class="form-control bg-danger border border-dark" name="Nacionalidad" value=<?php echo $oPersonaVO->getNacionalidad();?> "" size="18" /></td> 
                        </tr>
                    </table>
                    <table align = "right">
                        <td colspan="2" align="right" ><input type="submit" class="form-control btn-primary" id="button1" value="siguiente" name="bt_paso1" size="18" /></td>
                    </table>
                </form>  
                <table align="left">
                    <form action = "index.php" method ="post">
                        <input type="hidden" name="token" value="<?php echo $token?>"/>
                        <td align="left"><input type="submit" class="form-control btn-primary" value="anterior" name="bt_anterior" size="18" /></td>
                    </form>
                </table>                
                </fieldset>
            </td>  
        </tr>
    </table>

<footer>
<p id="p"><?php
    error_reporting(0);
    if($_GET['error'] == "1"){
        echo "NOMBRE DE USUARIO YA EXISTENTE";
    }
    if($_GET['error'] == "3"){
        echo "DEBES INGRESAR UN SEXO";
    }  
?></p>
    <?php include 'includes/php/pie.php'?>
</footer>
</body>
</html>
