<?php

    //Essa é uma classe genérica que obriga todos que erdam dela implementem o método listarTodos
    abstract class BaseDAO{

        protected $conexao;

        //No Construtor é Iniciado uma Conexão com o Banco de Dados
        public function __construct(){
            require_once('ConexaoBD_class.php');
            $conexaoBD = new ConexaoBd();
            $this->conexao = $conexaoBD->conectar();
        }

        abstract function listarTodos();
    } 



?>