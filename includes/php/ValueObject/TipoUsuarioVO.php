<?php
class TipoUsuarioVO{
    private $_idTipoUsuario;
	private $_nombre;
	private $_descripcion;

    public function __construct($idTipoUsuario = 0, $nombre = "", $_descripcion = "")
    {
        $this->_idTipoUsuario = $idTipoUsuario;
        $this->_nombre = $nombre;
        $this->_descripcion = $_descripcion;
    }

    public function getIdTipoUsuario(){
        return $this->_idTipoUsuario;
    }

    public function getNombre(){
        return $this->_nombre;
    }

    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setIdUsuario($idTipoUsuario){
        return new TipoUsuarioVO($idTipoUsuario,$this->_nombre,$this->_descripcion);
    }

    public function setNombre($nombre){
        return new TipoUsuarioVO($this->_idTipoUsuario,$nombre,$this->_descripcion);
    }

    public function setDescripcion($descripcion){
        return new TipoUsuarioVO($this->_idTipoUsuario,$this->_nombre,$descripcion);
    }
}

?>