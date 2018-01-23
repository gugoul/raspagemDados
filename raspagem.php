/* Criado por: Robert Carneiro de Assis */
/* contato: rc.assis.job@bol.com.br     */
/* Funções para raspagem de dados de    */
/*  páginas HTML					    */
<?php 
	
	
	
	if(!$_POST)
	{
		echo 'Ocorreu um erro! Tente novamente mais tarde!';
	}
	else
	{
		$case = $_POST['tipo'];
		
		switch($case)
		{
			case 1:
				raspagemSimples($_POST['endereco'],$_POST['inicio'],$_POST['fim']);
			break;
			
			case 2:
				raspagemMulti($_POST['endereco2'],$_POST['inicioC'],$_POST['fimC'],$_POST['inicio2'],$_POST['fim2']);
			break;
		}
	}
	
	
	function raspagemSimples($url,$inicio,$fim)
	{
		$pagina[0]['html'] = file_get_contents("$url");
    
		$html = str_replace(array("\n", "\s", "\t"), array('', '', ''), $pagina[0]['html']);
		
		preg_match("/<$inicio(.*)?>(.*?)<\/$fim>/", $html, $p); //As tags para inicio e fim da raspagem

		echo $p[0];
	}
	
	function raspagemMulti($url,$inicioC,$fimC,$inicio,$fim)
	{
		$arquivo = 'planilha.xls';
		for ($i = $inicioC; $i<=$fimC; $i++)
		{
			$dados = file_get_contents($url.$i);
			echo 'Pagina '.$i.'<br><br>';	
			
			$html = "<:$inicio></$fim>";
			preg_replace("/<:(.*?)>/", $html, $dados);

			echo $dados;
			
			echo '<br><br>';
		}
	}
?>