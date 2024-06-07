<?php
  //echo $_SERVER['PHP_SELF'];
  //echo $_SERVER['REQUEST_METHOD'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo '<pre>';
    //   // print_r($_SERVER);
    //   print_r($_POST);
    // echo '</pre>';

    $projectName = htmlspecialchars(trim($_POST['projectName']));
    $projectDescription = htmlspecialchars(trim($_POST['projectDescription']));
    $projectCategory = htmlspecialchars(trim($_POST['projectCategory']));
    $email = htmlspecialchars(trim($_POST['email']));
    $confirmEmail = htmlspecialchars(trim($_POST['confirmEmail']));
    // echo $projectName;

    $errors = array();
    if (empty($projectName)) {
      $errors[] = 'Nazwa projeku nie może być pusta';
    } else if (strlen($projectName) < 5 || strlen($projectName) > 50) {
      $errors[] = 'Nazwa projeku musi mieć przynajmniej 5 znaków i nie więcej niż 50 znaków';
    }

    if (empty($projectDescription)) {
      $errors[] = 'Opis projeku nie może być pusty';
    } else if (strlen($projectDescription) < 10 || strlen($projectDescription) > 1000) {
      $errors[] = 'Opis projeku musi mieć przynajmniej 10 znaków i nie więcej niż 1000 znaków';
    }

    if (!in_array($projectCategory, array('technology', 'education', 'entertainment'))) {
      $errors[] = 'Nieprawidłowa kategoria projeku';
    }

    if (empty($email)) {
      $errors[] = 'E-mail nie może być pusty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Nieprawidłowy adres e-mail';
    }

    if (empty($confirmEmail)) {
      $errors[] = 'Potwierdzenie adresu e-mail nie może być puste';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Nieprawidłowy adres powtórzenia adresu e-mail';
    }

    if ($email != $confirmEmail) {
      $errors[] = 'Adresy e-mail nie są identyczne';
    }

    // print_r($errors);

    // $errors = implode('<br>', $errors);
    // $errors = implode(', ', $errors);
    // echo $errors;

    $dataToPass = array(
      'errors' => implode(', ', $errors),
      'projectName' => $projectName,
      'projectDescription' => $projectDescription,
      'projectCategory' => $projectCategory,
      'email' => $email,
      'confirmEmail' => $confirmEmail
    );


    if (!empty($errors)) {
      $queryString = http_build_query($dataToPass);
      header("Location:./index.php?$queryString");
    } else {
      //dodanie rekordu do bazy danych
      echo <<< DATA
        Nazwa projektu: $projectName<br>
        Opis projektu: $projectDescription<br>
        Kategoria projektu: $projectCategory<br>
        Adres e-mail: $email<br>
DATA;
    }

  }
?>