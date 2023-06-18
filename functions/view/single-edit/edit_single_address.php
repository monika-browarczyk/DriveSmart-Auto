<?php
global $mysql;
include("../../config.php");
?>
<html lang="pl">
<head>
    <title>Edycja adresu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Edycja adresu:</h1>

    <?php
    $addressID = $_GET["id"];
    $stmt = $mysql->prepare("SELECT * FROM Addresses WHERE AddressID = ?");
    $stmt->bind_param("i", $addressID);
    $stmt->execute();
    $result = $stmt->get_result();
    $address = $result->fetch_assoc();

    $cityError = $streetError = $streetNumberError = $postCodeError = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $city = $_POST["city"];
        $street = $_POST["street"];
        $streetNumber = $_POST["street_number"];
        $postCode = $_POST["post_code"];

        // Walidacja pól
        if (empty($city)) {
            $cityError = "Pole Miasto jest wymagane";
        }

        if (empty($street)) {
            $streetError = "Pole Ulica jest wymagane";
        }

        if (empty($streetNumber)) {
            $streetNumberError = "Pole Numer ulicy jest wymagane";
        }

        if (!preg_match('/^\d{2}-\d{3}$/', $postCode)) {
            $postCodeError = "Nieprawidłowy format kodu pocztowego";
        }

        if (empty($cityError) && empty($streetError) && empty($streetNumberError) && empty($postCodeError)) {
            $stmt = $mysql->prepare("UPDATE Addresses SET City=?, Street=?, Street_number=?, Post_code=? WHERE AddressID=?");
            $stmt->bind_param("ssssi", $city, $street, $streetNumber, $postCode, $addressID);
            $stmt->execute();
            header("Location: /functions/view/view_addresses.php");
            exit();
        }
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="city">Miasto:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $address["City"]; ?>">
            <span class="text-danger"><?php echo $cityError; ?></span>
        </div>
        <div class="form-group">
            <label for="street">Ulica:</label>
            <input type="text" class="form-control" id="street" name="street" value="<?php echo $address["Street"]; ?>">
            <span class="text-danger"><?php echo $streetError; ?></span>
        </div>
        <div class="form-group">
            <label for="street_number">Numer ulicy:</label>
            <input type="text" class="form-control" id="street_number" name="street_number" value="<?php echo $address["Street_number"]; ?>">
            <span class="text-danger"><?php echo $streetNumberError; ?></span>
        </div>
        <div class="form-group">
            <label for="post_code">Kod pocztowy:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $address["Post_code"]; ?>">
            <span class="text-danger"><?php echo $postCodeError; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz</button>
        <a class="btn btn-secondary" href="/functions/view/view_addresses.php">Powrót</a>
    </form>
</div>
</body>
</html>
