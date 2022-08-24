<?php
	$erro_usuario	= isset($_GET['erro_usuario'])	? $_GET['erro_usuario'] : 0;
	$erro_email		= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
	$erro_telefone  = isset($_GET['erro_telefone'])	? $_GET['erro_telefone']	: 0;;
	$erro_cnpj		= isset($_GET['erro_cnpj'])	? $_GET['erro_cnpj']	: 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Gymmitrus</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="estilo.css"
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){
			$('body').on('focus', '.phone', function(){
				var maskBehavior = function (val) {
					return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
				},
				options = {
					onKeyPress: function(val, e, field, options) {
						field.mask(maskBehavior.apply({}, arguments), options);

						if(field[0].value.length >= 14){
							var val = field[0].value.replace(/\D/g, '');
							if(/\d\d(\d)\1{7,8}/.test(val)){
								field[0].value = '';
								alert('Telefone Invalido');
							}
						}
					}
				};
				$(this).mask(maskBehavior, options);
			});
		});
		function validarCNPJ(cnpj) {	
			cnpj = cnpj.replace(/[^\d]+/g,'');

			if(cnpj == '') return false;
			
			if (cnpj.length != 14)
				return false;

			// Elimina CNPJs invalidos conhecidos
			if (cnpj == "00000000000000" || 
				cnpj == "11111111111111" || 
				cnpj == "22222222222222" || 
				cnpj == "33333333333333" || 
				cnpj == "44444444444444" || 
				cnpj == "55555555555555" || 
				cnpj == "66666666666666" || 
				cnpj == "77777777777777" || 
				cnpj == "88888888888888" || 
				cnpj == "99999999999999")
				return false;
				
			// Valida DVs
			tamanho = cnpj.length - 2
			numeros = cnpj.substring(0,tamanho);
			digitos = cnpj.substring(tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
			if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0))
				return false;
				
			tamanho = tamanho + 1;
			numeros = cnpj.substring(0,tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
			if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1))
				return false;
					
			return true;
			
			}
		function cpn(){
			if(document.querySelector("#botao").style.display == "block"){
				document.querySelector("#botao").style.display = "none";
			} else {
				document.querySelector("#botao").style.display = "block";
			}
		}
		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img width=30% src="imagens/logo.jfif" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="index.html">Voltar para Home</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3>Inscrever a sua empresa.</h3>
	    		<br/>
				<form method="post" action="registra_academia.php" id="formCadastrarse">
					<div class="form-group">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome de Academia" required="requiored">
						<?php
							if($erro_usuario){ // 1/true 0/false nome telefone endereco cnpj preco imagem email cupom
								echo '<font style="color:#FF0000">Academia já existe</font>';
							}
						?>
					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="requiored">
						<?php
							if($erro_email){
								echo '<font style="color:#FF0000">E-mail já existe</font>';
							}
						?>
					</div>

					<div class="form-group">
						<input class="phone" type="text" class="form-control" id="telefone" name="telefone" placeholder="Número de Telefone" required="requiored">
						<?php
							if($erro_telefone){
								echo '<font style="color:#FF0000">Telefone já existe</font>';
							}
						?>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required="requiored">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Número de CNPJ" required="requiored">
						<?php
							if($erro_cnpj){
								echo '<font style="color:#FF0000">CNPJ incorreto</font>';
							}
						?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="telefone" name="preco" placeholder="Preço mensal da Academia" required="requiored">
					</div>
					<div class="form-group">
						<input type="file" class="form-control" id="imagem" name="imagem" placeholder="Imagem da Academia">
					</div>
					<br>
					<input type="button" class="btn-info" value="Possuo um cupom" onclick="cpn()">
					<div id="botao">
						<p style="font-size: 15px;">* Opcional</p>
						<div class="form-group">
							<input type="text" class="form-control" id="cupom" name="cupom" placeholder="Cupom">
						</div>
					</div>
					<div style="font-size: 18px;"> Caso tenha cupom, não esqueça de digitá-lo </div>
					<button type="submit" class="btn btn-primary form-control">Inscrever</button>
				</form>
			</div>
		</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>