<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=crudapi", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM users ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["nome"])  and isset($_POST["email"]) and isset($_POST["telefone"]) and isset($_POST["cep"]))
		{
			$form_data = array(
				':nome'		=>	$_POST["nome"],
				':email'		=>	$_POST["email"],
				':telefone'		=>	$_POST["telefone"],
				':cep'		=>	$_POST["cep"],
				':uf'		=>	$_POST["uf"],
				':cidade'		=>	$_POST["cidade"],
				':bairro'		=>	$_POST["bairro"],
				':rua'		=>	$_POST["rua"]
			);
			$query = "
			INSERT INTO users 
			(nome,email,telefone,cep,uf,cidade,bairro,rua) VALUES 
			(:nome, :email, :telefone, :cep, :uf, :cidade, :bairro, :rua)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM users WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['nome'] = $row['nome'];
				$data['email'] = $row['email'];
				$data['telefone'] = $row['telefone'];
				$data['cep'] = $row['cep'];
				$data['uf'] = $row['uf'];
				$data['cidade'] = $row['cidade'];
				$data['bairro'] = $row['bairro'];
				$data['rua'] = $row['rua'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nome"]))
		{
			$form_data = array(
				':nome'	=>	$_POST['nome'],
				':email'	=>	$_POST['email'],
				':telefone'	=>	$_POST['telefone'],
				':cep'	=>	$_POST['cep'],
				':uf'	=>	$_POST['uf'],
				':cidade'	=>	$_POST['cidade'],
				':bairro'	=>	$_POST['bairro'],
				':rua'	=>	$_POST['rua'],
				':id'		=>	$_POST['id']
			);
			$query = "
			UPDATE users 
			SET nome = :nome, email = :email, telefone = :telefone, cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, rua = :rua 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM users WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>