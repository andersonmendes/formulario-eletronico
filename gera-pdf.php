<?php

// Faz a inserção
include_once 'database/inserir-consulta.php';

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

/*
	Orientação: landscape -> L ou portrait -> P
	$margin-left
	$margin-right
	$margin-top
	$margin-bottom
	$margin-header
	$margin-footer
*/
$mpdf->AddPage('P','','','','',1,1,0,0,0,0);

// Inclui folha de estilo customizada
$stylesheet = file_get_contents('estiloSN.css');



// Buffer the following html with PHP so we can store it to a variable later
ob_start();

// Teste para pegar todos os campos do formulário
foreach ($_POST as $key => $value) {
    echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
}
// This is where your script would normally output the HTML using echo or print
echo 
	'
	
	<div>Generate your content</div>
	<fieldset>
	<legend>Teste</legend><input type="text">
	</fieldset>
	<p>Olá, meu nome é <span class="linha">Anderson Mendes</span>, e estou servindo atualmento no <span class="linha">CPMM</span>.
	<p>Anderson é o Máximo!</p>
	<h1>Saúde Naval</h1>
	<input type="checkbox" disabled checked="checked" name="test" /><label> Teste checkbox
	
		<div id="bloco1">Bloco 1</div>
		<div id="bloco2">Bloco 2</div>

		<input type="text" style="border-color: white;" name="inputname" value="Thereza Cristina">

	<div id="vem">
		<div id="bloco3">Bloco 3</div>
		<div id="bloco4">Bloco 4</div>
	</div>
	
	<a href="https://mpdf.github.io/html-support/html-tags.html" target="_blank">Link do manual</a>
	
	';

// Now collect the output buffer into a variable
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
//$mpdf->Output();


$date = new DateTime();


// Saves file on the server as 'filename.pdf'
$mpdf->Output('consulta-'. $date->getTimestamp() .'.pdf', "D");

?>