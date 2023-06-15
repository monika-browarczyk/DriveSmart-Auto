<?php
$mysql = new mysqli("localhost", "root", "", "wprg-project");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if (isset($_GET["confirm"])) {
        $stmt = $mysql->prepare("DELETE FROM users WHERE UserID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: /functions/view/view_users.php");
        exit();
    } else {
        $stmt = $mysql->prepare("SELECT * FROM users WHERE UserID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("Location: /functions/view/view_users.php");
            exit();
        }
    }
} else {
    header("Location: /functions/view/view_users.php");
    exit();
}
?>

<html lang="pl">
<head>
    <title>Usuń użytkownika</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5 mx-auto">
    <p>Czy na pewno chcesz usunąć użytkownika <?php echo $row["Login"] . " "; ?>?</p>
    <form method="GET" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="confirm" value="1">
        <button type="submit" class="btn btn-danger">Tak</button>
        <a href="/functions/view/view_users.php" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
</body>
</html>
