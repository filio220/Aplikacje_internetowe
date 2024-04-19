<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		$name = "Janusz";
		echo 'index.php<br>';
		echo 'Imię: $name<br>';
		echo "Imię: $name<br>";

		//heredoc
		echo <<<DATA
			<hr>Heredoc<br>
			Imię: $name
			<hr> 
DATA;

		//nowdoc
		echo <<<'DATA'
			<hr>Nowdoc<br>
			Imię: $name
			<hr> 
DATA;

	?>
</body>
</html>