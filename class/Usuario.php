<?php 

	class Usuario
	{
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdUsuario()
		{
			return $this->idusuario;
		}

		public function setIdUsuario($value)
		{
			$this->idusuario = $value;
		}

		public function getDeslogin()
		{
			return $this->deslogin;
		}

		public function setDeslogin($value)
		{
			$this->deslogin = $value;
		}

		public function getDessenha()
		{
			return $this->dessenha;
		}

		public function setDessenha($value)
		{
			$this->dessenha = $value;
		}

		public function getDtcadastro()
		{
			return $this->dtcadastro;
		}

		public function setDtcadastro($value)
		{
			$this->dtcadastro = $value;
		}

		public function loadById($id)
		{
			echo "<br>".$id;
			$sql = new Sql();
			$res = $sql->select("select * from tb_usuarios where idusuario = :ID", array(":ID"=>$id));

			//if(isset($res[0]))
			if(count($res) > 0)
			{
				$row = $res[0];
				$this->setIdUsuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
			}
		}

		public function __toString()
		{
			return json_encode(array(
				"idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}
	}

 ?>