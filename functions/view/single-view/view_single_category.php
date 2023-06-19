<?php
global $mysql;
include("../../config.php");
include("../../../header.php");
?>

    <title>Pojedyncza osoba</title>
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dane osoby:
        <?php
        $id = $_GET["id"];
        $stmt = $mysql->prepare("SELECT COUNT(cars.CarID) as Ilosc_samochodow, categories.Name, categories.CategoryID, categories.Description FROM categories
                                        JOIN cars ON categories.Cate
                                        GROUP BY categories.CategoryID
                                        HAVING categories.CategoryID = ?
                                        ORDER BY Ilosc_samochodow;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $row["Name"];
        ?>
    </h1>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>Nazwa:</td>
            <td><?php echo ($row["Name"] ? $row["Name"] : "brak")?></td>
        </tr>
        <tr>
            <td>Opis:</td>
            <td><?php echo ($row["Description"] ? $row["Description"] : "brak")?></td>
        </tr>
        <tr>
            <td>Ilość przypisanych samochodów:</td>
            <td><?php echo ($row["Ilosc_samochodow"] ? $row["Ilosc_samochodow"] : "brak")?></td>
        </tr>
        </tbody>
    </table>
</div>
<?php include("../../../footer.php"); ?>
