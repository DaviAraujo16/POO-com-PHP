<?php

    require_once("BaseDAO_class.php");

    class ItemVendaDAO extends BaseDAO{
        
        public function inserir(itemVenda $itemVenda){

            $sqlInsert = "INSERT INTO item_venda VALUES (:cod_item_venda, :cod_produto, :quantidade, :valor_total)";

            $smtp = $this->conexao->prepare($sqlInsert);

            $dados = [
                'cod_item_venda' => $itemVenda->getCod_item_venda(),
                'cod_produto' => $itemVenda->getCod_produto(),
                'quantidade' => $itemVenda->getQuantidade(),
                'valor_total' => $itemVenda->getValor_total()
            ];

            return $smtp->execute($dados);

            //Transforma o objeto em array e executa a query
            //$smtp->execute((array)$itemVenda);
        }

        public function listarTodos(){

            $sqlSelectAll = "SELECT * FROM item_venda AS i INNER JOIN produtos AS p ON i.cod_produto = p.cod_produto ORDER BY i.cod_item_venda;";
            $rs = $this->conexao->query($sqlSelectAll);

            $rs->setFetchMode(PDO::FETCH_CLASS,"ItemVenda");
            $rs->execute();

            $obj = $rs->fetchAll();

            return $obj;
            
        }


        public function apagar(int $id){
            $sqlDelete = "DELETE FROM item_venda WHERE cod_item_venda = ?";

            $smtp = $this->conexao->prepare($sqlDelete);

            $smtp->bindParam(1,$id);

            if($smtp->execute()){
                return true;
            }else{
                die("erro ao deletar");
                return false;
            }
        }

        public function bucarPorId(int $id){
            $sqlSelectId = "SELECT * FROM item_venda WHERE cod_item_venda = ?";

            $smtp = $this->conexao->prepare($sqlSelectId);
            $smtp->bindParam(1,$id);

            $smtp->setFetchMode(PDO::FETCH_CLASS, 'ItemVenda');
            $smtp->execute();

            $item = $smtp->fetch();

            $arr = array(
                'codItemVenda' => $item->getCod_item_venda(),
                'codProduto' => $item->getCod_produto(),
                "quantidade" => $item->getQuantidade(),
                "valorTotal" => $item->getValor_total()
            );
            
            return $arr;
        }

        public function editar(ItemVenda $itemVenda){
            $sqlUpdate = "UPDATE item_venda SET cod_produto = ?, quantidade = ?, valor_total = ? WHERE cod_item_venda = ?";

            $smtp = $this->conexao->prepare($sqlUpdate);
            $smtp->bindParam(1, $itemVenda->getCod_produto());
            $smtp->bindParam(2, $itemVenda->getQuantidade());
            $smtp->bindParam(3, $itemVenda->getValor_total());
            $smtp->bindParam(4, $itemVenda->getCod_item_venda());

            return $smtp->execute();


        }
    }
?>
