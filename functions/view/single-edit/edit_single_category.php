<?php
global $mysql;
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nazwa = $_POST["nazwa"];
    $opis = $_POST["opis"];

    $stmt = $mysql->prepare("UPDATE categories SET Name=?, Description=? WHERE CategoryID=?");
    $stmt->bind_param("ssi", $nazwa, $opis, $id);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $mysql->prepare("SELECT categories.Name, categories.CategoryID, categories.Description FROM categories
                                        WHERE categories.CategoryID = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $nazwa = $row["Name"];
    $opis = $row["Description"];
}
?>

<html lang="pl">
<head>
    <title>Edytuj kategorię</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Edytuj kategorię</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="nazwa">Nazwa:</label>
            <input type="text" class="form-control" id="nazwa" name="nazwa" value="<?php echo $nazwa; ?>">
        </div>
        <div class="form-group">
            <label for="nazwisko">Opis:</label>
            <input type="text" class="form-control" id="opis" name="opis" value="<?php echo $opis; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Zapisz zmiany">
    </form>
</div>
</body>
</html>
