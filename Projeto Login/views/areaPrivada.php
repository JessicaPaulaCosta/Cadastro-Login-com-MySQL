

<?php
	//verificar se a sessão existe e está logado
	session_start();
	
	if(!isset($_SESSION['idusuario'])){
		header("location: ?i=areaPrivada");
		exit();		
	}
?>



<h1>Seja Bem vindo!</h1>
	
<BR><a href="?i=sair"> Sair </a>