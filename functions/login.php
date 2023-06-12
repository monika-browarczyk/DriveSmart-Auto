<?php
//require_once("config.php");
session_start();
if(isset($_SESSION['logged'])) {
    header('Location: admin.php');
}
if (isset($_POST['zaloguj'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $db = new PDO('mysql:host=localhost;dbname=wprg-project', 'root', '');
    $sth = $db->prepare('SELECT * FROM Users WHERE Login = :login limit 1');
    $sth->bindValue(':login', $login, PDO::PARAM_STR);
    $sth->execute();
    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['Password'])) {
            $_SESSION['logged'] = $user['Roles_RolesID'];
            if ($user['Roles_RolesID'] == 1) {
                header('Location: /functions/admin.php');
            } else if ($user['Roles_RolesID'] == 2) {
                header('Location: /functions/mod.php');
            } else if ($user['Roles_RolesID'] == 3) {
                header('Location: /functions/admin.php');
            }
        } else {
            echo "<h3>Nieprawidlowe haslo</h3>";
        }
    } else {
        echo "<h3>Nie znaleziono uzytkownika</h3>";
    }
}
?>
<h1>Login</h1>
<form method="post">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Hasło">
    <button type="submit" name="zaloguj">Zaloguj</button>
</form>