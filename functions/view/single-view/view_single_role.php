<?php
$mysql = new mysqli("localhost", "root", "", "wprg-project");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $mysql->prepare("SELECT * FROM roles WHERE RolesID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $name = $row["Name"];
    $permission = $row["Permission"];
}
?>

<html lang="pl">
<head>
    <title>Informacje o roli</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Informacje o roli</h1>
    <table class="table">
        <tbody>
        <tr>
            <td>ID roli:</td>
            <td><?php echo $id; ?></td>
        </tr>
        <tr>
            <td>Nazwa:</td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td>Uprawnienie:</td>
            <td><?php echo $permission; ?></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
