<?php

class BaseDeDatos{
    
    private static $_singleton;
    private static $_dsn = 'mysql:dbname=sgu;host=127.0.0.1;port=3306';
    private static $_user = 'root';
    private static $_password = '';
    private $_conexion;
    
    /*
    private static $_singleton;
    private static $_dsn = 'mysql:dbname=id21240636_sgu;host=127.0.0.1;port=3306';
    private static $_user = 'id21240636_sgu_usuario';
    private static $_password = 'Gonzi_011';
    private $_conexion;
    */
    private function __construct(){
        $this->_conexion = new PDO(self::$_dsn, self::$_user, self::$_password);
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$this->_conexion = $pdo;
    }
    public static function getInstancia()
	{
		if (is_null(self::$_singleton) )
		{
			self::$_singleton = new BaseDeDatos();
		}

		return self::$_singleton;
	}
    public function getConexion()
	{
		return $this->_conexion;
	}
}
    //$oDB = BaseDeDatos::getInstancia()->getConexion();
   //var_dump($oDB);
   // $oPDO = $oDB->getConexion();
   // var_dump($oPDO);
?>