<?php


class UsuarioVO {
    private $_idUsuario;
    private $_idPersona;
    private $_idTipoUsuario;
    private $_contrasenia;
    private $_nombre;
    
    public function __construct($idUsuario = 0, $idPersona = 0, $idTipoUsuario = 0, $contrasenia ="", $nombre = ''){
        $this->_idUsuario = $idUsuario;
        $this->_idPersona = $idPersona;
        $this->_idTipoUsuario = $idTipoUsuario;
        $this->_contrasenia = $contrasenia;
        $this->_nombre = $nombre;
    }
    public function getIdUsuario(){
        return $this->_idUsuario;
    }
    public function getIdPersona(){
        return $this->_idPersona;
    }
    public function getIdTipoUsuario(){
        return $this->_idTipoUsuario;
    }
    public function getContrasenia(){
        return $this->_contrasenia;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function setContrasenia($contrasenia){
        return new UsuarioVO($this->_idUsuario,$this->_idPersona,$this->_idTipoUsuario,$this->_contrasenia = $contrasenia,$this->_nombre);
    }
    public function setNombre($nombre){
        return new UsuarioVO($this->_idUsuario,$this->_idPersona,$this->_idTipoUsuario,$this->_contrasenia,$this->_nombre = $nombre);
    }
    public function setIdUsuario($idUsuario){
        return new UsuarioVO($this->_idUsuario = $idUsuario,$this->_idPersona,$this->_idTipoUsuario,$this->_contrasenia,$this->_nombre);
    }
    public function setIdPersona($idPersona){
        return new UsuarioVO($this->_idUsuario,$this->_idPersona = $idPersona,$this->_idTipoUsuario,$this->_contrasenia,$this->_nombre);
    }
    public function setIdTipoUsuario($idTipoUsuario){
        return new UsuarioVO($this->_idUsuario,$this->_idPersona,$this->_idTipoUsuario = $idTipoUsuario,$this->_contrasenia,$this->_nombre);
    }
}

?>