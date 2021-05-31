<?php
	
	// Arquivo que irá fazer o controle de todo o back-end.
	
	// Recuperando os arquivos:
	require '../../To do list - private/tarefa.model.php';
	require '../../To do list - private/tarefa.service.php';
	require '../../To do list - private/conexao.php';

	// Atribuindo a variável ação o seu respectivo valor, caso exista na superglobal Get, caso não exista irá receber de algum outro lugar.

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if ($acao == 'inserir' && $_POST['tarefa']) {

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

	} else if ($acao == 'atualizar') {
	
		$tarefa = new Tarefa();

		// Fazendo a atribuição dos novos valores
		$tarefa->__set('id', $_POST['id'])
			   ->__set('tarefa', $_POST['tarefaEditada']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->atualizar()) {

			if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: index.php');

			} else {
				header('location: todas_tarefas.php');
			};
		};

	} else if ($acao == 'remover') {

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');

		} else {
			header('location: todas_tarefas.php');
		};

	} else if ($acao == 'marcarComoRealizada') {

		$tarefa = new Tarefa();

		// Atualizando o status da tarefa para 'realizado':
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarComoRealizada();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');

		} else {
			header('location: todas_tarefas.php');
		};

	} else if ($acao == 'recuperarTarefasPendentes') {

		$tarefa = new Tarefa();
		$tarefa->__set('id_status', 1);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperarTarefasPendentes();
	}
?>
