<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

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

    <title>Informacje o roli</title>
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
<?php include("../../../footer.php"); ?>
