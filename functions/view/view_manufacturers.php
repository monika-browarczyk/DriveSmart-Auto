<?php
if(!isset($_SESSION)){
    session_start();
}
session_regenerate_id();
$mysql = new mysqli("localhost", "root", '', "wprg-project");

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $stmt = $mysql->prepare("SELECT manufacturers.ManufacturerID, manufacturers.Manufacturer_name, COUNT(cars.CarID) AS CarCount
                             FROM manufacturers
                             LEFT JOIN cars ON manufacturers.ManufacturerID = cars.Manufacturers_ManufacturerID
                             WHERE manufacturers.Manufacturer_name LIKE ?
                             GROUP BY manufacturers.Manufacturer_name
                             ORDER BY CarCount;");
    $searchParam = "$search%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $mysql->query("SELECT manufacturers.ManufacturerID, manufacturers.Manufacturer_name, COUNT(cars.CarID) AS CarCount
                             FROM manufacturers
                             LEFT JOIN cars ON manufacturers.ManufacturerID = cars.Manufacturers_ManufacturerID
                             GROUP BY manufacturers.Manufacturer_name
                             ORDER BY manufacturers.Manufacturer_name;");
}
?>

<html lang="pl">
<head>
    <title>Lista producentów</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Producenci</h1>
    <div class="d-flex justify-content-between mb-3">
        <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == '1'): ?>
            <a href="/functions/view/single-add/add_single_manufacturer.php"
               class="btn btn-success btn-sm d-flex align-items-center justify-content-center mb-3 w-25">Dodaj</a>
        <?php endif; ?>
        <form class="form-inline w-75 ml-5">
            <input type="text" class="form-control rounded w-75" name="search" placeholder="Search">
            <input type="submit" class="btn btn-outline-dark w-25" value="Search">
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Nazwa producenta</th>
            <th>Ilość samochodów</th>
            <th>Zobacz</th>
            <th>Edytuj</th>
            <th>Usuń</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["Manufacturer_name"]; ?></td>
                <td><?php echo $row["CarCount"]; ?></td>
                <td><a href="/functions/view/single-view/view_single_manufacturer.php?id=<?php echo $row["ManufacturerID"]; ?>"
                       class="btn btn-info btn-sm">Zobacz</a></td>
                <td><a href="/functions/view/single-edit/edit_single_manufacturer.php?id=<?php echo $row["ManufacturerID"]; ?>"
                       class="btn btn-warning btn-sm">Edytuj</a></td>
                <td><a href="/functions/view/single-delete/delete_single_manufacturer.php?id=<?php echo $row["ManufacturerID"]; ?>"
                       class="btn btn-danger btn-sm">Usuń</a></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
