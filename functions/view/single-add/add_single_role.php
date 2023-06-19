<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

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

    <title>Dodaj rolę</title>
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

<?php include("../../../footer.php"); ?>

