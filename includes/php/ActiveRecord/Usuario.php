<?php



require_once '../SGU/includes/php/ValueObject/UsuarioVO.php';
require_once '../SGU/includes/php/Singleton/BaseDeDatos.php';

class Usuario {
    private $valueObjectU;
    //private $_conexion;

    public function getValueObject(){
        return $this->valueObjectU;
    }

    public function setValueObject(UsuarioVO $oValueObjectU){
        $this->valueObjectU = $oValueObjectU;
    }

    public function fetch($id){
       
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
          
            $sql = "SELECT * FROM usuario WHERE idusuario = $id";
            
            $stmt = $pdo->prepare($sql);
           
            $stmt->execute();
            $unaFila = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo "Identificador Usuario: " .$unaFila['idusuario'].'<br/>';
                //echo "Usuario: " .$unaFila['nombre'].'<br/>';
                //$resultado = $stmt->fetchObject();
            $objeto = new UsuarioVO();
            $objeto->setIdUsuario($unaFila['idusuario']);
            $objeto->setIdPersona($unaFila['idpersona']);
            $objeto->setIdTipoUsuario($unaFila['idtipousuario']);
            $objeto->setNombre($unaFila['nombre']);
            $objeto->setContrasenia($unaFila['contrasenia']);
             $this->valueObjectU = $objeto;
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }
    public function buscarUsuario($nombre){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";
            
            $stmt = $pdo->prepare($sql);
           
            $stmt->execute();
            $unaFila = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo "Identificador Usuario: " .$unaFila['idusuario'].'<br/>';
                //echo "Usuario: " .$unaFila['nombre'].'<br/>';
                //$resultado = $stmt->fetchObject();
            $objeto = new UsuarioVO();
            $objeto->setIdUsuario($unaFila['idusuario']);
            $objeto->setIdPersona($unaFila['idpersona']);
            $objeto->setIdTipoUsuario($unaFila['idtipousuario']);
            $objeto->setNombre($unaFila['nombre']);
            $objeto->setContrasenia($unaFila['contrasenia']);
             $this->valueObjectU = $objeto;
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }

     /*   $query = "select * from usuario where idusuario = $id";

		$stmt = $pdo->query($query);

        $vo = null;

        $resultado =  $stmt->fetch();
        if ($resultado != null){
            $vo = new UsuarioVO($resultado->idusuario,$resultado->idpersona,$resultado->idtipousuario,$resultado->nombre,$resultado->contrasenia);
       */    
            /* $vo->idUsuario = $resultado->idusuario;
			$vo->idPersona = $resultado->idpersona;
			$vo->idTipoUsuario = $resultado->idtipousuario;
			$vo->getNombre() = $resultado->nombre;
			$vo->getContrasenia() = $resultado->contrasenia;
            */
        
    //    }

    //    $this->valueObject = $vo;
    //}

    public function insert(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        
            $sql = "INSERT into usuario (idpersona,idtipousuario,nombre,contrasenia)
            values(:idpersona, :idtipousuario, :nombre, :contrasenia)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(':idpersona', $this->valueObjectU->getIdPersona(),PDO::PARAM_STR);
            $stmt->bindValue(':idtipousuario', $this->valueObjectU->getIdTipoUsuario(),PDO::PARAM_STR);
            $stmt->bindValue(':nombre', $this->valueObjectU->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':contrasenia', $this->valueObjectU->getContrasenia(),PDO::PARAM_STR);
            $stmt->execute();

            $this->valueObjectU->setIdUsuario($pdo->lastInsertId());
      
        
         //values($this->valueObject->idPersona,'$this->valueObject->idTipoUsuario', '$this->valueObject->nombre', '$this->valueObject->contrasenia')";

       // $pdo->query($query);
        //$this->valueObject->idUsuario = $pdo->lastInsertId();
    }

    public function update(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        try {
            $sql = "UPDATE usuario set idpersona = :idpersona, idtipousuario = :idtipousuario,
                    nombre = :nombre, contrasenia = :contrasenia WHERE idusuario = :idusuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idpersona', $this->valueObjectU->getIdPersona(),PDO::PARAM_STR);
            $stmt->bindValue(':idtipousuario', $this->valueObjectU->getIdTipoUsuario(),PDO::PARAM_STR);
            $stmt->bindValue(':nombre', $this->valueObjectU->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':contrasenia', $this->valueObjectU->getContrasenia(),PDO::PARAM_STR);
            $stmt->bindValue(':idusuario', $this->valueObjectU->getIdUsuario(),PDO::PARAM_INT);
            $stmt->execute();
            
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;

    }

    public function delete (){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        try {
            $sql = "DELETE FROM usuario WHERE idusuario = :idusuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idusuario', $this->valueObjectU->getIdUsuario(),PDO::PARAM_INT);
            $stmt->execute();
            
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;

    }
    public function validarContrasenia($contrasenia){
        
        if (strlen($contrasenia) < 6){
            
            return false;
        }
        else {
            
            $x = 0;
            $y = 0;
            for ($i=0;$i<strlen($contrasenia);$i++){
                
                for ($j=65;$j<123;$j++){
                    if ($contrasenia[$i]  == chr($j)){
                        $x++;
                        
                    }
                }
    
                for($k=0;$k<10;$k++){
                    if($contrasenia[$i] == $k){
                        $y++;
                        
                    }
                }
            }
            if($x>0 and $y>0){
                
                return true;
            }
            else {
                
                return false;
            }
        }
    }
    public function getContraseniaEnmascarada($contrasenia){
        $contra = "";
        for ($i=0;$i<strlen($contrasenia);$i++){
            $contra = $contra."*";
        }
        return $contra;
    }
    
}

?>