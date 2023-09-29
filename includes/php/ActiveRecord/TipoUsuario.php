<?php




require_once '../SGU/includes/php/ValueObject/TipoUsuarioVO.php';
require_once '../SGU/includes/php/Singleton/BaseDeDatos.php';

class TipoUsuario {
    private $valueObjectTU;

    public function getValueObject(){
        return $this->valueObjectTU;
    }

    public function setValueObject(TipoUsuarioVO $oValueObjectTU){
        $this->valueObjectTU = $oValueObjectTU;
    }
    public function fetch($id){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        try {
            $sql = "SELECT * FROM tipousuario WHERE idtipousuario = :idtipousuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idtipousuario', $id,PDO::PARAM_INT);
            $stmt->execute();
            
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;

    }
    
    public function insert(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "INSERT into tipousuario (null,nombre,descripcion)
            values(:nombre, :descripcion)";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':nombre', $this->valueObjectTU->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $this->valueObjectTU->getDescripcion(),PDO::PARAM_STR);
            $stmt->execute();

        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }

    public function update(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "UPDATE tipousuario SET nombre = :nombre, descripcion = :descripcion 
            WHERE idtipousuario = :idtipousuario ";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':nombre', $this->valueObjectTU->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':contrasenia', $this->valueObjectTU->getDescripcion(),PDO::PARAM_STR);
            $stmt->bindValue(':idtipousuario', $this->valueObjectTU->getIdTipoUsuario(),PDO::PARAM_STR);
            $stmt->execute();

        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }

    public function detele(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "DELETE FROm tipousuario WHERE idtipousuario = :idtipousuario ";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':idtipousuario', $this->valueObjectTU->getIdTipoUsuario(),PDO::PARAM_STR);
            $stmt->execute();

        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }
    public function fetchAll(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        $sql = "SELECT * FROM tipousuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $arreglo = array();
        while ( ( $stmt->fetchObject() ) != false ){
            $unaFila =  $stmt->fetchObject();
            $arreglo[] = $unaFila;
            //$stmt->execute();
        }
        return $arreglo;
    }

}



?>