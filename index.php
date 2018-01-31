<?php  

	require_once("config.php");

	//echo"oi";
	//carrega um usuario
	//$root = new Usuario();
	//echo"oi2";
	//$root->loadById(3);
	//echo $root;


	//carrega uma lista de usuarios
	//$lista = Usuario::getList();
	//echo json_encode($lista);

	//carrega uma lista de usuarios buscado pelo login
	//$search = Usuario::search("ot");
	//echo json_encode($search);


	//carregando um usuario usando o login e senha
	//$usuario = new Usuario();
	//$usuario->login("root","123iug");
	//echo $usuario;

	//insert
	//$aluno = new Usuario("aluno","teste");
	
	//$aluno->insert();

	//echo $aluno;

	//update
	$usuario = new Usuario();
	$usuario->loadById(5);
	$usuario->update("felipe","judagsyjcb");

	echo $usuario;

?>