<?php

    class Usuario{
		
        private $pdo;
        public $msgErro = "";

		//==========================================================================================
		// ================== método conectar ao banco MySQL ==================
        public function conectar($nome, $host, $usuario, $senha){
			
            global $pdo;
            try{
				//Conexão Orientada a Objeto com PDO
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            }catch(PDOException $e){
                $msgErro = $e->getMessage();
            }
        }
		
		
		//==========================================================================================
		//método enviar os dados para cadastrar o usuario no banco de dados mysql
        public function cadastrar($nome, $telefone, $email, $senha){
			
            global $pdo;			
            //verificar se já existe email cadastrado
            $sql =$pdo->prepare("SELECT idusuario FROM tbusuario WHERE email = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();

            if($sql->rowCount() > 0){ //se retornar um id da coluna tbusuario, então o cliente já está cadastrado
                return false;

            }else{//caso não vei id, então vai ser cadastrada
                $sql = $pdo->prepare("INSET INTO tbusuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
				
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s", $senha); //criptografada: $sql->bindValue(":s",md5($senha));
                $sql->execute();
					
                return true; //foi feito o cadastrado
            }    

        }
		
		
		
		//==========================================================================================
		//Médoto logar o usuário
        public function logar($email, $senha){
            global $pdo;
			
            //verificar se o email e senha estão cadastrado no banco
            $sql = $pdo->prepare("SELECT idusuario FROM tbusuario WHERE email =:e AND senha = :s");
			
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s", $senha); //criptografada: $sql->bindValue(":s",md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){ //se na minha consulta veio o id, então entre na sessão
                
                $dado = $sql->fetch(); //transforma a consulta em um arry com o nome das colunas
				
                session_start(); //inicia a sessão
                $_SESSION['idusuario'] = $dado['idusuario']; //cria uma sessão que guarda o id do usuario
                return true; //logado com sucesso
				
            }else{
                return false; //não foi possivel logar
            }
        }
    }

 

?>