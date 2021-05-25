<?php
	
	// Classe que irá fazer as operações de CRUD com as tarefas criadas
	class TarefaService {

		// Conexão com o banco de dados
		private $conexao;

		// Corpo da tarefa
		private $tarefa;

		public function __construct(Conexao $conexao, Tarefa $tarefa) {

			$this->conexao = $conexao->conectar();
			$this->tarefa = $tarefa;
		}

		// CRUD - Create, Read, Update, Delete

		public function inserir() { // Create

			// Inserindo tarefa no banco de dados:
			$query = "insert into tb_tarefas(tarefa) values (:tarefa)";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
			$stmt->execute();

		}

		public function recuperar() { // Read
			
		}

		public function atualizar() { // Update
			
		}

		public function remover() { // Delete
			
		}

	}

?>