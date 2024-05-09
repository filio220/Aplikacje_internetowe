<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projekty</title>
	<link rel="stylesheet" href="./styles.css">
	<script src="./script.js"></script>
</head>
<body>
<?php
if (!empty($_GET['errors'])) {
	//print_r($_GET['errors']);
	$errors = explode(', ', $_GET['errors']);
	echo '<ul>';
	foreach ($errors as $error) {
		echo '<li>' . $error . '</li>';
	}
	echo '</ul>';
}
?>
<h2>Zgłoś pomysł na projekt</h2>
<form action="./submit_form.php" method="post">
	Nazwa projektu: <input type="text" name="projectName" autofocus><br>
	Opis projekt:<br>
	<textarea name="projectDescription" cols="40" rows="15"></textarea><br>
	<select name="projectCategory">
		<option value="technology">Technologia</option>
		<option value="education">Edukacja</option>
		<option value="entertainment">Rozrywka</option>
	</select><br>
	Adres e-mail: <input type="text" name="email"><br>
	Powtórz adres e-mail: <input type="text" name="confirmEmail"><br>
	<input type="submit" value="Wyślij">
</form>
</body>
</html>
