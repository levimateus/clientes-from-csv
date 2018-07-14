#!/bin/sh
mysql -u devtest -pdevtest2018 < testePHP_2018.sql
echo -e ""

php app/inserir_clientes.php $1

mysqldump -u devtest -pdevtest2018 testePHP_2018 > database.sql
echo -e "\nBackup da base de dados testePHP_2018 salvo no arquivo database.sql"
