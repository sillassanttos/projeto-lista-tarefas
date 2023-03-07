<?php

  /*

    Verificar o contexto.

    Caso esses arquivo estiverem em uma pasta fora da pasta public
    eles deven ser acessado via contexto.
    Exemplo:

    > xamp
    > > htdocs
    > > > lista-tarefas
    > > lista-tarefas
        require "../../lista-tarefas/tarefa.model.php";
        require "../../lista-tarefas/tarefa.service.php";
        require "../../lista-tarefas/conexao.php";
  */

  require "tarefa.model.php";
  require "tarefa.service.php";
  require "conexao.php";

  $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

  $pagina = 'Location: ' . ((isset($_GET['pag']) && $_GET['pag'] == 'index') ? 'index' : 'todas_tarefas') . '.php';

  if ($acao == 'inserir') {
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
    $tarefa->__set('id', $_POST['id'])
           ->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    if ($tarefaService->atualizar()) {
      header($pagina);
    }

  } else if ($acao == 'remover') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefaService->remover();

    header($pagina);

  } else if ($acao == 'marcarRealizada') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id'])
           ->__set('id_status', 2); // 2-Realizada

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefaService->marcarRealizada();

    header($pagina);

  } else if ($acao == 'recuperarTarefasPendentes') {

    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->recuperarTarefasPendentes();

  }

?>