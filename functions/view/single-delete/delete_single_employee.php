<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if (isset($_GET["confirm"])) {
        $stmt = $mysql->prepare("DELETE FROM employees WHERE EmployeeID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: /functions/admin.php");
        exit();
    } else {
        $stmt = $mysql->prepare("SELECT * FROM employees WHERE EmployeeID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("Location: /functions/admin.php");
            exit();
        }
    }
} else {
    header("Location: /functions/admin.php");
    exit();
}
?>

<title>Usuń pracownika</title>
</head>
<body>
<div class="container py-5 mx-auto">
    <p>Czy na pewno chcesz usunąć pracownika <?php echo $row["First_name"] . " " . $row["Last_name"]; ?>?</p>
    <form method="GET" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="confirm" value="1">
        <button type="submit" class="btn btn-danger">Tak</button>
        <a href="/functions/admin.php" class="btn btn-secondary">Anuluj</a>
    </form>
</div>

<?php include("../../../footer.php"); ?>
