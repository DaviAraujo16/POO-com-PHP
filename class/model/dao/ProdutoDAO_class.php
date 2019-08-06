<?php

    require_once("BaseDAO_class.php");

    class ProdutoDAO extends BaseDAO{

        public function listarTodos(){

            $sqlSelectAll = "SELECT * FROM produtos ORDER BY nome";

            //Esse comando executa uma query SQL é coloca em um Result Set 
            $rs = $this->conexao->query($sqlSelectAll);

            //Relaciona o resultado da query com um classe
            $rs->setFetchMode(PDO::FETCH_CLASS, "Produto");
            $rs->execute();
            
            //Cria um Objeto com os resultados das Querys
            $obj = $rs->fetchAll();
            
            return $obj;
            
        }
    }

    // $dao = new ProdutoDao();
    // $lista = $dao->listarTodos();

    // foreach($lista as $produto){
    //     echo $produto->getNome() . " " . $produto->getValor_unitario() . '<br>';
    // }
?>