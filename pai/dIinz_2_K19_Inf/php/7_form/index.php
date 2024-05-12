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
    if (isset($_GET['errors'])) {
      //echo $_GET['errors'];
      $errors = $_GET['errors'];
      $errors = explode(', ', $errors);
      echo '<ul>';
        foreach ($errors as $error) {
          echo '<li>'.$error.'</li>';
        }
      echo '</ul>';
    }
  ?>
  <h3>Zgłoś pomyśł na projekt</h3>
  <form action="./submit_form.php" method="post" id="projectForm">
    Nazwa projektu: <input type="text" name="projectName" id="projectName"><br>
    Opis projektu:<br>
    <textarea name="projectDescription" id="projectDescription" cols="40" rows="5"></textarea><br>
    <select name="projectCategory" id="projectCategory">
      <option value="technology">Technologia</option>
      <option value="education">Edukacja</option>
      <option value="entertainment">Rozrywka</option>
    </select><br>
    Adres e-mail: <input type="text" name="email" id="email"><br>
    Powtórz adres e-mail: <input type="text" name="confirmEmail" id="confirmEmail"><br>
    <input type="submit" value="Wyślij">
  </form>
</body>
</html>