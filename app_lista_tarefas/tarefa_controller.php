<?php
    // diretorio particular para manter os dados seguros fica fora de htdocs

    require "app_lista_tarefas/tarefa.model.php";
    require "app_lista_tarefas/tarefa.service.php";
    require "app_lista_tarefas/conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if(isset($_GET['acao']) && $_GET['acao'] == 'inserir'){

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa',$_POST['tarefa']);

        $conexao = new Conexao();
        
        $tarefaserivice = new TarefaService($conexao , $tarefa);
        $tarefaserivice ->inserir();

        header('location: nova_tarefa.php?inclusao=1');
    } else if ($acao == 'recuperar'){
      
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefas = $tarefaService->recuperar();

    }else if ($acao == 'atualizar'){
    
     $tarefa = new Tarefa();
     $tarefa->__set('id',$_POST['id'])
             ->__set('tarefa',$_POST['tarefa']);

     $conexao = new Conexao();

     $tarefaService = new TarefaService($conexao,$tarefa);
     if($tarefaService->atualizar()){
         if(isset($_GET['pag']) && $_GET['pag'] == 'index' ){
            header('location: index.php');
         }else {
            header('location: todas_tarefas.php');
         }
         
     }
       
    }else if($acao == 'remover'){
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefaService->remover();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index' ){
            header('location: index.php');
         }else {
            header('location: todas_tarefas.php');
         }

    }else if($acao == 'marcar'){
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id'])->__set('id_status',2);

        $conexao = new Conexao();

        $tarefaservice = new TarefaService($conexao,$tarefa);
        $tarefaservice->marcar();

         if(isset($_GET['pag']) && $_GET['pag'] == 'index' ){
            header('location: index.php');
         }else {
            header('location: todas_tarefas.php');
         }

    }else if ($acao == 'tarefasPendentes'){
        $tarefa = new Tarefa();
        $tarefa->__set('id_status',1);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefas = $tarefaService->tarefaPendentes();
    }    

?>
