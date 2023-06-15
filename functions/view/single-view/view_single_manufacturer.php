<?php
$mysql = new mysqli("localhost", "root", '', "wprg-project");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $mysql->prepare("SELECT *, COUNT(cars.CarID) AS CarCount
                             FROM manufacturers
                             LEFT JOIN cars ON manufacturers.ManufacturerID = cars.Manufacturers_ManufacturerID
                             WHERE manufacturers.ManufacturerID = ?
                             GROUP BY manufacturers.ManufacturerID");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $manufacturer = $result->fetch_assoc();

    if (!$manufacturer) {
        header("Location: /functions/view/view_manufacturers.php");
        exit();
    }
} else {
    header("Location: /functions/view/view_manufacturers.php");
    exit();
}
?>

<html lang="pl">
<head>
    <title>Szczegóły producenta</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Szczegóły producenta</h1>
    <table class="table">
        <tbody>
        <tr>
            <th>Nazwa producenta:</th>
            <td><?php echo $manufacturer["Manufacturer_name"] ?? "Brak danych"; ?></td>
        </tr>
        <tr>
            <th>Ilość samochodów:</th>
            <td><?php echo $manufacturer["CarCount"] ?? "Brak danych"; ?></td>
        </tr>
        <tr>
            <th>Data rejestracji:</th>
            <td><?php echo $manufacturer["Registration_date"] ?? "Brak danych"; ?></td>
        </tr>
        <tr>
            <th>Opis:</th>
            <td><?php echo $manufacturer["Description"] ?? "Brak danych"; ?></td>
        </tr>
        <tr>
            <th>Kraj pochodzenia:</th>
            <td><?php echo $manufacturer["Origin_country"] ?? "Brak danych"; ?></td>
        </tr>
        </tbody>
    </table>
    <a href="/functions/view/view_manufacturers.php" class="btn btn-secondary">Powrót</a>
</div>
</body>
</html>
