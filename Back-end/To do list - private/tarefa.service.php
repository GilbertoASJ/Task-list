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
			$query = "insert into tb_tarefas(tarefa) values (?)";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
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
			
			$query = 'update tb_tarefas set tarefa = ? where id = ? ';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
			$stmt->bindValue(2, $this->tarefa->__get('id'));
			return $stmt->execute();
		}

		public function remover() { // Delete
			
			$query = 'delete from tb_tarefas where id = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->tarefa->__get('id'));
			return $stmt->execute();
		}

		public function marcarComoRealizada() {

			$query = 'update tb_tarefas set id_status = ? where id = ? ';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->tarefa->__get('id_status'));
			$stmt->bindValue(2, $this->tarefa->__get('id'));
			return $stmt->execute();
		}

		public function recuperarTarefasPendentes() {

			$query = "
				select 
					t.id, s.status, t.tarefa 
				from 
					tb_tarefas as t
				left join
					tb_status as s on(t.id_status = s.id)
				where
					t.id_status = :id_status
			";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
			$stmt->execute();
			return $stmt->fetchAll();
		}

	}

?>