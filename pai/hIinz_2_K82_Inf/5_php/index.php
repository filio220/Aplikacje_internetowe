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
// echo '<pre>';
// 	// print_r($_SERVER);
// 	print_r($_GET);
// echo '</pre>';
//echo $_GET['errors']['errors'];
$errors = $_GET['errors'];
echo '<ul>';
// foreach ($errors as $error) {
// 	echo "<li>$error</li>";
// }

$errors = explode(', ', $_GET['errors']['errors']);
// var_dump($errors);
foreach ($errors as $error) {
	echo "<li>$error</li>";
}
echo '</ul>';
//echo $_GET['errors']['projectName'];
?>
<h2>Zgłoś pomysł na projekt</h2>
<form action="./submit_form.php" method="post">
  Nazwa projektu: <input type="text" name="projectName" value="<?php echo !empty($_GET['errors'] ['projectName']) ? $_GET['errors']['projectName'] : ''; 	?>"><br>
  Opis projektu:<br>
  <textarea name="projectDescription" cols="40" rows="5"></textarea><br>
  <select name="projectCategory">
    <option value="technology">Technologia</option>
    <option value="education">Edukacja</option>
    <option value="entertainment">Rozrywka</option>
  </select><br>
  Adres e-mail: <input type="text" name="email"><br>
  Potwierdź adres e-mail: <input type="text" name="confirmEmail"><br>
  <input type="submit" value="Wyślij">
</form>
</body>
</html>
