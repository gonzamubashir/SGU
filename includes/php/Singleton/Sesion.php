<?php

require_once '../SGU/includes/php/Registry/Registry.php';

Class Sesion {

    private static $_instancia;
    
    public function __construct(){
        session_start();
		if (isset($_SESSION['HTTP_USER_AGENT'])){
    		if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    		{
        	
				header("location: index.php?");
    		}
		}
		else
		{
    		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		}


		if ( isset($_SESSION['registry']) == false || $_SESSION['registry'] == null )
		{
           
			$_SESSION['registry'] = new Registry();
		}

    }
    public static function getInstancia(){
        if (is_null(self::$_instancia)) {
            self::$_instancia = new Sesion();
        }   
        return self::$_instancia;
    }

    public function getRegistry()
	{
		return $_SESSION['registry'];
	}

	public function destruir()
	{
		session_unset();
		session_destroy();
	}
}

?>