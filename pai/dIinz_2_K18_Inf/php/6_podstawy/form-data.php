<?php
	//echo "Imię: ".$_GET['firstName'];
	//var_dump($_GET);
	echo '<pre>';
		print_r($_GET);
	echo '</pre>';

	//if (isset($_GET['firstName'])) {
	if (!empty($_GET['firstName'])) {
		echo "Imię: ".$_GET['firstName'];
	}else{
		echo "brak imienia";
	}

?>