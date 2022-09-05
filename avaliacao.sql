
--
-- Banco de dados: `avaliacao`
--

CREATE DATABASE avaliacao
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE USER 'admin'@'localhost' IDENTIFIED BY '#$enha123#';

GRANT ALL PRIVILEGES ON avaliacao.* TO 'admin'@'localhost' 
REQUIRE NONE WITH GRANT OPTION 
MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

FLUSH PRIVILEGES;

USE avaliacao;

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8;


