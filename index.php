<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Celke</title>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('#relatorio').DataTable({			
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "pesquisar_table.php",
					"type": "POST"
				}
			});
		} );
		</script>
	</head>
	<body>
		<h1>Relatório</h1>
		<form method="POST" action="pesquisar_table.php">
	Campus: <select name="campus" id="campus">
		<option value="" >Campus</option>
		<option value="Politécnico">Politécnico</option>
		</select><br><br>
	Setor: <input type="text" name="setor" placeholder="Setor"><br><br>
	Ambiente: <input type="text" name="ambiente" placeholder="Ambiente"><br><br>
	<input type="submit" value="ENVIAR">
    </form>
		<table id="relatorio" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Campus</th>
					<th>Setor</th>
					<th>Tipo de Ambiente</th>
				</tr>
			</thead>
		</table>		
	</body>
</html>
