<?php

    class Produto{
        
        private $cod_produto;
        private $nome;
        private $valor_unitario;

        public function getCod_produto() {
            return $this->cod_produto;
        }
        
        public function setCod_produto($cod_produto) {
            $this->cod_produto = $cod_produto;
        }

        public function getNome() {
        	return $this->nome;
        }

        public function setNome($nome) {
        	$this->nome = $nome;
        }

        public function getValor_unitario() {
        	return $this->valor_unitario;
        }

        public function setValor_unitario($valor_unitario) {
        	$this->valor_unitario = $valor_unitario;
        }

    }
?>    
