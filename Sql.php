<?php 

	class Sql extends PDO
	{

		private $con;

		public function __construct()
		{
			$this->con = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		}

		private function setParams($statement, $parameters = array())
		{
			echo "entrou";
			foreach ($parameters as $key => $value) 
			{
				//$this->setParam("meu pinto",$key,$value);
				$this->setParam($statement,$key,$value,$value);
			}
		}

		private function setParam($statement, $key, $value)
		{
			$statement->bindParam($key, $value);
		}

		public function query($rawQuery,$params = array())
		{
			$stmt = $this->con->prepare($rawQuery);

			$this->setParams($stmt,$params);
			$stmt->execute();
			return $stmt;
		}

		public function select($rawQuery, $params = array()):array
		{
			echo"oi4";
			$stmt = $this->query($rawQuery, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

	}

 ?>