<?php	
	session_start();	
	
	unset($_SESSION['idusuario']); //destruindo a sessão logada
	
	header("location: ./index.php");
?>
