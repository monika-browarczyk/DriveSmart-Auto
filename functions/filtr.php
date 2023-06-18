<?php
global $db;
include("./config.php");
include ("../header.php");

$sqlManufacturers = "SELECT * FROM Manufacturers";
$stmtManufacturers = $db->query($sqlManufacturers);
$manufacturers = $stmtManufacturers->fetchAll(PDO::FETCH_ASSOC);

$sqlCategories = "SELECT * FROM Categories";
$stmtCategories = $db->query($sqlCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

$sqlFuelTypes = "SELECT DISTINCT Fuel_type FROM Cars";
$stmtFuelTypes = $db->query($sqlFuelTypes);
$fuelTypes = $stmtFuelTypes->fetchAll(PDO::FETCH_ASSOC);

$sqlModels = "SELECT DISTINCT Model FROM Cars";
$stmtModels = $db->query($sqlModels);
$models = $stmtModels->fetchAll(PDO::FETCH_ASSOC);


$model = '';
$productionYearFrom = '';
$productionYearTo = '';
$mileageFrom = '';
$mileageTo = '';
$engineCapacityFrom = '';
$engineCapacityTo = '';
$fuelType = '';
$priceFrom = '';
$priceTo = '';
$manufacturerID = '';
$categoryID = '';

if(!empty($_POST)){
    $model = $_POST['Model'];
    $productionYearFrom = $_POST['Production_year_from'];
    $productionYearTo = $_POST['Production_year_to'];
    $mileageFrom = $_POST['Mileage_from'];
    $mileageTo = $_POST['Mileage_to'];
    $engineCapacityFrom = $_POST['Engine_capacity_from'];
    $engineCapacityTo = $_POST['Engine_capacity_to'];
    $fuelType = $_POST['Fuel_type'];
    $priceFrom = $_POST['Price_from'];
    $priceTo = $_POST['Price_to'];
    $manufacturerID = $_POST['Manufacture_ManufacturerID'];
    $categoryID = $_POST['CategoryID'];
}


$sql = "SELECT Cars.*, Manufacturers.Manufacturer_name, Categories.Name
        FROM Cars 
        JOIN Manufacturers ON Cars.Manufacturers_ManufacturerID = Manufacturers.ManufacturerID 
        JOIN Categories ON Cars.CategoryID = Categories.CategoryID
        WHERE 1=1";

$params = array();

if (!empty($model)) {
    $sql .= " AND Cars.Model = :Model";
    $params[':Model'] = $model;
}

if (!empty($productionYearFrom)) {
    $sql .= " AND Cars.Production_year >= :Production_year_from";
    $params[':Production_year_from'] = $productionYearFrom;
}

if (!empty($productionYearTo)) {
    $sql .= " AND Cars.Production_year <= :Production_year_to";
    $params[':Production_year_to'] = $productionYearTo;
}

if (!empty($mileageFrom)) {
    $sql .= " AND Cars.Mileage >= :Mileage_from";
    $params[':Mileage_from'] = $mileageFrom;
}

if (!empty($mileageTo)) {
    $sql .= " AND Cars.Mileage <= :Mileage_to";
    $params[':Mileage_to'] = $mileageTo;
}

if (!empty($engineCapacityFrom)) {
    $sql .= " AND Cars.Engine_capacity >= :Engine_capacity_from";
    $params[':Engine_capacity_from'] = $engineCapacityFrom;
}

if (!empty($engineCapacityTo)) {
    $sql .= " AND Cars.Engine_capacity <= :Engine_capacity_to";
    $params[':Engine_capacity_to'] = $engineCapacityTo;
}

if (!empty($fuelType)) {
    $sql .= " AND Cars.Fuel_type = :Fuel_type";
    $params[':Fuel_type'] = $fuelType;
}

if (!empty($priceFrom)) {
    $sql .= " AND Cars.Price >= :Price_from";
    $params[':Price_from'] = $priceFrom;
}

if (!empty($priceTo)) {
    $sql .= " AND Cars.Price <= :Price_to";
    $params[':Price_to'] = $priceTo;
}

if (!empty($manufacturerID)) {
    $sql .= " AND Manufacturers.ManufacturerID = :ManufacturerID";
    $params[':ManufacturerID'] = $manufacturerID;
}

if (!empty($categoryID)) {
    $sql .= " AND Categories.CategoryID = :CategoryID";
    $params[':CategoryID'] = $categoryID;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtracja</title>
</head>
<body>
<div class="container">
    <h1>Znajdź samochód dla siebie</h1>

    <form method="post">
        <div class="form-group">
            <label for="model">Model:</label>
            <select class="form-control" name="Model" id="model">
                <option value="">Wybierz model</option>
                <?php foreach ($models as $car) { ?>
                    <option value="<?php echo $car['Model']; ?>" <?php if ($model == $car['Model']) echo 'selected'; ?>>
                        <?php echo $car['Model']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="productionYearFrom">Rok produkcji (Od):</label>
                <input type="text" class="form-control" name="Production_year_from" id="productionYearFrom" value="<?php echo $productionYearFrom; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="productionYearTo">Rok produkcji (Do):</label>
                <input type="text" class="form-control" name="Production_year_to" id="productionYearTo" value="<?php echo $productionYearTo; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mileageFrom">Przebieg (Od):</label>
                <input type="text" class="form-control" name="Mileage_from" id="mileageFrom" value="<?php echo $mileageFrom; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="mileageTo">Przebieg (Do):</label>
                <input type="text" class="form-control" name="Mileage_to" id="mileageTo" value="<?php echo $mileageTo; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="engineCapacityFrom">Pojemność silnika (Od):</label>
                <input type="text" class="form-control" name="Engine_capacity_from" id="engineCapacityFrom" value="<?php echo $engineCapacityFrom; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="engineCapacityTo">Pojemność silnika (Do):</label>
                <input type="text" class="form-control" name="Engine_capacity_to" id="engineCapacityTo" value="<?php echo $engineCapacityTo; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="fuelType">Rodzaj paliwa:</label>
            <select class="form-control" name="Fuel_type" id="fuelType">
                <option value="">Wybierz rodzaj paliwa</option>
                <?php foreach ($fuelTypes as $car) { ?>
                    <option value="<?php echo $car['Fuel_type']; ?>" <?php if ($fuelType == $car['Fuel_type']) echo 'selected'; ?>>
                        <?php echo $car['Fuel_type']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="priceFrom">Cena (Od):</label>
                <input type="text" class="form-control" name="Price_from" id="priceFrom" value="<?php echo $priceFrom; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="priceTo">Cena (Do):</label>
                <input type="text" class="form-control" name="Price_to" id="priceTo" value="<?php echo $priceTo; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="manufacturer">Produceni:</label>
            <select class="form-control" name="Manufacture_ManufacturerID" id="manufacturer">
                <option value="">Wybierz producenta</option>
                <?php foreach ($manufacturers as $manufacturer) { ?>
                    <option value="<?php echo $manufacturer['ManufacturerID']; ?>" <?php if ($manufacturerID == $manufacturer['ManufacturerID']) echo 'selected'; ?>>
                        <?php echo $manufacturer['Manufacturer_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="category">Kategorie:</label>
            <select class="form-control" name="CategoryID" id="category">
                <option value="">Wybierz kategorie</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['CategoryID']; ?>" <?php if ($categoryID == $category['CategoryID']) echo 'selected'; ?>>
                        <?php echo $category['Name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filtruj</button>
    </form>

    <hr>

    <?php if (!empty($cars)) { ?>
        <div class="row">
            <?php foreach ($cars as $car) { ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <a href="/functions/view/single-view/view_single_car.php?id=<?php echo $car['CarID']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $car['Model']; ?></h5>
                        </a>
                            <p class="card-text">Rok produkcji: <?php echo $car['Production_year']; ?></p>
                            <p class="card-text">Przebieg: <?php echo $car['Mileage']; ?></p>
                            <p class="card-text">Producent: <?php echo $car['Manufacturer_name']; ?></p>
                            <p class="card-text">Kategoria: <?php echo $car['Name']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    <?php } else { ?>
        <p>Żadne samochody nie spełniają kryteriów</p>
    <?php } ?>
</div>
</body>
<?php include_once '../footer.php'; ?>
