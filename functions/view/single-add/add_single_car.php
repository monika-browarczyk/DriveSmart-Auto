<?php
$mysql = new mysqli("localhost", "root", "", "wprg-project");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST["model"];
    $productionYear = $_POST["production_year"];
    $mileage = $_POST["mileage"];
    $engineCapacity = $_POST["engine_capacity"];
    $fuelType = $_POST["fuel_type"];
    $price = $_POST["price"];
    $manufacturerID = $_POST["manufacturer_id"];
    $categoryID = $_POST["category_id"];

    $stmt = $mysql->prepare("INSERT INTO cars (Model, Production_year, Mileage, Engine_capacity, Fuel_type, Price, Manufacturers_ManufacturerID, CategoryID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiisiii", $model, $productionYear, $mileage, $engineCapacity, $fuelType, $price, $manufacturerID, $categoryID);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}

$stmt = $mysql->prepare("SELECT ManufacturerID, Manufacturer_name FROM manufacturers");
$stmt->execute();
$manufacturerResult = $stmt->get_result();

$stmt = $mysql->prepare("SELECT CategoryID, Name FROM categories");
$stmt->execute();
$categoryResult = $stmt->get_result();
?>

<html lang="pl">
<head>
    <title>Dodaj samochód</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj samochód</h1>
    <form method="post">
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" class="form-control" id="model" name="model">
        </div>
        <div class="form-group">
            <label for="production_year">Rok produkcji:</label>
            <input type="number" class="form-control" id="production_year" name="production_year">
        </div>
        <div class="form-group">
            <label for="mileage">Przebieg:</label>
            <input type="number" class="form-control" id="mileage" name="mileage">
        </div>
        <div class="form-group">
            <label for="engine_capacity">Pojemność silnika:</label>
            <input type="number" class="form-control" id="engine_capacity" name="engine_capacity">
        </div>
        <div class="form-group">
            <label for="fuel_type">Rodzaj paliwa:</label>
            <input type="text" class="form-control" id="fuel_type" name="fuel_type">
        </div>
        <div class="form-group">
            <label for="price">Cena (zł):</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="manufacturer_id">Producent:</label>
            <select class="form-control" id="manufacturer_id" name="manufacturer_id">
                <?php
                while ($manufacturer = $manufacturerResult->fetch_assoc()) {
                    echo "<option value='" . $manufacturer["ManufacturerID"] . "'>" . $manufacturer["Manufacturer_name"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Kategoria:</label>
            <select class="form-control" id="category_id" name="category_id">
                <?php
                while ($category = $categoryResult->fetch_assoc()) {
                    echo "<option value='" . $category["CategoryID"] . "'>" . $category["Name"] . "</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj samochód">
    </form>
</div>
</body>
</html>
