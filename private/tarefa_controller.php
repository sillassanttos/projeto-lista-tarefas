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

  $tarefa = new Tarefa();
  $tarefa->__set('tarefa', $_POST['tarefa']);

  $conexao = new Conexao();

  $tarefaService = new TarefaService($conexao, $tarefa);
  $tarefaService->inserir();

  header('Location: nova_tarefa.php?inclusao=1');

?>