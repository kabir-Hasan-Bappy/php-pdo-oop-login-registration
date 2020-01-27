<?php
/**
 * 
 */
class Database
{
	private $host = "localhost";
	private $dbname = "db_lr";
	private $userdb = "root";
	private $password = "";
	public $pdo;

	public function __construct()
	{

		if (!isset($this->pdo)) {
			
			try{
				 $con = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->userdb, $this->password);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo=$con;
			}
			catch(PDOException $e){
				die("Failed to COnnect with Database". $e->getMessage());
			}
		}
	}
}

?>