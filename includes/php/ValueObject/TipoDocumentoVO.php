<?php
class TipoDocumentoVO{
    private $_idTipoDocumento;
    private $_descripcion;

    public function __construct ($idTipoDocumento = 0, $descripcion = ""){
        $this->_idTipoDocumento = $idTipoDocumento;
        $this->_descripcion = $descripcion;
    }

    public function getIdTipoDocumento(){
        return $this->_idTipoDocumento;
    }
    public function getDescripcion(){
        return $this->_descripcion;
    }

    public function setIdTipoDocumento($idTipoDocumento){
        return new TipoDocumentoVO($idTipoDocumento,$this->_descripcion);
    }
    public function setDescripcion($descripcion){
        return new TipoDocumentoVO($this->_idTipoDocumento,$descripcion);
    }
}

?>