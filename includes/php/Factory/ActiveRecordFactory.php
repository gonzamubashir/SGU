<?php


require_once '../SGU/includes/php/ActiveRecord/TipoUsuario.php';
require_once '../SGU/includes/php/ActiveRecord/TipoDocumento.php';
require_once '../SGU/includes/php/ActiveRecord/Persona.php';
require_once '../SGU/includes/php/ActiveRecord/Usuario.php';

abstract class ActiveRecordFactory{
    
    public static function getTipoDocumento(){
        return new TipoDocumento();   
    }

    public static function getPersona(){
        return new Persona();   
    }

    public static function getUsuario(){
        return new Usuario();   
    }

    public static function getTipoUsuario(){
        return new TipoUsuario();   
    }
}

?>