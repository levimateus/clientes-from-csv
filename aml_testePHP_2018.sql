
CREATE SCHEMA aml_testePHP_2018;

USE aml_testePHP_2018;

CREATE TABLE clientes(
	id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(255),
	email VARCHAR(255),
	endereco VARCHAR(255),
	data_cadastro DATE
);