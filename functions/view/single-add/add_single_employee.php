<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

$employeeID = "";
$firstName = "";
$lastName = "";
$telephoneNumber = "";
$email = "";
$addressID = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $telephoneNumber = $_POST["telephone_number"];
    $email = $_POST["email"];
    $addressID = $_POST["address_id"];

    $stmt = $mysql->prepare("INSERT INTO employees (EmployeeID, First_name, Last_name, Telephone_number, Email, Addresses_AddressID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $employeeID, $firstName, $lastName, $telephoneNumber, $email, $addressID);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}
?>

    <title>Dodaj pracownika</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj pracownika</h1>
    <form method="post">
        <div class="form-group">
            <label for="first_name">Imię:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $firstName; ?>">
        </div>
        <div class="form-group">
            <label for="last_name">Nazwisko:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>">
        </div>
        <div class="form-group">
            <label for="telephone_number">Numer telefonu:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="<?php echo $telephoneNumber; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label for="address_id">Adres:</label>
            <input type="text" class="form-control" id="address_id" name="address_id" value="<?php echo $addressID; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj pracownika">
    </form>
</div>
<?php include("../../../footer.php"); ?>
