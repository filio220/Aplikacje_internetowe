<?php
// echo '<pre>';
// 	print_r($_SERVER);
// echo '</pre>';
//echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//var_dump($_POST);
	$projectName = htmlspecialchars(trim($_POST['projectName']));
	$projectDescription = htmlspecialchars(trim($_POST['projectDescription']));
	$projectCategory = htmlspecialchars(trim($_POST['projectCategory']));
	$email = htmlspecialchars(trim($_POST['email']));
	$confirmEmail = htmlspecialchars(trim($_POST['confirmEmail']));

	$errors = array();

	if (empty($projectName)) {
		$errors[] = 'Nazwa projektu nie może być pusta';
	} else if (strlen($projectName) < 3 || strlen($projectName) > 50) {
		$errors[] = 'Nazwa projektu nie może mieć mniej niż 3 znaki lub więcej niż 50 znaków';
	}

	if (empty($projectDescription)) {
		$errors[] = 'Opis projektu nie może być pusta';
	} else if (strlen($projectDescription) < 10 || strlen($projectDescription) > 1000) {
		$errors[] = 'Opis projektu nie może mieć mniej niż 10 znaków lub więcej niż 1000 znaków';
	}

	if (!in_array($projectCategory, ['technology', 'education', 'entertainment'])) {
		$errors[] = 'Wybierz poprawną kategorię projektu';
	}

	if (empty($email)) {
		$errors[] = 'Adres e-mail nie może być pusty';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Adres e-mail jest niepoprawny';
	}

	if (empty($confirmEmail)) {
		$errors[] = 'Potwierdzenie adresu e-mail nie może być puste';
	} else if (!filter_var($confirmEmail, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Format potwierdzenia adresu e-mail jest niepoprawny';
	}

	if ($email != $confirmEmail) {
		$errors[] = 'Adresy e-mail nie są identyczne';
	}

	//print_r($errors);

	//$errors = implode('<br>', $errors);
	//$errors = implode(', ', $errors);
	//echo $errors;

	$dataToPass = array(
		'errors' => implode(', ', $errors),
		'projectName' => $projectName,
		'projectDescription' => $projectDescription,
		'projectCategory' => $projectCategory,
		'email' => $email,
		'confirmEmail' => $confirmEmail
	);

	//print_r($dataToPass);

	if (!empty($errors)) {
		$queryString = http_build_query($dataToPass);
		header("location:index.php?$queryString");
	} else {
		echo <<< DATA
				Nazwa projektu: $projectName<br>
				Opis projektu: $projectDescription<br>
				Kategoria projektu: $projectCategory<br>
				Adres e-mail: $email<br>
DATA;
	}

}
?>