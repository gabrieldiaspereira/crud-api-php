<?php

//fetch.php

$api_url = "http://localhost/crudapi/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';
if($result != ''){
if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td class="text-center">'.$row->nome.'</td>
			<td class="text-center">'.$row->email.'</td>
			<td class="text-center">'.$row->telefone.'</td>
			<td class="text-center">'.$row->cep.'</td>
			<td class="text-center">'.$row->uf.'</td>
			<td class="text-center">'.$row->cidade.'</td>
			<td class="text-center">'.$row->bairro.'</td>
			<td class="text-center">'.$row->rua.'</td>
			<td class="text-center"><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Editar</button></td>
			<td class="text-center"><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Deletar</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="10" align="center">Nenhum registro encontrado!/td>
	</tr>
	';
}
}else{
	$output .= '
	<tr>
		<td colspan="10" align="center">Nenhum registro encontrado!</td>
	</tr>
	';
}
echo $output;

?>