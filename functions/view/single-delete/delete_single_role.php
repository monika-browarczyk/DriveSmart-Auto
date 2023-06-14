<?php
$mysql = new mysqli("localhost", "root", "", "wprg-project");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if (isset($_GET["confirm"])) {
        $stmt = $mysql->prepare("DELETE FROM roles WHERE RolesID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: /functions/view/view_roles.php");
        exit();
    } else {
        $stmt = $mysql->prepare("SELECT * FROM roles WHERE RolesID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("Location: /functions/view/view_roles.php");
            exit();
        }
    }
} else {
    header("Location: /functions/view/view_roles.php");
    exit();
}
?>

<html lang="pl">
<head>
    <title>Usuń osobę</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5 mx-auto">
    <p>Czy na pewno chcesz usunąć role <?php echo $row["Name"] . " "; ?>?</p>
    <form method="GET" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="confirm" value="1">
        <button type="submit" class="btn btn-danger">Tak</button>
        <a href="/functions/view/view_roles.php" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
</body>
</html>
