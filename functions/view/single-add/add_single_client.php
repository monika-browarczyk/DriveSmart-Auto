<?php
global $mysql;
include("../../config.php");
include("../../../header.php");

$imie = "";
$nazwisko = "";
$telephone_number = "";
$email = "";
$adres = "";
$id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $telephone_number = $_POST["telephone_number"];
    $email = $_POST["email"];
    $adres = $_POST["adres"];

    $stmt = $mysql->prepare("INSERT INTO clients (First_name, Last_name, Telephone_number, Email, Addresses_AddressID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $imie, $nazwisko, $telephone_number, $email, $adres);
    $stmt->execute();

    header("Location: /functions/admin.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $mysql->prepare("SELECT clients.ClientID, clients.First_name, clients.Last_name, clients.Telephone_number, clients.Email,Addresses.AddressID, Addresses.City, Addresses.Street, Addresses.Street_number, Addresses.Post_code FROM Clients 
                        LEFT JOIN addresses ON clients.Addresses_AddressID = Addresses.AddressID
                        WHERE clients.ClientID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $imie = $row["First_name"];
    $nazwisko = $row["Last_name"];
    $telephone_number = $row["Telephone_number"];
    $email = $row["Email"];
    $adres = $row["AddressID"];
}
?>


    <title>Dodaj osobę</title>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Dodaj osobę</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="imie">Imię:</label>
            <input type="text" class="form-control" id="imie" name="imie" value="<?php echo $imie; ?>">
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" class="form-control" id="nazwisko" name="nazwisko" value="<?php echo $nazwisko; ?>">
        </div>
        <div class="form-group">
            <label for="telephone_number">Numer telefonu:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="<?php echo $telephone_number; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email"
                   value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <div>
                <label for="adres" class="my-2">Adres:</label>
                <select class="form-control" name="adres">
                    <?php
                    $stmt = $mysql->query("SELECT * FROM Addresses ORDER BY City ASC");
                    while ($row = $stmt->fetch_assoc()) {
                        echo "<option value='" . $row["AddressID"] . "'>" . $row["City"] . " " . $row["Street"] . " " . $row["Street_number"] . " " . $row["Post_code"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Zapisz zmiany">
    </form>
</div>

<?php include("../../../footer.php"); ?>
