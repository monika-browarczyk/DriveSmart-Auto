<?php
global $mysql;
include("../../config.php");
include("../../../header.php");
?>

    <title>Informacje o samochodzie</title>
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dane o samochodzie:
        <?php
        $id = $_GET["id"];
        $stmt = $mysql->prepare("SELECT cars.CarID, cars.Model, cars.Production_year, cars.Mileage, cars.Engine_capacity, cars.Fuel_type, cars.Price, 
       manufacturers.Manufacturer_name, categories.Name as Category_name FROM `cars` 
                                LEFT JOIN manufacturers ON cars.Manufacturers_ManufacturerID = manufacturers.ManufacturerID
                                LEFT JOIN categories ON cars.CategoryID = categories.CategoryID
                                WHERE cars.CarID = ? ORDER BY cars.CarID;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $select_offer_manager = $mysql->prepare("SELECT employees.First_name, employees.Last_name FROM `employees` 
                                JOIN offers ON employees.EmployeeID = offers.Employees_EmployeeID
                                WHERE offers.CarID = ? ORDER BY offers.CarID;");
        $select_offer_manager->bind_param("i", $id);
        $select_offer_manager->execute();
        $row2 = $select_offer_manager->get_result()->fetch_assoc();

        $select_client = $mysql->prepare("SELECT clients.First_name, clients.Last_name FROM `clients` 
                                RIGHT JOIN offers ON clients.ClientID = offers.Clients_ClientID
                                WHERE offers.CarID = ? ORDER BY offers.CarID;");
        $select_client->bind_param("i", $id);
        $select_client->execute();
        $row3 = $select_client->get_result()->fetch_assoc();

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
        <tr>
            <td>Opiekun oferty:</td>
            <td><?php echo($row2["First_name"] ? "<a href='/functions/view/single-view/view_single_employee.php?id=" . $id . "'>" . $row2["First_name"] . " " . $row2["Last_name"] . "</a>" : "brak") ?></td>
        </tr>
        <tr>
            <td>Klient:</td>
            <td><?php echo($row3["First_name"] ? "<a href='/functions/view/single-view/view_single_client.php?id=" . $id . "'>" . $row3["First_name"] . " " . $row3["Last_name"] . "</a>" : "brak") ?></td>
        </tr>
        </tbody>
    </table>
</div>

<?php include("../../../footer.php"); ?>
