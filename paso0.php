<?php

require_once '../SGU/includes/php/Singleton/Sesion.php';
require_once '../SGU/includes/php/Factory/ActiveRecordFactory.php';

?>
<?php

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

      
    if (isset($_POST['bt_paso1'])){
    
    
            if(ctype_graph(htmlentities($_POST['Usuario'])) == 'admin' and ctype_graph(htmlentities($_POST['Contrasenia'])) == 'admin'){
                header("location: listar.php");       
            }
            else {
                $oUsuario = ActiveRecordFactory::getUsuario();
                $nombre = $_POST['Usuario'];
                if($oUsuario->buscarUsuario($nombre)){
                    if ($oUsuario->getValueObject()->getContrasenia() == $_POST['Contrasenia']){
                        $id =  $oUsuario->getValueObject()->getIdUsuario();
                        $_SESSION['id'] = $id;
                        echo "SESION: " .$_SESSION['id'];
                        header("location: ver.php"); 
                        //header("location: ver.php? idusuario=$id");
                    }
                    else{
                        header("location: index.php?error=1");    
                    }
                }
                else {
                    header("location: index.php");
                }
            }
            if($_POST['Usuario'] == ' ' || $_POST['Contrasenia'] ==''){
                header("location: index.php"); 
            }
    }
    $oRegistry->add('usuario', $oUsuarioVO);
?>
