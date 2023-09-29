<?php
class PersonaVO{
    private $_idPersona;
    private $_apellido;
    private $_nombre;
    private $_numeroDocumento;
    private $_domicilio;
    private $_localidad;
    private $_tipoDocumento;
    private $_idTipoDocumento;
    private $_sexo;
    private $_usuario;
    private $_nacionalidad;
    private $_email;
    private $_telefono;
    private $_celular;
    private $_provincia;

    public function __construct(){
        /*    Para poder inicializar los objetos donde sus constructores reciben parametros, 
                es necesario definir un valor por defecto para los mismos. 
                .....Ver los constructores de las clases que se inicializan en este metodo......*/
    
        //    $_telefono = new Contacto();  recordar que los atributos de clase se acceden con $this
           /* $this->_telefono = new Contacto();
            $this->_celular = new Contacto();
            $this->_email = new Contacto();
            $this->_provincia = new Provincia();
            $this->_usuario = new Usuario();
            $this->_sexo = new Sexo();
            $this->_tipoDocumento = new TipoDocumento();*/
        }
        public function getIdPersona(){
            return $this->_idPersona;
        }
        public function getIdTipoDocumento(){
            return $this->_idTipoDocumento;
        }
        public function getApellido(){
            return $this->_apellido;
        }
        public function getNombre(){
            return $this->_nombre;
        }
        public function getNumeroDocumento(){
            return $this->_numeroDocumento;
        }
        /**
         * Se agrego este metodo faltante para obtener el objeto de tipo documento
         */
        public function getProvincia(){
            return $this->_provincia;
        }
        public function getEmail(){
            return $this->_email;
        }
        public function getCelular(){
            return $this->_celular;
        }
        public function getTelefono(){
            return $this->_telefono;
        }
        public function getSexo(){
            return $this->_sexo;
        }
        public function getUsuario(){
            return $this->_usuario;
        }
        public function getTipoDocumento(){
            return $this->_tipoDocumento;
        }
        public function getNacionalidad(){
            return $this->_nacionalidad;
        }
        public function getDomicilio(){
            return $this->_domicilio;
        }
        public function getLocalidad(){
            return $this->_localidad;
        }

        public function setIdPersona($idPersona){
            return new PersonaVO($this->_idPersona = $idPersona);
        }
        public function setIdTipoDocumento($idTipoDocumento){
            return new PersonaVO($this->_idTipoDocumento = $idTipoDocumento);
        }
        public function setApellido($apellido){
            return new PersonaVO($this->_apellido = $apellido);
        }
        public function setNombre($nombre){
            return new PersonaVO($this->_nombre = $nombre);
        }
        public function setNumeroDocumento($numeroDocumento){
            return new PersonaVO($this->_numeroDocumento = $numeroDocumento);
        }
        public function setDomicilio($domicilio){
            return new PersonaVO($this->_domicilio = $domicilio);
        }
        public function setNacionalidad($nacionalidad){
            return new PersonaVO($this->_nacionalidad = $nacionalidad);
        }
        public function setTipoDocumento($tipoDocumento){
            return new PersonaVO($this->_tipoDocumento = $tipoDocumento);
        }
        public function setSexo($sexo){
            return new PersonaVO($this->_sexo = $sexo);
        }
        public function setUsuario($Usuario){
            return new PersonaVO();
        }
        public function setProvincia($provincia){
            return new PersonaVO($this->_provincia = $provincia);
        } 
        public function setEmail($email){
            return new PersonaVO($this->_email = $email);
        }
        public function setTelefono($telefono){
            return new PersonaVO($this->_telefono = $telefono);
        }
        public function setCelular($celular){
            return new PersonaVO($this->_celular = $celular);
        }
        public function setLocalidad($localidad){
            return new PersonaVO($this->_localidad = $localidad);
        }


}

?>