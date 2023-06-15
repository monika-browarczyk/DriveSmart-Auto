<html lang="pl">
<head>
    <title>Adres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.html" type="button"><- Strona Główna</a>
    <h1>Dane adresu:</h1>

    <?php
    $addressID = $_GET["id"];
    $mysql = new mysqli("localhost", "root", "", "wprg-project");
    $stmt = $mysql->prepare("SELECT * FROM Addresses WHERE AddressID = ?");
    $stmt->bind_param("i", $addressID);
    $stmt->execute();
    $result = $stmt->get_result();
    $address = $result->fetch_assoc();
    ?>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>Miasto:</td>
            <td><?php echo($address["City"] ? $address["City"] : "brak"); ?></td>
        </tr>
        <tr>
            <td>Ulica:</td>
            <td><?php echo($address["Street"] ? $address["Street"] : "brak"); ?></td>
        </tr>
        <tr>
            <td>Numer ulicy:</td>
            <td><?php echo($address["Street_number"] ? $address["Street_number"] : "brak"); ?></td>
        </tr>
        <tr>
            <td>Kod pocztowy:</td>
            <td><?php echo($address["Post_code"] ? $address["Post_code"] : "brak"); ?></td>
        </tr>
        </tbody>
    </table>
    <a href="/functions/view/view_addresses.php" class="btn btn-secondary">Powrót</a>
</div>
</body>
</html>
