<?php
global $mysql;
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $model = $_POST["model"];
    $production_year = $_POST["production_year"];
    $mileage = $_POST["mileage"];
    $engine_capacity = $_POST["engine_capacity"];
    $fuel_type = $_POST["fuel_type"];
    $price = $_POST["price"];
    $manufacturer = $_POST["manufacturer"];
    $category = $_POST["category"];

    $stmt = $mysql->prepare("UPDATE cars SET Model=?, Production_year=?, Mileage=?, Engine_capacity=?, Fuel_type=?, Price=?, Manufacturers_ManufacturerID=?, CategoryID=? WHERE CarID=?");
    $stmt->bind_param("siidisiii", $model, $production_year, $mileage, $engine_capacity, $fuel_type, $price, $manufacturer, $category, $id);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $mysql->prepare("SELECT cars.CarID, cars.Model, cars.Production_year, cars.Mileage, cars.Engine_capacity, cars.Fuel_type, cars.Price, manufacturers.ManufacturerID, categories.CategoryID 
                            FROM cars
                            LEFT JOIN manufacturers ON cars.Manufacturers_ManufacturerID = manufacturers.ManufacturerID
                            LEFT JOIN categories ON cars.CategoryID = categories.CategoryID
                            WHERE cars.CarID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $model = $row["Model"];
    $production_year = $row["Production_year"];
    $mileage = $row["Mileage"];
    $engine_capacity = $row["Engine_capacity"];
    $fuel_type = $row["Fuel_type"];
    $price = $row["Price"];
    $manufacturer = $row["ManufacturerID"];
    $category = $row["CategoryID"];
}
?>

<html lang="pl">
<head>
    <title>Edytuj samochód</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Edytuj samochód</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" class="form-control" id="model" name="model" value="<?php echo $model; ?>">
        </div>
        <div class="form-group">
            <label for="production_year">Rok produkcji:</label>
            <input type="number" class="form-control" id="production_year" name="production_year" value="<?php echo $production_year; ?>">
        </div>
        <div class="form-group">
            <label for="mileage">Przebieg:</label>
            <input type="number" class="form-control" id="mileage" name="mileage" value="<?php echo $mileage; ?>">
        </div>
        <div class="form-group">
            <label for="engine_capacity">Pojemność silnika:</label>
            <input type="number" class="form-control" id="engine_capacity" name="engine_capacity" value="<?php echo $engine_capacity; ?>">
        </div>
        <div class="form-group">
            <label for="fuel_type">Rodzaj paliwa:</label>
            <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="<?php echo $fuel_type; ?>">
        </div>
        <div class="form-group">
            <label for="price">Cena (zł):</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
        </div>
        <div class="form-group">
            <div>
                <label for="manufacturer" class="my-2">Producent:</label>
                <select class="form-control" name="manufacturer">
                    <option value="<?php echo $manufacturer ?>"><?php
                        $stmt = $mysql->prepare("SELECT Manufacturer_name FROM manufacturers WHERE ManufacturerID = ?");
                        $stmt->bind_param("i", $manufacturer);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        echo $row["Manufacturer_name"];
                        ?></option>
                    <?php
                    $stmt = $mysql->prepare("SELECT * FROM manufacturers WHERE ManufacturerID != ? ORDER BY Manufacturer_name ASC");
                    $stmt->bind_param("i", $manufacturer);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["ManufacturerID"] . "'>" . $row["Manufacturer_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="category" class="my-2">Kategoria:</label>
                <select class="form-control" name="category">
                    <option value="<?php echo $category ?>"><?php
                        $stmt = $mysql->prepare("SELECT Name FROM categories WHERE CategoryID = ?");
                        $stmt->bind_param("i", $category);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        echo $row["Name"];
                        ?></option>
                    <?php
                    $stmt = $mysql->prepare("SELECT * FROM categories WHERE CategoryID != ? ORDER BY Name ASC");
                    $stmt->bind_param("i", $category);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["CategoryID"] . "'>" . $row["Name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Zapisz zmiany">
    </form>
</div>
</body>
</html>
