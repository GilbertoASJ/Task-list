<?php
	
	// Class Tarefa, que irá servir de modelo para as tarefas registradas no aplicativo.
	class Tarefa {
		private $id;
		private $id_status;
		private $tarefa;
		private $data_cadastro;

		public function __get($atributo) {

			return $this->$atributo;
		}

		public function __set($atributo, $valor) {

			$this->$atributo = $valor;
			
			// Fazemos o retorno do próprio objeto em questão para que não seja necessário fazer a referência da classe.
			return $this;
		}
	}

?>