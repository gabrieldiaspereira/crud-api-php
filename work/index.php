<?php // tag para o GitHub entender como linguagem 'PHP' e não 'HACK' ?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP API CRUD - Gabriel Dias Pereira</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">PHP API CRUD</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Adicionar usuário</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">Nome</th>
							<th class="text-center">Email</th>
							<th class="text-center">Telefone</th>
							<th class="text-center">CEP</th>
							<th class="text-center">UF</th>
							<th class="text-center">Cidade</th>
							<th class="text-center">Bairro</th>
							<th class="text-center">Rua</th>
							<th colspan="2" class="text-center">Ação</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Adicionar usuário</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Nome</label>
			        	<input required type="text" name="nome" id="nome" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Email</label>
			        	<input required type="email" placeholder="exemplo@exemplo.com" name="email" id="email" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Telefone</label>
			        	<input required type="text" name="telefone" id="telefone" class="form-control" placeholder="(00)00000-0000" 
								onkeyup="maskIt(this,event,'(##)####-####')" />
			        </div>
			        <div class="form-group">
			        	<label>CEP</label>
			        	<input required type="text" placeholder="00000-000" name="cep" id="cep" class="form-control" 
								onkeyup="maskIt(this,event,'#####-###')"/>
			        </div>
			        <div class="form-group">
			        	<label>UF</label>
			        	<input required maxlength="2" type="text" name="uf" id="uf" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Cidade</label>
			        	<input required type="text" name="cidade" id="cidade" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Bairro</label>
			        	<input required type="text" name="bairro" id="bairro" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Rua</label>
			        	<input required type="text" name="rua" id="rua" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('Adicionar Usuário');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nome').val() == '' && $('#email').val() == '' && $('#telefone').val() == '' && $('#cep').val() == ''
		&& $('#uf').val() == '' && $('#cidade').val() == '' && $('#bairro').val() == '' && $('#rua').val() == '')
		{
			alert("O preenchimento de todos os campos é obrigatório!");
		}
		else
		{
			var form_data = $(this).serialize();
			console.info(form_data);
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					console.info(data);
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Usuário inserido com sucesso!");
					}
					if(data == 'update')
					{
						alert("Usuário alterado com sucesso!");
					}
					if(data == 'error')
					{
						alert("Houve um erro ao realizar esta ação!");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(id);
				$('#nome').val(data.nome);
				$('#email').val(data.email);
				$('#telefone').val(data.telefone);
				$('#cep').val(data.cep);
				$('#uf').val(data.uf);
				$('#cidade').val(data.cidade);
				$('#bairro').val(data.bairro);
				$('#rua').val(data.rua);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Editar usuário');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Você tem certeza que deseja excluir este usuário?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Usuário excluido com sucesso!");
				}
			});
		}
	});

});

function maskIt(w,e,m,r,a){
	 // Cancela se o evento for Backspace
	 if (!e) var e = window.event
	 if (e.keyCode) code = e.keyCode;
	 else if (e.which) code = e.which;
	
	 // Variáveis da função
	 var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
	 var mask = (!r) ? m : m.reverse();
	 var pre  = (a ) ? a.pre : "";
	 var pos  = (a ) ? a.pos : "";
	 var ret  = "";

	 if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

	 // Loop na máscara para aplicar os caracteres
	 for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
			 if(mask.charAt(x)!='#'){
					 ret += mask.charAt(x); x++;
			 } else{
					 ret += txt.charAt(y); y++; x++;
			 }
	 }
	
	 // Retorno da função
	 ret = (!r) ? ret : ret.reverse()
	 w.value = pre+ret+pos;
}

$(document).ready(function() {

function limpa_formulário_cep() {
		// Limpa valores do formulário de cep.
		$("#rua").val("");
		$("#bairro").val("");
		$("#cidade").val("");
		$("#uf").val("");
		
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() {

		//Nova variável "cep" somente com dígitos.
		var cep = $(this).val().replace(/\D/g, '');

		//Verifica se campo cep possui valor informado.
		if (cep != "") {

				//Expressão regular para validar o CEP.
				var validacep = /^[0-9]{8}$/;

				//Valida o formato do CEP.
				if(validacep.test(cep)) {
							 

						//Preenche os campos com "..." enquanto consulta webservice.
						$("#rua").val("...");
						$("#bairro").val("...");
						$("#cidade").val("...");
						$("#uf").val("...");
						
						//Consulta o webservice viacep.com.br/
						$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

								if (!("erro" in dados)) {
										//Atualiza os campos com os valores da consulta.
										$("#rua").val(dados.logradouro);
										$("#bairro").val(dados.bairro);
										$("#cidade").val(dados.localidade);
										$("#uf").val(dados.uf);
										
								} //end if.
								else {
										//CEP pesquisado não foi encontrado.
										limpa_formulário_cep();
										alert("CEP não encontrado.");
								}
						});
				} //end if.
				else {
						//cep é inválido.
						limpa_formulário_cep();
						alert("Formato de CEP inválido.");
				}
		} //end if.
		else {
				//cep sem valor, limpa formulário.
				limpa_formulário_cep();
		}
});
});	
</script>