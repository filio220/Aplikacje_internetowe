<?php
    if (!empty($_POST['login']) &&  !empty($_POST['pass']) && !empty($_POST['color'])){
        echo <<<FORMDATA
        <hr>
        Kolor: $_POST[color]
        <hr>
FORMDATA;
    }else{
        //echo "<script>history.back();</script>";
        echo <<<REGISTERFORM
        <h3>Formularz rejestracji</h3>
        <form method="post">
            <input type="text" name="login" id="login" placeholder="login"autofocus><br><br>
            <input type="password" name="pass" id="pass" placeholder="Hasło"><br><br>
            <input type="color" name="color" id="color"><br><br>
            <input type="submit" value="Zatwierdź">
        </form>
REGISTERFORM;
    }
?>