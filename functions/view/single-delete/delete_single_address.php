<?php
global $mysql;
include("../../config.php");
include("../../../header.php");
?>

    <title>Pojedynczy adres</title>
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dane adresu:</h1>

    <?php
    $addressID = $_GET["id"];
    $stmt = $mysql->prepare("SELECT * FROM Addresses WHERE AddressID = ?");
    $stmt->bind_param("i", $addressID);
    $stmt->execute();
    $result = $stmt->get_result();
    $address = $result->fetch_assoc();
    ?>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>Adres:</td>
            <td><?php
                $addressString = '';
                if ($address["City"]) {
                    $addressString .= $address["City"] . ', ';
                }
                if ($address["Street"]) {
                    $addressString .= $address["Street"] . ', ';
                }
                if ($address["Street_number"]) {
                    $addressString .= $address["Street_number"] . ', ';
                }
                if ($address["Post_code"]) {
                    $addressString .= $address["Post_code"] . ', ';
                }
                echo ($addressString !== '') ? rtrim($addressString, ', ') : 'brak';
                ?>
            </td>
        </tr>
        </tbody>
    </table>

    <a class="btn btn-secondary" href="/functions/view/view_addresses.php">Powrót</a>
</div>

<?php include("../../../footer.php"); ?>
