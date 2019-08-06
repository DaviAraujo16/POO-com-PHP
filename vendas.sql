CREATE DATABASE IF NOT EXISTS `vendas_phppoo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vendas_phppoo`;

CREATE TABLE `item_venda` (
  `cod_item_venda` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `produtos` (
  `cod_produto` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor_unitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`cod_item_venda`),
  ADD KEY `fk_item_venda_produto` (`cod_produto`);

ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod_produto`);

ALTER TABLE `item_venda`
  MODIFY `cod_item_venda` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produtos`
  MODIFY `cod_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

 ALTER TABLE `item_venda`
  ADD CONSTRAINT `fk_item_venda_produto` FOREIGN KEY (`cod_produto`) REFERENCES `produtos` (`cod_produto`);


INSERT INTO `produtos` (`cod_produto`, `nome`, `valor_unitario`) VALUES
(1, 'Shampoo', 10),
(2, 'Condicionador', 15),
(3, 'Creme para pentear', 14),
(4, 'Creme para rugas', 25),
(5, 'Desodorante creme', 5);
