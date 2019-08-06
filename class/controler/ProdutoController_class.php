<?php

    class ProdutoController{

        public function __construct(){
            require_once("class/model/dao/ProdutoDAO_class.php");
            require_once("class/model/Produto_class.php");        
        }

        public function listar(){
            $produtoDao = new ProdutoDAO();
            return $produtoDao->listarTodos();
        }

        
    }
?>