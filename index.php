<!DOCTYPE html>
<html lang="pt-br"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>XPTO Vendas</title>
<link rel="stylesheet" href="css/bootstrap.min.css">


</head>
<style>
	a {
		text-decoration: none;	
	}

</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a
		class="navbar-brand" href="vendas.jsp"><img src="img/logo-senai.jpg"
		height="25px" /></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a class="nav-link"
				href="vendas.jsp">XPTO Vendas</a></li>
			
	</div>
	</nav>
	<div class="container">
	<?php
			if(isset($_GET['mensagem'])){

		?>
		<div id="mensagem" style="background-color: #C6C3C3; border:1px solid #626060; margin-bottom:1em; margin-top:1em; font-size:25px; padding:5px;">
				<?= $_GET['mensagem'];?>

				<script>
					setTimeout(function(){ 
						$("#mensagem").fadeOut(1000);
					}, 3000);
				</script>
		</div>
		<?php
			}
		?>
		<br>
		<h3>Faça sua compra</h3>
		<form id="form" method="post" action="router.php?controller=item_venda&modo=inserir">
			<input type="hidden" id="cod_item_venda" name="cod_item_venda">
            <select class="custom-select" id="produto"
				name="produto">
				<option selected value="">Selecione um Produto!</option>
				<?php
					require_once("class/controler/ProdutoController_class.php");

					$produtoCtrl = new ProdutoController();
					$lista = $produtoCtrl->listar();

					foreach($lista as $prod){
						$json = '{"cod":'.$prod->getCod_produto().',"valor_uni":'.$prod->getValor_unitario().'}';
						echo "<option value='$json'>".$prod->getNome()."</option>";
					}				
				?>
			</select>
            <br><br>
            <input type="number" placeholder="Quatidade" name="qtde" id="qtde"
                class="form-control"><br>
            <!-- <input type="number" placeholder="Valor Unitário" name="valor_uni" id="valor_uni"
				class="form-control"><br> -->
			<button type="submit" id="salvar" class="btn btn-success">Salvar</button>
			<button type="button" id="salvar" class="btn btn-danger"
				onclick="cancelar()">Cancelar</button>
		</form>
		<br> <br>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col" width="15%">Produto</th>
					<th scope="col" width="30%">Quatidade</th>
					<th scope="col" width="15%">Valor Total</th>
					<th scope="col" width="20%">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					require_once("class/controler/ItemVendaController_class.php");
					$itemVendaControler = new ItemVendaController("listar");
					$listaItemVenda = $itemVendaControler->listar();
				
					foreach($listaItemVenda as $item){
						$quantidade = $item->getQuantidade();
						$valorTotal = 'R$ '. number_format($item->getValor_total(), 2, ',', ' ');
						$id = $item->getCod_item_venda();

						echo "
							<tr>
								<td>$item->nome</td>
								<td>$quantidade</td>
								<td>$valorTotal</td>
								<td>
									<a href='router.php?controller=item_venda&modo=apagar&id=$id>'>
										<input type='submit' name='btn-apagar' value='Excluir' data-target='#modalExemplo' data-toggle='modal' class='btn btn-danger' onclick=''/>
									</a>	
									<input type='submit' name='btn-editar' value='Editar' class='btn btn-warning' onclick='editar($id)'/>
								</td>	
							</tr>";
						}
				?>
			</tbody>
		</table>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		function editar(codItem){
			$.ajax({
				url:"router.php?controller=item_venda&modo=buscar",
				type: "post",
				data:{
					cod: codItem
				},
				beforeSend: function(){
					$("#mensagem").html("Aguarde...Buscando")
				}
			}).done(function(itemVenda){
				//transformando o contéudo da requisição em json
				let produtoEditar = JSON.parse(itemVenda);

				//pega o elemento select
				let selectProduto = document.getElementById("produto"); 

				//pega a lista de options do select
				let optionsProdutos = selectProduto.options;

				let cont = 0;
				for(let produto of optionsProdutos){

					let produtoJson = JSON.parse(produto.value || "[]");

					if(produtoJson.cod == produtoEditar.codProduto){
						selectProduto.options[cont].selected = true;
					}else{

					}
					cont++;
				}				

				$('#qtde').val(produtoEditar.quantidade);
				$('#form').attr("action","router.php?controller=item_venda&modo=editar");
				$('#cod_item_venda').val(produtoEditar.codItemVenda);
			})
		}
		
	</script>
</body>
</html>