<!DOCTYPE html>
<html>
<head>
	<title></title>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php require_once 'tiposDeFormularios.php'; ?>

<script>
$(function() {

	/* ===========================================
	   BUSCA CEP ---------------------------------
	   =========================================== */
	$("#cep").focusout(function(){
			//Início do Comando AJAX
			$.ajax({
				//O campo URL diz o caminho de onde virá os dados
				//É importante concatenar o valor digitado no CEP
				url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
				//Aqui você deve preencher o tipo de dados que será lido,
				//no caso, estamos lendo JSON.
				dataType: 'json',
				//SUCESS é referente a função que será executada caso
				//ele consiga ler a fonte de dados com sucesso.
				//O parâmetro dentro da função se refere ao nome da variável
				//que você vai dar para ler esse objeto.
				success: function(resposta){
					//Agora basta definir os valores que você deseja preencher
					//automaticamente nos campos acima.
					$("#logradouro").val(resposta.logradouro);
					$("#complemento").val(resposta.complemento);
					$("#bairro").val(resposta.bairro);
					$("#cidade").val(resposta.localidade);
					$("#uf").val(resposta.uf);
					//Vamos incluir para que o Número seja focado automaticamente
					//melhorando a experiência do usuário
					$("#numero").focus();
				}
			});
		});
	/* =========================================== 
	   FIM BUSCA CEP -----------------------------
	   =========================================== */


	/* ===========================================
	   AUTOCOMPLETAR NIP  ------------------------
	   =========================================== */
	var nips = [
		"11112085",
		"12124583",
		"19222277",
		"11114578",
		"00000000"
	];

	$("input[name='nip']" ).autocomplete({
	    source: nips
	  });
	/* ===========================================
	   FIM AUTOCOMPLETAR NIP  --------------------
	   =========================================== */


	/* ===========================================
	   EXIBE/ESCONDE CAMPOS ESPECÍFICOS  ---------
	   =========================================== */
	function escondeTodosEspecificos() { $(".blocoEspecifico").hide(); }
	function apareceEspecifico(v) { $("[id=bloco_"+ v +"]").show(); }

	//var quantidadeEspeficos = $('#tipo option').length;
	escondeTodosEspecificos();
	$("#tipo").change(function () {

		if ($(this).val() == "selecione") {
			escondeTodosEspecificos();
	    }

		if ($(this).val() == "<?php print_r($chavesDosTipos[0]); ?>") {
			escondeTodosEspecificos();
	        apareceEspecifico($(this).val());
	    } 

	    if ($(this).val() == "<?php print_r($chavesDosTipos[1]); ?>") {
	    	escondeTodosEspecificos();
	        apareceEspecifico($(this).val());
	    }

	    if ($(this).val() == "<?php print_r($chavesDosTipos[2]); ?>") {
	    	escondeTodosEspecificos();
	        apareceEspecifico($(this).val());
	    }
	});
	/* ===========================================
	   FIM EXIBE/ESCONDE CAMPOS ESPECÍFICOS  -----
	   =========================================== */

});
</script>
</head>
<body>

<form method="POST" action="#" style="width: 800px; margin: 0 auto; padding-bottom: 200px;">

	<?php require_once 'dados_basicos.php'; ?>

	<fieldset>
		<label>Masculino:</label>
		<input type="radio" name="sexo" value="M">
		<br>
		<label>Feminino:</label>
		<input type="radio" name="sexo" value="F">
	</fieldset>

	<div class="form-group">
		<label>Tipo de Formulário</label>
		<select class="form-control" id="tipo" name="tipo">
			<option selected disabled>Selecione uma opção</option>
			<?php
				foreach ($listaDeTipos as $chave => $valor) {
					echo "<option value=\"$chave\">$valor</option>";
				}
			?>
		</select>
	</div>

	<!-- ========================================= -->
	<!-- - CAMPOS ESPECÍFICOS DE CADA FORMULÁRIO - -->
	<!-- ========================================= -->
	<?php
		require_once "especificos/mamografia.php";
		require_once "especificos/raiox.php";
		//include_once "especificos/riscocirurgico.php";
	?>
	<!-- ========================================= -->
	<!-- FIM CAMPOS ESPECÍFICOS DE CADA FORMULÁRIO -->
	<!-- ========================================= -->

	<!-- <input type="submit" name="submit" value="gerar pdf"> -->
</form>










<script type="text/javascript">
	var json = {
  '0': '{ "codBanco":"085","banco":"cecred","cedente":"Aluno 2","datas":"2017/08/30","nosso_numero":"00042200000000099","cedente_cnpj":"06624079975","agencia":"01066","codigo_cedente":"00042200","conta_corrente":"00042200","carteira":"01","pagador":"Aluno 2","convenio":"testes","cod_convenio":"106004","valor":"1600","documento":"99","instrucoes":"Após o vencimento cobrar R$ 0,05 ao dia."}',
  '1': '{ "codBanco":"085","banco":"cecred","cedente":"Aluno 2","datas":"2017/08/30","nosso_numero":"00042200000000099","cedente_cnpj":"06624079975","agencia":"01066","codigo_cedente":"00042200","conta_corrente":"00042200","carteira":"01","pagador":"Aluno 2","convenio":"testes","cod_convenio":"106004","valor":"1600","documento":"99","instrucoes":"Após o vencimento cobrar R$ 0,05 ao dia." }'
};

var array = Object.keys(json).map(i => JSON.parse(json[Number(i)]));

var boletos = array.map(entrada => {
  return {
    'valor': entrada.valor,
    'nosso_numero': entrada.nosso_numero,
    'numero_documento': entrada.documento,
    'cedente': entrada.cedente,
    'cedente_cnpj': entrada.cedente_cnpj,
    'agencia': entrada.agencia,
    'codigo_cedente': entrada.codigo_cedente,
  }
});
console.log(boletos);


var recebePacientes = $.getJSON( "json/paciente.json", function(dados) {
  //console.log( "Sucesso" );
  //console.log(dados);
  //console.log(dados[0].nip)
});
</script>

</body>
</html>