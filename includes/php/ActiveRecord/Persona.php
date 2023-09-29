<?php



require_once '../SGU/includes/php/ValueObject/PersonaVO.php';
require_once '../SGU/includes/php/Singleton/BaseDeDatos.php';

class Persona {
    const TIPO_TELEFONO = 1;
    const TIPO_EMAIL = 2;
    private $valueObjectP;

    public function getValueObject(){
        return $this->valueObjectP;
    }

    public function setValueObject(PersonaVO $oValueObjectP){
        $this->valueObjectP = $oValueObjectP;
    }

    public function fetch($id){
        $pdo = BaseDeDatos::getInstancia()->getConexion();

        try {
            $sql = "SELECT * FROM persona WHERE idpersona = $id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $unaFila = $stmt->fetch(PDO::FETCH_ASSOC);
            $objeto = new PersonaVO();
            $objeto->setIdPersona($unaFila['idpersona']);
            $objeto->setIdTipoDocumento($unaFila['idtipodocumento']);
            $objeto->setApellido($unaFila['apellido']);
            $objeto->setNombre($unaFila['nombre']);
            $objeto->setSexo($unaFila['sexo']);
            $objeto->setNacionalidad($unaFila['nacionalidad']);
            $objeto->setEmail($unaFila['email']);
            $objeto->setNumeroDocumento($unaFila['numerodocumento']);
            $objeto->setTelefono($unaFila['telefono']);
            $objeto->setCelular($unaFila['celular']);
            $objeto->setProvincia($unaFila['provincia']);
            $objeto->setLocalidad($unaFila['localidad']);
            $objeto->setDomicilio($unaFila['domicilio']);
            //echo "Identificador PERSONA: " .$unaFila['idpersona'].'<br/>';
            $this->valueObjectP = $objeto;
            
        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;

    }

    public function insert(){
            $pdo = BaseDeDatos::getInstancia()->getConexion();
        
            $aTipoDocumento = ActiveRecordFactory::getTipoDocumento()->fetchAll();
            foreach($aTipoDocumento as $oTipoDocumento){
                if($oTipoDocumento['nombre'] == $this->valueObjectP->getTipoDocumento()){
                    $idTipo = $oTipoDocumento['idtipodocumento'];
                }
            }
            $sql = "INSERT into persona (idtipodocumento, apellido, nombre, numerodocumento, sexo, nacionalidad, email, telefono, celular, provincia, localidad, domicilio) 
            VALUES (:idtipodocumento, :apellido, :nombre, :numerodocumento, :sexo, :nacionalidad, :email, :telefono, :celular, :provincia, :localidad, :domicilio)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idtipodocumento',$idTipo,PDO::PARAM_STR);
            $stmt->bindValue(':apellido',$this->valueObjectP->getApellido(),PDO::PARAM_STR);
            $stmt->bindValue(':nombre',$this->valueObjectP->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':numerodocumento',$this->valueObjectP->getNumeroDocumento(),PDO::PARAM_STR);
            $stmt->bindValue(':sexo',$this->valueObjectP->getSexo(),PDO::PARAM_STR);
            $stmt->bindValue(':nacionalidad',$this->valueObjectP->getNacionalidad(),PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->valueObjectP->getEmail(),PDO::PARAM_STR);
            $stmt->bindValue(':telefono',$this->valueObjectP->getTelefono(),PDO::PARAM_STR);
            $stmt->bindValue(':celular',$this->valueObjectP->getCelular(),PDO::PARAM_STR);
            $stmt->bindValue(':provincia',$this->valueObjectP->getProvincia(),PDO::PARAM_STR);
            $stmt->bindValue(':localidad',$this->valueObjectP->getLocalidad(),PDO::PARAM_STR);
            $stmt->bindValue(':domicilio',$this->valueObjectP->getDomicilio(),PDO::PARAM_STR);
            $stmt->execute();

            $this->valueObjectP->setIdPersona($pdo->lastInsertId());

        
    }

    public function update(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "UPDATE persona SET idtipodocumento = :idtipodocumento, apellido = :apellido, nombre = :nombre,
            numerodocumento = :numerodocumento, sexo = :sexo, nacionalidad = :nacionalidad, email = :email,
            telefono = :telefono, celular = :celular, provincia = :provincia, localidad = :localidad,
            domicilio = :domicilio WHERE idpersona = :idpersona ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idtipodocumento',$this->valueObjectP->getIdTipoDocumento(),PDO::PARAM_STR);
            $stmt->bindValue(':apellido',$this->valueObjectP->getApellido(),PDO::PARAM_STR);
            $stmt->bindValue(':nombre',$this->valueObjectP->getNombre(),PDO::PARAM_STR);
            $stmt->bindValue(':numerodocumento',$this->valueObjectP->getNumeroDocumento(),PDO::PARAM_STR);
            $stmt->bindValue(':sexo',$this->valueObjectP->getSexo(),PDO::PARAM_STR);
            $stmt->bindValue(':nacionalidad',$this->valueObjectP->getNacionalidad(),PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->valueObjectP->getEmail(),PDO::PARAM_STR);
            $stmt->bindValue(':telefono',$this->valueObjectP->getTelefono(),PDO::PARAM_STR);
            $stmt->bindValue(':celular',$this->valueObjectP->getCelular(),PDO::PARAM_STR);
            $stmt->bindValue(':provincia',$this->valueObjectP->getProvincia(),PDO::PARAM_STR);
            $stmt->bindValue(':localidad',$this->valueObjectP->getLocalidad(),PDO::PARAM_STR);
            $stmt->bindValue(':domicilio',$this->valueObjectP->getDomicilio(),PDO::PARAM_STR);

            $stmt->bindValue(':idpersona', $this->valueObjectP->getIdPersona(),PDO::PARAM_STR);
            $stmt->execute();

        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }
    public function delete(){
        $pdo = BaseDeDatos::getInstancia()->getConexion();
        try {
            $sql = "DELETE FROM persona WHERE idpersona = :idpersona ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idpersona', $this->valueObjectP->getIdPersona(),PDO::PARAM_STR);
            $stmt->execute();

        }
        catch(PDOException $e)
        {
           return $e->getMessage();
        }
        return true;
    }
                   
            
public function validarContacto($tipo,$valor){
    //  es recomendado utilizar las contanstes para los tipos de contacto
    //    if ($this->_tipo == 1 or $this->_tipo == 2){
        if ($tipo == self::TIPO_TELEFONO or $tipo == self::TIPO_EMAIL){
            
            if ($tipo == self::TIPO_TELEFONO){
                
                
                if(strlen($valor) > 9) {
                    
                    for ($i=0;$i<strlen($valor);$i++){
                        
                        if ($valor[$i] == '-'){
                            
                            return true;
                        }
                        else { if ((strlen($valor)-1) == $i){
                            
                            return false;
                            }
                        }
                    }
                }
                else{
                    
                    return false;
                } 
                    
            }
            if ($tipo == self::TIPO_EMAIL){
                
                for ($i=0;$i<strlen($valor);$i++){
                    
                    if ($valor[$i] == '@'){
                   
                            return true;
                        }
                    else{ if ((strlen($valor)-1) == $i){
                     
                        return false;
                        }
                    }
                }
            }
            else{
            
                return false;
            }
        }
        
    }          
       

}

?>