<?php



require_once '../SGU/includes/php/ValueObject/TipoDocumentoVO.php';
require_once '../SGU/includes/php/Singleton/BaseDeDatos.php';

class TipoDocumento {
    private $valueObjectTD;

    public function getValueObject(){
        return $this->valueObjectTD;
    }

    public function setValueObject(TipoDocumentoVO $oValueObjectTD){
        $this->valueObjectTD = $oValueObjectTD;
    }

    public function fetch($id){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        try {
            $sql = "SELECT * FROM tipodocumento WHERE idtipodocumento = :idtipodocumento";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idtipodocumento', $id,PDO::PARAM_INT);
            $stmt->execute();
            
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return $resultado = $stmt->fetch(PDO::FETCH_OBJ);;

    }

    public function insert(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "INSERT into tipodocumento (null,nombre,descripcion)
            values(:nombre, :descripcion)";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':nombre', $this->valueObjectTD->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $this->valueObjectTD->getDescripcion(),PDO::PARAM_STR);
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
            $sql = "UPDATE tipodocumento SET nombre = :nombre, descripcion = :descripcion 
            WHERE idtipodocumento = :idtipodocumento ";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':nombre', $this->valueObjectTD->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':contrasenia', $this->valueObjectTD->getDescripcion(),PDO::PARAM_STR);
            $stmt->bindValue(':idtipodocumento', $this->valueObjectTD->getIdTipoDocumento(),PDO::PARAM_STR);
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
            $sql = "DELETE FROm tipodocumento WHERE idtipodocumento = :idtipodocumento ";
            $stmt = $pdo->prepapre($sql);
            $stmt->bindValue(':idtipodocumento', $this->valueObjectTD->getIdTipoUsuario(),PDO::PARAM_STR);
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

        $sql = "SELECT * FROM tipodocumento";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $arreglo = array();
        /*while ($unaFila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $arreglo [] = $unaFila;
        }*/
        while ( $unaFila = $stmt->fetch(PDO::FETCH_ASSOC) ){
            //$unaFila =  $stmt->fetchObject();
            
            $arreglo[] = $unaFila;
            
        }

        //var_dump($stmt->fetch(PDO::FETCH_OBJ));
        return $arreglo;
    }
}
 /*$oTipo = new TipoDocumento();
 $retorno = $oTipo->fetchAll();
 foreach ($retorno as $valor){
        echo $valor['idtipodocumento'].'<br/>';
        echo $valor['nombre'].'<br/>';
        echo $valor['descripcion'].'<br/>';
        
 }
 */
?>