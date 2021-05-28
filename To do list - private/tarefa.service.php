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
			
			// Recuperando informações do banco de dados:
			$query = "
				select 
					t.id, s.status, t.tarefa 
				from 
					tb_tarefas as t
				left join
					tb_status as s on(t.id_status = s.id)
			";
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function atualizar() { // Update
			
			$query = 'update tb_tarefas set tarefa = :tarefa where id = :id ';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
			$stmt->bindValue(':id', $this->tarefa->__get('id'));
			return $stmt->execute();
		}

		public function remover() { // Delete
			
		}

	}

?>