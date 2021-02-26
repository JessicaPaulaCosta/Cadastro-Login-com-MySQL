<?php
	require_once './controles/UserClass.php';	
	$u = new Usuario; //instanciando a classe
?>



<div class="formulario">
    <h3>Cadastrar</h3>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo.." maxlength="30" minlength="3">
        <input type="text" name="telefone" placeholder="Seu Telefone.." maxlength="30" minlength="3">
        <input type="email" name="email" placeholder="Seu E~mail.." maxlength="40" minlength="3">
        <input type="password" name="senha" placeholder="Digite uma Senha.." maxlength="15" minlength="3">
        <input type="password" name="confSenha" placeholder="Confirmar sua Senha.." maxlength="15" minlength="3">

        <input type="submit" value="Enviar">
    </form>
</div>






<?php
	//verificar se clicou no botão cadastrar
	if(isset($_POST['nome'])){
		
		$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		$confirmarSenha = addslashes($_POST['confSenha']);
		
		//verificar se tem algum campo vazio
		if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){
			
			//acessando o método conectar da classe instanciada
			$u->conectar("meu_banco","localhost","root","");
			 
			if($u->msgErro == ""){ //se a variavel msgErro estiver vazia: true
				
				if($senha == $confirmarSenha){
					
					//envia os paramentros para a função cadastrar
					if($u->cadastrar($nome, $telefone, $email, $senha)){
						
						?><div id="msgSucesso">Cadastrado com sucesso! Acesse para entrar!</div><?php
						
					}else{
						
						?><div class="msgErro">Email já cadastrado!</div><?php
					}
				}else{
					
					?><div class="msgErro">Senha e confirmar senha estão diferentes!</div><?php
				}
				 
			}else{
				//exibe a mensagem de erro contida na variavel msgErro			
				?><div class="msgErro">
									<?php echo "Erro: ".$u->msgErro; ?>
				</div><?php
			}
		}else{
			
			?><div class="msgErro">Preencha todos os campos!</div><?php
		}
	}
?>