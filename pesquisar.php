<?php
	$conn = pg_connect("host=localhost port=5432 dbname=gabriel user=postgres password=postgres");
	//Criar a conexao	
	?>
	<a href="index.php">Voltar</a><br>
	<a href="gerar_pdf.php">Gerar Relatório PDF</a><br><br>

	<?php
	$verifica = 0;
	$campus = $_POST['campus'];
	$setor = $_POST['setor'];
	$ambiente = $_POST['ambiente'];

   if(!empty($campus) && !empty($setor) && !empty($ambiente)){
		$result = "SELECT * FROM ccja_andar_0 WHERE \"campus\" ilike '%" .$campus. "%' AND \"setor\" ilike '%" .$setor. "%' AND \"ambiente\" ilike '%" .$ambiente. "%' ORDER BY \"setor\" ASC ";
		$resultado_final = pg_query($conn, $result);
		$verifica = pg_num_rows($resultado_final);
	}
	elseif(!empty($campus)){
		$result = "SELECT * FROM ccja_andar_0 WHERE \"campus\" ilike '%" .$campus. "%' ORDER BY \"campus\" ASC";
		$resultado_final = pg_query($conn, $result);
		$verifica = pg_num_rows($resultado_final);
	}
	elseif(!empty($setor)){		
		$result = "SELECT * FROM ccja_andar_0 WHERE \"setor\" ilike '%" .$setor. "%' ORDER BY \"setor\" ASC";
		$resultado_final = pg_query($conn, $result);	
	 	$verifica = pg_num_rows($resultado_final);
	}
	elseif(!empty($ambiente)){		
		$result = "SELECT * FROM ccja_andar_0 WHERE \"ambiente\" ilike '%" .$ambiente. "%' ORDER BY \"ambiente\" ASC";
		$resultado_final = pg_query($conn, $result);	
	 	$verifica = pg_num_rows($resultado_final);
	}
 	if($verifica > 0){
        while($rows_resultados = pg_fetch_array($resultado_final)){
			echo "Campus: ".$rows_resultados['campus']."<br>";
			echo "Setor: ".$rows_resultados['setor']."<br>";
			echo "Ambiente: ".$rows_resultados['ambiente']."<hr>";
		}
	}
	else{
		echo "Nenhum resultado encontrado na pesquisa";
    }
?>