<?php
	
	// Arquivo que irá fazer o controle de todo o back-end.
	
	// Recuperando os arquivos:
	require '../../To do list - private/tarefa.model.php';
	require '../../To do list - private/tarefa.service.php';
	require '../../To do list - private/conexao.php';

	echo "<pre>";
		print_r($_POST);
	echo "</pre>";

	// Instâncinado as classes contidas dentro de cada arquivo:

	$tarefa = new Tarefa();
	$tarefa->__set('tarefa', $_POST['tarefa']);

	$conexao = new Conexao();
	
	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->inserir();

	echo "<pre>";
		print_r($tarefaService);
	echo "</pre>";
?>