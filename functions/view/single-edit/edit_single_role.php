<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $permission = $_POST["permission"];

    $stmt = $mysql->prepare("UPDATE roles SET Name=?, Permission=? WHERE RolesID=?");
    $stmt->bind_param("ssi", $name, $permission, $id);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}

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

    <title>Edytuj rolę</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Edytuj rolę</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="permission">Uprawnienie:</label>
            <input type="text" class="form-control" id="permission" name="permission" value="<?php echo $permission; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Zapisz zmiany">
    </form>
</div>

<?php include("../../../footer.php"); ?>
