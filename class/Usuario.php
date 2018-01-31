<?php 

	class Usuario
	{
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function __construct($login = "", $senha = "")
		{
			$this->setDeslogin($login);
			$this->setDessenha($senha);
		}

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
			//echo "<br>".$id;
			$sql = new Sql();
			$res = $sql->select("select * from tb_usuarios where idusuario = :ID", array(":ID"=>$id));

			//if(isset($res[0]))
			if(count($res) > 0)
			{
				$this->setData($res[0]);
			}
		}

		public static function getList()
		{
			$sql = new Sql();
			return $sql->select("select * from tb_usuarios order by deslogin");
		}

		public static function search($login)
		{
			$sql = new Sql();
			return $sql->select("select * from tb_usuarios where deslogin like :SEARCH order by deslogin",array(':SEARCH'=>"%".$login."%"));
		}


		public function login($login, $password)
		{
			$sql = new Sql();
			$res = $sql->select("select * from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(":LOGIN"=>$login,
				":PASSWORD"=>$password));

			//if(isset($res[0]))
			if(count($res) > 0)
			{
				$this->setData($res[0]);
			}
			else
			{
				throw new Exception("Login ou senha invalidos");
			}
		}

		public function setData($data)
		{
			$this->setIdUsuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}

		public function insert()
		{
			$sql = new Sql();
			$res = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));

			if(count($res) > 0)
			{
				$this->setData($res[0]);
			}
		}

		public function update($login, $senha)
		{
			$this->setDeslogin($login);
			$this->setDessenha($senha);
			$sql = new Sql();
			$sql->query("update tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD where idusuario = :ID",array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdUsuario()
			));
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