<?php
// echo '<pre>';
// 	//print_r($_SERVER);
// 	print_r($_POST);
// echo '</pre>';

//var_dump($_POST);
//echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$projectName = htmlspecialchars(trim($_POST['projectName']));
	$projectDescription = htmlspecialchars(trim($_POST['projectDescription']));
	$projectCategory = htmlspecialchars(trim($_POST['projectCategory']));
	$email = htmlspecialchars(trim($_POST['email']));
	$confirmEmail = htmlspecialchars(trim($_POST['confirmEmail']));

	//echo $projectName."<br>".$projectDescription."<br>".$email;

	$errors = array();

	if (empty($projectName)) {
		$errors[] = 'Nazwa projektu jest wymagana';
	} else if (strlen($projectName) < 3 || strlen($projectName) > 50) {
		$errors[] = 'Nazwa projektu musi zawierać od 3 do 50 znaków';
	}

	if (empty($projectDescription)) {
		$errors[] = 'Opis projektu jest wymagany';
	} else if (strlen($projectDescription) < 10 || strlen($projectDescription) > 1000) {
		$errors[] = 'Opis projektu musi zawierać od 10 do 1000 znaków';
	}

	if (!in_array($projectCategory, ['technology', 'education', 'entertainment'])) {
		$errors[] = 'Wybierz poprawną kategorię projektu';
	}

	if (empty($email)) {
		$errors[] = 'Adres e-mail jest wymagany';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Nieprawidłowy format adresu e-mail';
	}

	if (empty($confirmEmail)) {
		$errors[] = 'Potwierdzenie adresu e-mail jest wymagane';
	} else if (!filter_var($confirmEmail, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Nieprawidłowy format potwierdzenia adresu e-mail';
	}

	if ($email != $confirmEmail) {
		$errors[] = 'Adresy e-mail nie są identyczne';
	}

	//echo $errors;
	// $errors = implode("<br>", $errors);
	// $errors = implode(", ", $errors);
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
		// echo '<pre>';
		// 	print_r($errors);
		// echo '</pre>';e
		$queryString = http_build_query($dataToPass);
		header("Location: index.php?$queryString");
		exit();
	}else{
		echo <<< DATA
				Nazwa projektu: $projectName<br>
				Opis projektu: $projectDescription<br>
				Kategoria projektu: $projectCategory<br>
				Adres e-mail: $email<br>
DATA;
	}
}
?>