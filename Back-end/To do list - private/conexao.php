<?php 

	// Classe que irá fazer a conexão com o banco de dados.
	class Conexao {

		private $host = "localhost";
		private $db_name = "php_com_pdo";
		private $user = 'root';
		private $password = '';

		public function conectar() {

			try {

				// Variável que faz a conexão com o banco de dados:
				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->db_name",
					"$this->user", 
					"$this->password"
				);

				// Quando o método conectar for chamado, irá retornar $conexao, ou seja, a conexão com o 'BD'.
				return $conexao;

			} catch (PDOException $e) {

				echo "<p> $e->getMessage() </p>";
			};
		}
	}
?>