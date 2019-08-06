<?php

    class ConexaoBd{

        //Atributos de uma Conexão com o Banco de Dados
        private $dns;
        private $user;
        private $pass;

        //Método Construtor onde relaciona os atributos aos valores da conexão
        function __construct(){
            $this->dns = "mysql:host=localhost;dbname=vendas_phppoo";
            $this->user = "root";
            $this->pass= "bcd127";
        }

        //Método que inicia uma conexão com o banco 
        public function conectar(){
            try{
                $conexao = new PDO($this->dns,$this->user,$this->pass);
                return $conexao;
            }catch(PDOException $e){
                echo "Erro ao Conectar com a Banco de Dados...<br>" 
                    . $e->getLine() . " Mensagem de Erro " . $e->getMessage();
            }
        }

        //Método que encerra a Conexão
        public function desconectar(){
            $this->conexao = null;
        }

    }

   

    
?>