<?php
global $mysql;
include("../../config.php");

?>

<html lang="pl">
<head>
    <title>Pojedyncza osoba</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dane osoby:
        <?php
        $id = $_GET["id"];
        $stmt = $mysql->prepare("SELECT clients.ClientID, clients.First_name, clients.Last_name, clients.Telephone_number, clients.Email, Addresses.AddressID, Addresses.City, 
       Addresses.Street, Addresses.Street_number, Addresses.Post_code, offers.CarID FROM Clients 
                        LEFT JOIN addresses ON clients.Addresses_AddressID = Addresses.AddressID
                        JOIN offers ON clients.ClientID = offers.Clients_ClientID
                        WHERE clients.ClientID = ?");
        var_dump($stmt);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $row["First_name"] . " " . $row["Last_name"];
        ?>
    </h1>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>Imię:</td>
            <td><?php echo ($row["First_name"] ? $row["First_name"] : "brak")?></td>
        </tr>
        <tr>
            <td>Nazwisko:</td>
            <td><?php echo ($row["Last_name"] ? $row["Last_name"] : "brak")?></td>
        </tr>
        <tr>
            <td>Pesel:</td>
            <td><?php echo ($row["Telephone_number"] ? $row["Telephone_number"] : "brak")?></td>
        </tr>
        <tr>
            <td>Data urodzenia:</td>
            <td><?php echo ($row["Email"] ? $row["Email"] : "brak")?></td>
        </tr>
        <tr>
            <td>Adres:</td>
            <td><?php
                $address = '';
                if ($row["City"]) {
                    $address .= $row["City"].', ';
                }
                if ($row["Street"]) {
                    $address .= $row["Street"].', ';
                }
                if ($row["Street_number"]) {
                    $address .= $row["Street_number"].', ';
                }
                if ($row["Post_code"]) {
                    $address .= $row["Post_code"].', ';
                }
                echo ($address !== '') ? rtrim($address, ', ') : 'brak';
                ?>
            </td>
        </tr>
        <tr>
            <td>ID samochódów:</td>
            <td>
                <?php
                $carID = isset($row["CarID"]) ? $row["CarID"] : "brak";
                if ($carID !== "brak") {
                    echo '<a href="view_single_car.php?id=' . $carID . '">' . $carID . '</a>';
                } else {
                    echo $carID;
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    <a href="/functions/view/view_clients.php" class="btn btn-secondary">Powrót</a>
</div>
</body>
</html>
