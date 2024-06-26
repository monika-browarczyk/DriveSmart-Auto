<?php
global $mysql;
include("../config.php");
include ("../../header.php");

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $stmt = $mysql->prepare("SELECT * FROM Addresses 
                             WHERE CONCAT(City, Street, Street_number, Post_code) LIKE ?");
    $searchParam = "%$search%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $mysql->query("SELECT * FROM Addresses");
}
?>

    <title>Lista adresów</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Adresy</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <?php
        if ($_SESSION['logged'] == '1') { ?>
        <a href="single-add/add_single_address.php" class="btn btn-success btn-sm d-flex align-items-center justify-content-center mb-3 w-25">Dodaj</a>
        <?php } ?>
        <form class="form-inline w-75 ml-5">
            <input type="text" class="form-control rounded w-75" name="search" placeholder="Search">
            <input type="submit" class="btn btn-outline-dark w-25" value="Search">
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Adres</th>
            <th>Zobacz</th>
            <th>Edytuj</th>
            <th>Usuń</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php echo $row["City"] . ", " . $row["Street"] . " " . $row["Street_number"] . ", " . $row["Post_code"]; ?>
                </td>
                <td>
                    <a href="/functions/view/single-view/view_single_address.php?id=<?php echo $row["AddressID"]; ?>" class="btn btn-info btn-sm">Zobacz</a>
                </td>
                <td>
                    <a href="/functions/view/single-edit/edit_single_address.php?id=<?php echo $row["AddressID"]; ?>" class="btn btn-warning btn-sm">Edytuj</a>
                </td>
                <td>
                    <a href="/functions/view/single-delete/delete_single_address.php?id=<?php echo $row["AddressID"]; ?>" class="btn btn-danger btn-sm">Usuń</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../../footer.php"); ?>
