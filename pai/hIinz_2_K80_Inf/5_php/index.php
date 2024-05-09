<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projekty</title>
  <link rel="stylesheet" href="./styles.css">
  <script src="./script.js"></script>
</head>
<body>
<?php
//echo $_GET['errors'];
//echo $_GET['projectName'];
if (!empty($_GET['errors'])) {
$errors = explode(',', $_GET['errors']);
echo '<ul>';
foreach ($errors as $error) {
	echo '<li>'.$error.'</li>';
}
echo '</ul>';

?>
<h2>Zgłoś pomysł na projekt</h2>
<form action="./submit_form.php" method="post">
  Nazwa projektu: <input type="text" name="projectName" value="<?php echo !empty($_GET['projectName'])? $_GET['projectName'] : ''; ?>" autofocus><br>
  Opis projektu:<br>
  <textarea name="projectDescription" cols="40" rows="15" ><?php echo !empty($_GET['projectDescription'])? $_GET['projectDescription'] : ''; ?></textarea><br>
  <select name="projectCategory">
		<?php
		$projectCategories = array(
			'technology' => 'Technologia',
			'education' => 'Edukacja',
			'entertainment' => 'Rozrywka'
		);
		$selectedCategory = $_GET['projectCategory'];
		foreach ($projectCategories as $projectCategory => $categoryName) {
			$selected = $selectedCategory == $projectCategory?'selected' : '';
			echo '<option value="'.$projectCategory.'" '.$selected.'>'.$categoryName.'</option>';
		}
		?>
  </select><br>
  Adres e-mail: <input type="text" name="email" value="<?php echo !empty($_GET['email'])? $_GET['email'] : ''; ?>"><br>
  Powtórz adres e-mail: <input type="text" name="confirmEmail" value="<?php echo !empty($_GET['confirmEmail'])? $_GET['confirmEmail'] : ''; ?>"><br>
  <input type="submit" value="Wyślij">
</form>
</body>
</html>