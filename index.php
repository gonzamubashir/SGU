<?php
$token = md5(rand(2,20000));
require_once 'includes/php/Singleton/Sesion.php';
require_once 'includes/php/Factory/ActiveRecordFactory.php';
?>
<?php
$oRegistry = Sesion::getInstancia()->getRegistry();
$oSesion = Sesion::getInstancia();  
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
  $oSesion->destruir();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="includes/js/index.js" ></script>
    <link rel="stylesheet" href="includes/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        footer{
            position: relative;
            margin-top: 24%;
        }
        #tabla{
            position: relative;
            top: 150px;
        }
        #titulo{
            text-align: center;
        }
        #check{
            position: absolute;
            top: 430px;
            right: 29em;
        }
    </style>
    <title>index</title>
</head>
<body>
    
<div class="container-fluid">
    <h1 class="bg-primary">SGU | BIENVENIDO!!</h1>
    <hr></hr>
</div>
<table class="border border-dark" id="tabla" align="center"  width="40%" border="0">
<tr>
	<td>
        <fieldset class="bg-danger">
            <legend id="titulo">Ingrese su Nombre de Usuario</legend>
                <form id="formindex" action ="paso0.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token?>"/>
                    <table border="0" align="center" width="50%" cellpadding="0" cellspacing="10">
                        <tr>
                            <td><label for="Usuario" class="form-label">Nombre de usuario:</label></td>                 <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion -->
                            <td><input type="text" id="Usuario" class="form-control bg-danger border border-dark" name="Usuario" value="<?php echo $oUsuarioVO->getNombre();?>" size="18" /></td> 
                        </tr>
                        <tr>
                            <td><label for="Contrasenia" class="form-label">Contraseña:</label></td>                                <!-- se reemplaza el valor del atributo value utilizando el objeto en sesion  -->
                            <td><input type="password" id="Contrasenia" class="form-control bg-danger border border-dark" name="Contrasenia" value="<?php echo $oUsuarioVO->getContrasenia();?>" size="18" /></td> 
                        </tr>
                    </table>
                    <table align = "right">
                        <td colspan="2" align="right" ><input type="submit" class="form-control btn-primary" id="button1" value="siguiente" name="bt_paso1" size="18" /></td>
                    </table>
                    <tr class="bg-danger border border-dark">
                        <td><label class="form-label bg-danger">¿No tienes usuario? <?php echo '<a href=http://localhost/SGU/paso1.php?>Crear un usuario</a>' ?> </label></td>
                    </tr>  
                </form>
        </fieldset>
    </td>
</tr>
</table>

<div class="container-fluid">
 <footer>
 <p id="check"><?php
    error_reporting(0);
    if($_GET['error'] == "1"){
        echo "NOMBRE DE USUARIO Y/O CONTRASEÑA INCORRECTO";
    } 
?></p>
    <?php include 'includes/php/pie.php'?>
</footer>   
</div>
</body>
</html>
<?php
if (isset($_POST['bt_anterior']))
    $oSesion = Sesion::getInstancia(); 
    $oSesion->destruir(); 
?>