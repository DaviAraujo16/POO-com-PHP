<?php

    class ItemVendaController{

        public function __construct(){
            require_once("class/model/dao/ItemVendaDAO_class.php");
            require_once("class/model/ItemVenda_class.php");
        }

        public function inserir(){
            
            $itemVenda = new ItemVenda();
            $itemVenda->setCod_item_venda(0);
            $itemVenda->setQuantidade($_POST['qtde']);

            $json = $_POST['produto'];
            $obj = json_decode($json, true);

            $valUnitario = $obj['valor_uni'];
        
            $itemVenda->setValor_total($this->calculaTotal($itemVenda->getQuantidade(), $valUnitario));

            $itemVenda->setCod_produto($obj['cod']);

            $itemVendaDAO = new ItemVendaDAO();

            if($itemVendaDAO->inserir($itemVenda)){
                return "Inserido com Sucelso!";
            }else{
                return "Problemas ao Inserir!";
            }
        }

        private function calculaTotal($qtde, $valUnitario){
            return $valUnitario * $qtde;
        }

        public function listar(){
          
            $itemVendaDAO = new ItemVendaDAO();
            return $itemVendaDAO->listarTodos(); 

        }

        public function apagar(){
            $id = $_GET['id'];
            $itemVendaDAO = new ItemVendaDAO();
            if($itemVendaDAO->apagar($id)){
                return "Excluido com Sucelso!";
            }else{
                return "Problemas ao Excluir!";
            }
        }

        public function editar(){
            $itemVenda = new ItemVenda();
            $itemVenda->setCod_item_venda($_POST['cod_item_venda']);
            $itemVenda->setQuantidade($_POST['qtde']);

            $json = $_POST['produto'];
            $obj = json_decode($json, true);
            $valUnitario = $obj['valor_uni'];
            $itemVenda->setCod_produto($obj['cod']);


            $itemVenda->setValor_total($this->calculaTotal($itemVenda->getQuantidade(), $valUnitario));

            $itemVendaDAO = new ItemVendaDAO();

            if($itemVendaDAO->editar($itemVenda)){
                return "Editado com Sucelso!";
            }else{
                return "Erro ao editar";
            }

        }

       

        public function buscarPorId(){
            $id = $_POST['cod'];
            $itemVendaDAO = new ItemVendaDAO();
            return $itemVendaDAO->bucarPorId($id);

        }



    }


?>