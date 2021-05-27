<?php
	
	// Arquivo que irá fazer o controle de todo o back-end.
	
	// Recuperando os arquivos:
	require '../../To do list - private/tarefa.model.php';
	require '../../To do list - private/tarefa.service.php';
	require '../../To do list - private/conexao.php';

	// Atribuindo a variável ação o seu respectivo valor, caso exista na superglobal Get, caso não exista irá receber de algum outro lugar.

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if ($acao == 'inserir') {
		// Instâncinado as classes contidas dentro de cada arquivo:

		$tarefa = new Tarefa();
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();
		
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();

		header('Location: nova_tarefa.php?inclusao=1');

	} else if ($acao == 'recuperar') {
		
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		
		$tarefaService = new TarefaService($conexao, $tarefa);

		$tarefas = $tarefaService->recuperar();

	}

?>