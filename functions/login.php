<?php
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
                header('Location: /functions/admin.php');
            } else if ($user['Roles_RolesID'] == 3) {
                header('Location: /functions/admin.php');
            }
        } else {
            echo "<h3>Nieprawidłowe hasło</h3>";
        }
    } else {
        echo "<h3>Nie znaleziono użytkownika</h3>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Login</h1>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <input type="text" name="login" class="form-control" placeholder="Login">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Hasło">
        </div>
        <button type="submit" name="zaloguj" class="btn btn-primary">Zaloguj</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
