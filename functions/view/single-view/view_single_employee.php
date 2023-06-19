<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

$employeeID = $_GET["id"];

$stmt = $mysql->prepare("SELECT * FROM employees WHERE EmployeeID = ?");
$stmt->bind_param("i", $employeeID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$firstName = $row["First_name"];
$lastName = $row["Last_name"];
$telephoneNumber = $row["Telephone_number"];
$email = $row["Email"];
$addressID = $row["Addresses_AddressID"];
?>

<title>Podgląd pracownika</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Podgląd pracownika</h1>
    <div class="form-group">
        <label for="first_name">Imię:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $firstName; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="last_name">Nazwisko:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="telephone_number">Numer telefonu:</label>
        <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="<?php echo $telephoneNumber; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="address_id">Adres:</label>
        <input type="text" class="form-control" id="address_id" name="address_id" value="<?php echo $addressID; ?>" readonly>
    </div>
</div>
<?php include("../../../footer.php"); ?>
