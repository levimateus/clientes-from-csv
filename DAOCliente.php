<?php 
require_once 'Cliente.php';

class DAOCLiente
{
	private $pdo;

	function __construct($host, $dbName, $user, $password){
		try {
			$this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
		} catch (PDOException $e) {
			echo "Erro: ".$e->getMessage();
			exit();
		}
	}

	public function selecionar($id){
		$query = "SELECT * FROM clientes WHERE id = :id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$resultado = $stmt->fetch();
			
			$cliente = new Cliente();
			$cliente->setId($resultado['id']);
			$cliente->setNome($resultado['nome']);
			$cliente->setEmail($resultado['email']);
			$cliente->setEndereco($resultado['endereco']);
			$cliente->setDataCadastro($resultado['data_cadastro']);

			return $cliente;
		} else {
			return false;
		}
	}

	public function inserir($cliente){
		$query = "INSERT INTO clientes (nome, email, endereco, data_cadastro)
			VALUES (:nome, :email ,:endereco ,:dataCadastro)";

		$stmt = $this->pdo->prepare($query);

		$nome = $cliente->getNome();
		$email = $cliente->getEmail();
		$endereco = $cliente->getEndereco();
		$dataCadastro = (empty($cliente->getDataCadastro())) 
		 						? NULL 
		 						: implode('-', array_reverse(explode('-', $cliente->getDataCadastro()))).'';


		$stmt->bindParam(":nome", $nome);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":endereco", $endereco);
		$stmt->bindParam(":data_cadastro", $dataCadastro);

		return $stmt->execute();
	}

	public function apagar($id){
		$query = "DELETE FROM clientes WHERE id = :id";
		$stmt = $this->pdo->prepare($query);
		$stmt->bindParam(":id", $id);
		return $stmt->execute();
	}

	public function atualizar($cliente){
		$query = "UPDATE clientes
					SET nome = :nome, email = :email, endereco = :endereco, data_cadastro = :data_cadastro
					WHERE id = :id";

		$stmt = $this->pdo->prepare($query);

		$id = $cliente->getId();
		$nome = $cliente->getNome();
		$email = $cliente->getEmail();
		$endereco = $cliente->getEndereco();
		$dataCadastro = (empty($cliente->getDataCadastro())) 
		 						? NULL 
		 						: implode('-', array_reverse(explode('-', $cliente->getDataCadastro()))).'';


		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":nome", $nome);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":endereco", $endereco);
		$stmt->bindParam(":data_cadastro", $dataCadastro);

		return $stmt->execute();
	}

	public function inserirVarios($clientes){
		if (!empty($clientes)) {
			$tamanho = sizeof($clientes);

			$query = "INSERT INTO clientes (nome, email, endereco, data_cadastro) 
						VALUES (:nome, :email, :endereco, :data_cadastro)";

			foreach ($clientes as $cliente) {
				$stmt = $this->pdo->prepare($query);

				$nome = $cliente->getNome();
				$email = $cliente->getEmail();
				$endereco = $cliente->getEndereco();
				 $dataCadastro = (empty($cliente->getDataCadastro())) 
				 					? NULL 
				 					: implode('-', array_reverse(explode('-', $cliente->getDataCadastro()))).'';

				$stmt->bindParam(":nome", $nome);
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":endereco", $endereco);
				$stmt->bindParam(":data_cadastro", $dataCadastro);

				$stmt->execute();
			}
		}
	}
}