<?php

	/* Define a página atual pela URL */
	$pagina = 'home';

	if(isset($_GET['i'])){
		$pagina = addslashes($_GET['i']);
	}

	/* Carrega a interrface do cabeçalho da página*/
	include 'views/header.php';

	/* Carrega a interface escolhida pelo usuário */
	switch ($pagina) {
		
		case 'home':
			include 'views/home.php';
			break;
		case 'login':
			include 'views/login.php';
			break;
		case 'cadastrar':
			include 'views/cadastrar.php';
			break;
		case 'areaPrivada':
			include 'views/areaPrivada.php';
			break;			


		case 'sair':
			include 'controles/sair.php';
			break;
			
		default:
			include 'views/home.php';
			break;
	}

	/* Carrega a interface do rodapé da página*/
	include 'views/footer.php';

?>