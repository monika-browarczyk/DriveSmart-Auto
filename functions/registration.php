<?php
require_once("config.php");
if(isset($_POST['register'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashPassword = password_hash($password,PASSWORD_BCRYPT);

    $db = new PDO('mysql:host=localhost;dbname=wprg-project', 'root', '');
    $sth = $db->prepare('INSERT INTO Users (Login,Password,Roles_RolesID, Employees_EmployeeID) VALUE (:login, :password, :role, :employeeID)');
    $sth->bindValue(':login', $login, PDO::PARAM_STR);
    $sth->bindValue(':password', $hashPassword, PDO::PARAM_STR);
    $sth->bindValue(':role', $_POST['role'], PDO::PARAM_STR);
    $sth->bindValue(':employeeID', $_POST['employeeID'], PDO::PARAM_STR);
    $sth->execute();
    echo $sth->errorInfo()[2];
    die('Uzytkownik ' . $login . ' zarejestrowany pomyslnie' . '<br><a href="login.php">Zaloguj</a>');
}
?>
<h1>Formularz rejestracyjny</h1>
<form method="post">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Hasło">
    <select name="role">
        <option value="1">Admin</option>
        <option value="2">Modyfikator</option>
        <option value="3">Użytkownik</option>
        <input type="text" name="employeeID" placeholder="ID pracownika">
        <button type="submit" name="register">Zarejestruj</button>
</form>