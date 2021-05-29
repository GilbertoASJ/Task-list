<?php 
	
	$acao = 'recuperar';
	require 'tarefa_controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Task list</title>

		<!-- Css -->
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="icon" href="./img/logo.png">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- Fontawesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<style type="text/css">
			i {
				cursor: pointer;
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Task list
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php foreach ($tarefas as $indice => $tarefa) { ?>

									<div class="row mb-3 d-flex align-items-center tarefa">

										<div id="tarefa_<?=$tarefa["id"]?>" class="col-sm-9">
											<?= $tarefa['tarefa'] ?> (<?= $tarefa['status'] ?>)
										</div>

										<div class="col-sm-3 mt-2 d-flex justify-content-between">

											<i 
												class="fas fa-trash-alt fa-lg text-danger"
												onclick="removerTarefa(<?=$tarefa["id"]?>)" 
											></i>

											<i 
												class="fas fa-edit fa-lg text-info" 
												onclick="editarTarefa(<?=$tarefa["id"]?>, '<?= $tarefa['tarefa'] ?>')"
											></i>
											<i class="fas fa-check-square fa-lg text-success"></i>
										</div>
									</div>

								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			
			function editarTarefa(id, tarefaAntiga) {

				// Criar um form de edição
				let form = document.createElement('form');
				form.action = 'tarefa_controller.php?acao=atualizar';
				form.method = 'post';
				form.className = 'row';

				// Criar um input para a entrada do texto
				let inputTarefa = document.createElement('input');
				inputTarefa.type = 'text';
				inputTarefa.name = 'tarefaEditada';
				inputTarefa.className = 'col-9 form-control';
				inputTarefa.value = tarefaAntiga;

				// Criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input');
				inputId.type = 'hidden';
				inputId.name = 'id';
				inputId.value = id;

				// Criar um button para o envio do form
				let button = document.createElement('button');
				button.type = 'submit';
				button.className = 'col-3 btn btn-info';
				button.innerHTML = 'Atualizar'

				// Incluindo os elementos dentro de um contexto html
				form.appendChild(inputTarefa);
				form.appendChild(button);
				form.appendChild(inputId);

				// Selecionando e incluindo o form dentro da div.
				let tarefa = document.querySelector(`#tarefa_${id}`);
				tarefa.innerHTML = "";
				tarefa.insertBefore(form, tarefa[0]);
			}

			function removerTarefa(id) {
				window.location = `todas_tarefas.php?acao=remover&id=${id}`
			}

		</script>
	</body>
</html>