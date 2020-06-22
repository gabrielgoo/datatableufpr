//Testando pesquisa através da criação das variaveis com POST.
<?php
$conn = pg_connect("host=localhost port=5432 dbname=gabriel user=postgres password=postgres");

//Responsavel pelo POST
$verifica = 0;
$campus = $_POST['campus'];
$setor = $_POST['setor'];
$ambiente = $_POST['ambiente'];

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => campus da coluna no banco de dados
$columns = array( 
	0 =>'campus', 
	1 => 'setor',
	2=> 'ambiente'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_table = "SELECT campus, setor, ambiente FROM ccja_andar_0";
$resultado_table =pg_query($conn, $result_table);
$qnt_linhas = pg_num_rows($resultado_table);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT campus, setor, ambiente FROM ccja_andar_0 WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( campus LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR setor LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR ambiente LIKE '".$requestData['search']['value']."%' )";
}

$resultado_usuarios=pg_query($conn, $result_usuarios);
$totalFiltered = pg_num_rows($resultado_usuarios);
//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=pg_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while( $row_usuarios =pg_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row_usuarios["campus"];
	$dado[] = $row_usuarios["salario"];
	$dado[] = $row_usuarios["ambiente"];	
	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantambiente de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json
