<?php

	session_start();

	// inclui a classe de funcoes para acessar o banco de dados
	require_once('db.class.php');

	// recupera os dados do formulario
	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);

		// determina como será o retrieve = recupera as informações do determinado usuario
	$sql = " SELECT id, usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

	// conectar ao banco de dados configurad
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	// executa a busca
	$resultado_id = mysqli_query($link, $sql);

	// verifica o resultado da busca e fa o dirrecionamento de pagina
	// ou seja, permite a entrada no seu app ou programa
	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['usuario'])){

			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];
			$_SESSION['senha'] = $dados_usuario['senha'];
			
			header('Location: home.php');

		} else {
			header('Location: index.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}


	


?>