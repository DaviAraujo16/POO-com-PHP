<?php

    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    switch($controller){
        case 'item_venda':

            require_once("class/controler/ItemVendaController_class.php");
            $ctrl = new ItemVendaController();
            
            switch($modo){
                case "inserir":
                    $mensagem = $ctrl->inserir();
                    break;
                case "apagar":
                    $mensagem = $ctrl->apagar();
                    break;
                case "buscar":
                     $item = $ctrl->buscarPorId();
                     echo json_encode($item);
                    break;
                case "editar":
                    $mensagem = $ctrl->editar();
                    break;    

            }

            if($modo != "buscar"){
                header("Location:index.php?mensagem=".$mensagem);
            }

            break;
    
    }







?>