# Inserção automatizada de clientes
Este programa insere clientes no banco de dados a partir de um arquivo CSV
Para executá-lo, digite o seguinte comando:
```sh
$ ./clientes 'caminho para o arquivo .csv'
```
O programa irá criar a base de dados de clientes, caso ela ainda não exista. Depois de inserir todos os registros, ele também realizará um *dump* na base de dados, gerando o arquivo *database.sql*.