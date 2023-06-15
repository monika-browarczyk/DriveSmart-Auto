<?php
$mysql = new mysqli("localhost", "root", '', "wprg-project");

$city = $street = $streetNumber = $postCode = "";
$errors = [];

if (isset($_POST["submit"])) {
    $city = sanitizeInput($_POST["city"]);
    $street = sanitizeInput($_POST["street"]);
    $streetNumber = sanitizeInput($_POST["street_number"]);
    $postCode = sanitizeInput($_POST["post_code"]);

   if (!validatePostCode($postCode)) {
        $errors[] = "Kod pocztowy powinien być w formacie XX-XXX.";
    }

    if (empty($errors)) {
        $stmt = $mysql->prepare("INSERT INTO addresses (City, Street, Street_number, Post_code) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $city, $street, $streetNumber, $postCode);
        $stmt->execute();

        $addressID = $stmt->insert_id;

        header("Location: /functions/view/view_single_address.php?id=$addressID");
        exit();
    }
}

function sanitizeInput($input)
{
    return htmlspecialchars(trim($input));
}

function validatePostCode($postCode)
{
    $pattern = '/^\d{2}-\d{3}$/';
    return preg_match($pattern, $postCode);
}

?>

<html lang="pl">
<head>
    <title>Dodaj adres</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj adres</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="city">Miasto:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" required>
        </div>
        <div class="form-group">
            <label for="street">Ulica:</label>
            <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>" required>
        </div>
        <div class="form-group">
            <label for="street_number">Numer ulicy:</label>
            <input type="text" class="form-control" id="street_number" name="street_number" value="<?php echo $streetNumber; ?>" required>
        </div>
        <div class="form-group">
            <label for="post_code">Kod pocztowy:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $postCode; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Dodaj</button>
        <a href="/functions/view/view_addresses.php" class="btn btn-secondary">Powrót</a>
    </form>
</div>
</body>
</html>
