<?php
include_once("../../config.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if (isset($_POST["submit"])) {
        $manufacturerName = $_POST["manufacturer_name"];
        $registrationDate = $_POST["registration_date"];
        $description = $_POST["description"];
        $originCountry = $_POST["origin_country"];

        $stmt = $mysql->prepare("UPDATE manufacturers SET Manufacturer_name = ?, Registration_date = ?, Description = ?, Origin_country = ? WHERE ManufacturerID = ?");
        $stmt->bind_param("ssssi", $manufacturerName, $registrationDate, $description, $originCountry, $id);
        $stmt->execute();

        header("Location: /functions/view/view_single_manufacturer.php?id=$id");
        exit();
    } else {
        $stmt = $mysql->prepare("SELECT * FROM manufacturers WHERE ManufacturerID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $manufacturer = $result->fetch_assoc();

        if (!$manufacturer) {
            header("Location: /functions/view/view_manufacturers.php");
            exit();
        }
    }
} else {
    header("Location: /functions/view/view_manufacturers.php");
    exit();
}
?>

<html lang="pl">
<head>
    <title>Edytuj producenta</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Edytuj producenta</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="manufacturer_name">Nazwa producenta:</label>
            <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" value="<?php echo $manufacturer["Manufacturer_name"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="registration_date">Data rejestracji:</label>
            <input type="date" class="form-control" id="registration_date" name="registration_date" value="<?php echo $manufacturer["Registration_date"]; ?>">
        </div>
        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea class="form-control" id="description" name="description"><?php echo $manufacturer["Description"]; ?></textarea>
        </div>
        <div class="form-group">
            <label for="origin_country">Kraj pochodzenia:</label>
            <input type="text" class="form-control" id="origin_country" name="origin_country" value="<?php echo $manufacturer["Origin_country"]; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Zapisz zmiany">
    </form>
    <a href="/functions/view/view_manufacturers.php?id=<?php echo $id; ?>" class="btn btn-secondary">Powrót</a>
</div>
</body>
</html>
