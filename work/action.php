<?php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		$form_data = array(
			'nome'	=>	'1',//$_POST['nome'],
			'email'	=>	'2',//$_POST['email'],
			'telefone'	=>	'3',//$_POST['telefone'],
			'cep'	=>	'4',//$_POST['cep'],
			'uf'	=>	'5',//$_POST['uf'],
			'cidade'	=>	'6',//$_POST['cidade'],
			'bairro'	=>	'7',//$_POST['bairro'],
			'rua'	=>	'8',//$_POST['rua']
			
		);
		$api_url = "http://localhost/crudapi/api/test_api.php?action=insert";
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://localhost/crudapi/api/test_api.php?action=fetch_single&id=".$id."";
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'nome'	=>	$_POST['nome'],
			'email'	=>	$_POST['email'],
			'telefone'	=>	$_POST['telefone'],
			'cep'	=>	$_POST['cep'],
			'uf'	=>	$_POST['uf'],
			'cidade'	=>	$_POST['cidade'],
			'bairro'	=>	$_POST['bairro'],
			'rua'	=>	$_POST['rua'],
			'id'	=>	$_POST['hidden_id']
		);
		$api_url = "http://localhost/crudapi/api/test_api.php?action=update";
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/crudapi/api/test_api.php?action=delete&id=".$id."";
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>