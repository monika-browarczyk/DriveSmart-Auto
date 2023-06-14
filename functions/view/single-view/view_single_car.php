<html lang="pl">
<head>
    <title>Informacje o samochodzie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.html" type="button"><- Strona Główna</a>
    <h1>Dane o samochodzie:
        <?php
        $id = $_GET["id"];
        $mysql = new mysqli("localhost", "root", '', "wprg-project");
        $stmt = $mysql->prepare("SELECT cars.CarID, cars.Model, cars.Production_year, cars.Mileage, cars.Engine_capacity, cars.Fuel_type, cars.Price, 
       manufacturers.Manufacturer_name, categories.Name as Category_name FROM `cars` 
                                LEFT JOIN manufacturers ON cars.Manufacturers_ManufacturerID = manufacturers.ManufacturerID
                                LEFT JOIN categories ON cars.CategoryID = categories.CategoryID
                                WHERE cars.CarID = ? ORDER BY cars.CarID;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $row["Manufacturer_name"] . " " . $row["Model"];
        ?>
    </h1>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>ID samochodu:</td>
            <td><?php echo($row["CarID"] ? $row["CarID"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Model samochodu:</td>
            <td><?php echo($row["Model"] ? $row["Model"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Rok produkcji:</td>
            <td><?php echo($row["Production_year"] ? $row["Production_year"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Przebieg:</td>
            <td><?php echo($row["Mileage"] ? $row["Mileage"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Pojemność silnika:</td>
            <td><?php echo($row["Engine_capacity"] ? $row["Engine_capacity"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Rodzaj silnika:</td>
            <td><?php echo($row["Fuel_type"] ? $row["Fuel_type"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Cena: (zł)</td>
            <td><?php echo($row["Price"] ? $row["Price"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Producent:</td>
            <td><?php echo($row["Manufacturer_name"] ? $row["Manufacturer_name"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Kategoria:</td>
            <td><?php echo($row["Category_name"] ? $row["Category_name"] : "brak") ?></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
