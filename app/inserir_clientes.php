<?php 
require_once 'Cliente.php';
require_once 'DAOCliente.php';

if ($argc == 2) {
	$file = $argv[1];

	if (".csv" == strtolower(substr($file, -4))){
		$handle = fopen($file, 'r')
		or die("Não foi possível abrir o arquivo\n\n");

		$clientes = array();

		$cont = 0;

		while ($registro = fgetcsv($handle, 1000, ';')){
			// impede que o cabeçalho do arquivo seja salvo como se
			// fosse dado de cliente
			if ($cont > 0) {
				$cliente = new Cliente();
				$cliente->setNome(addslashes($registro[0]));
				$cliente->setEmail(addslashes($registro[1]));
				$cliente->setEndereco(addslashes($registro[2]));
				$cliente->setDataCadastro(addslashes($registro[3]));

				$clientes[] = $cliente;
			}

			$cont++;
		}

		$DAOCliente = new DAOCliente('localhost', 'aml_testePHP_2018', 'aml_devtest', 'aml_devtest2018');

		echo "Executando operação\n";
		$DAOCliente->inserirVarios($clientes);
		echo "Operação finalizada\n\n";


		return true;

	} else {
		echo "O programa só aceita arquivos com extensão .CSV\n\n";
	}
	
} else {
	echo "Informe um arquivo .CSV com a lista de clientes\n\n";
	exit(1);
}

