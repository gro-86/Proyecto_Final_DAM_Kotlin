<?php 
	class DbConnect
	{
		private $con;
	 
		//Constructor
		function __construct()
		{
	 
		}
	 
		//Método para conectarnos 
		function connect()
		{
			//Incluimos el fichero con las constantes
			include_once dirname(__FILE__) . '/Constants.php';
	 
			//connecting to mysql database
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	 
			//Nos conectamos y comprobamos si se produce algun error
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	 
			//Devolvemos el objeto con la conexión
			return $this->con;
		}
	 
	}