<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP</title>
</head>
<body>
	<?php
		$name = 'Janusz';
		$surname = "Nowak";
		echo 'Imię: $name<br>';
		echo "Imię: $name, nazwisko:".$surname."<br>";

		//heredoc
		echo <<<DATA
			<hr>
			Heredoc<br>
			Imię i nazwisko: $name $surname<br>
			<hr>
DATA;
		//nowdoc
		echo <<<'DATA'
			<hr>
			Nowdoc<br>
			Imię i nazwisko: $name $surname<br>
			<hr>
DATA;
	?>
</body>
</html>