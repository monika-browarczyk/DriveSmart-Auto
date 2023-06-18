<?php
global $mysql;
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $permission = $_POST["permission"];

    $stmt = $mysql->prepare("INSERT INTO roles (Name, Permission) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $permission);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}
?>

<html lang="pl">
<head>
    <title>Dodaj rolę</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj rolę</h1>
    <form method="post">
        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="permission">Uprawnienie:</label>
            <input type="text" class="form-control" id="permission" name="permission">
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj rolę">
    </form>
</div>
</body>
</html>
