<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h3>Dane z formularza</h3>
	<?php
		//echo $_POST['firstName'];
		//if (isset($_POST)) {
		if (!empty($_POST['firstName']) && !empty($_POST['pass'])) {
			echo "Dane:<br>";
			foreach ($_POST as $data) {
				echo "$data<br>"; 
			}

			echo "<hr>";
			echo '<pre>';
				print_r($_POST);
			echo '</pre>';
			var_dump($_POST);
		}else{
			//echo "Brak danych";
			echo "<script>history.back();</script>";
		}
		
	?>
</body>
</html>