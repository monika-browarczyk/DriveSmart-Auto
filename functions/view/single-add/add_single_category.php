<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $stmt = $mysql->prepare("INSERT INTO categories (Name, Description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}
?>

    <title>Dodaj kategorię</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj kategorię</h1>
    <form method="post">
        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj kategorię">
    </form>
</div>

<?php include("../../../footer.php"); ?>

