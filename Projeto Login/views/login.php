<?php
	require_once './controles/UserClass.php';	
	$u = new Usuario; //instanciando a classe
?>



<div class="formulario">
	<h3>Logar</h3>

	<!-- Método POST para envio de senha -->
	<form method="POST"> 
		<input type="email" name="email" placeholder="Usuario" maxlength="40" minlength="3" >
		<input type="password" name="senha" placeholder="Senha" maxlength="15" minlength="3">

		<input type="submit" value="ACESSAR">
		<a href="?i=cadastrar">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
	</form>
 </div>




<?php
	//verificar se clicou no botão cadastrar
	if(isset($_POST['email'])){
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		
		//verificar se está vazio
		if(!empty($email) && !empty($senha)){
			
			//acessando o método conectar da classe instanciada
			$u->conectar("meu_banco","localhost","root","");
			
			if($u->msgErro == ""){				
				if($u->logar($email,$senha)){				
					header("location: ?i=areaPrivada");
				}else{
					?><div class="msgErro">Email ou Senha inválidos!</div><?php				
				}
			}else{
							//exibe a mensagem de erro contida na váriavel msgErro			
				?><div class="msgErro">
									<?php echo "Erro no Banco de Dados: ".$u->msgErro; ?>
				</div><?php		
			}
		}else{
			?><div class="msgErro">Preencha todos os campos!</div><?php
		}
	}
?>
