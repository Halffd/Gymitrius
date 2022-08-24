<?php
	function validar_cnpj($cnpj)
	{
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		
		// Valida tamanho
		if (strlen($cnpj) != 14)
			return false;

		// Verifica se todos os digitos são iguais
		if (preg_match('/(\d)\1{13}/', $cnpj))
			return false;	

		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
		{
			$soma += $cnpj[$i] * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;

		if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
			return false;

		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
		{
			$soma += $cnpj[$i] * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;

		return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
	}

	require_once('db.class.php');

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$endereco = $_POST['endereco'];
	$cnpj = $_POST['cnpj'];
	$preco = $_POST['preco'];
	$imagem = $_POST['imagem'];
	$cupom = $_POST['cupom'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$empresa_existe = false;
	$email_existe = false;
	$cnpj_existe = false;
	$telefone_existe = false;

	$verificar_cnpj = validar_cnpj($cnpj);
	if($verificar_cnpj == false){
		$cnpj_existe = true;
	}

	//verificar se a empresa já existe
	$sql = " select * from academia where nome = '$nome' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['nome'])){
			$empresa_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de usuário';
	}

	//verificar se o e-mail já existe
	$sql = " select * from academia where email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}

	//verificar se o telefone já existe
	$sql = " select * from academia where telefone = '$telefone' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['telefone'])){
			$telefone_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}

	//verificar se o cnpj já existe
	$sql = " select * from academia where cnpj = '$cnpj' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['cnpj'])){
			$cnpj_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}

	// rotina de erro para verificar se o usuario ou email informado
	// ja existe na tabela do banco de dados
	if($empresa_existe || $email_existe || $telefone_existe || $cnpj_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.= "erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.= "erro_email=1&";
		}

		if($telefone_existe){
			$retorno_get.= "erro_telefone=1&";
		}

		if($cnpj_existe){
			$retorno_get.= "erro_cnpj=1&";
		}

		header('Location: inscrever_academia.php?'.$retorno_get);
		die();
	}

		// inclluir o registro dentro da tabela usuarios já
		// que todos os testes acima realizados garantem que esse usuario
		// é novo!!!
	$sql = " insert into academia(nome, email, telefone, endereco, cnpj, preco, cupom, imagem) values ('$nome', '$email', '$telefone', '$endereco', '$cnpj', '$preco', '$cupom', '$imagem') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Academia registradada com sucesso!';
	} else {
		echo 'ERRO ao registrar a academia!';
	}


?>