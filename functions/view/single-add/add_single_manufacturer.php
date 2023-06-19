<?php
global $mysql;
include_once("../../config.php");
include("../../../header.php");

if (isset($_POST["submit"])) {
    $manufacturerName = $_POST["manufacturer_name"];
    $registrationDate = $_POST["registration_date"];
    $description = $_POST["description"];
    $originCountry = $_POST["origin_country"];

    $stmt = $mysql->prepare("INSERT INTO manufacturers (Manufacturer_name, Registration_date, Description, Origin_country) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $manufacturerName, $registrationDate, $description, $originCountry);
    $stmt->execute();

    $manufacturerID = $stmt->insert_id;

    header("Location: /functions/view/view_single_manufacturer.php?id=$manufacturerID");
    exit();
}
?>

    <title>Dodaj producenta</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj producenta</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="manufacturer_name">Nazwa producenta:</label>
            <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" required>
        </div>
        <div class="form-group">
            <label for="registration_date">Data rejestracji:</label>
            <input type="date" class="form-control" id="registration_date" name="registration_date">
        </div>
        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="origin_country">Kraj pochodzenia:</label>
            <input type="text" class="form-control" id="origin_country" name="origin_country">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Dodaj">
    </form>
    <a href="/functions/view/view_manufacturers.php" class="btn btn-secondary">Powrót</a>
</div>

<?php include("../../../footer.php"); ?>

