#!/bin/sh
mysql -u aml_devtest -paml_devtest2018 < aml_testePHP_2018.sql
echo -e ""

retorno= php app/inserir_clientes.php $1

mysqldump -u aml_devtest -paml_devtest2018 aml_testePHP_2018 > database.sql
echo -e "\nBackup da base de dados aml_testePHP_2018 salvo no arquivo database.sql"
