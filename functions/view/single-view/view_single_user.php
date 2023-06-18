<html lang="pl">
<head>
    <title>Informacje o użytkowniku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dane o samochodzie:
        <?php
        $id = $_GET["id"];
        include_once("../../config.php");        $stmt = $mysql->prepare("SELECT users.Login, roles.Name as Role_name, employees.EmployeeID, employees.First_name, employees.Last_name FROM `users` 
            LEFT JOIN employees ON users.Employees_EmployeeID = employees.EmployeeID
            LEFT JOIN roles ON users.Roles_RolesID = roles.RolesID
            WHERE UserID = ? 
            ORDER BY Login;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $row["Login"] . " " . $row["Role_name"];
        ?>
    </h1>

    <table class="table my-5">
        <tbody>
        <tr>
            <td>Login użytkownika:</td>
            <td><?php echo($row["Login"] ? $row["Login"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Rola:</td>
            <td><?php echo($row["Role_name"] ? $row["Role_name"] : "brak") ?></td>
        </tr>
        <tr>
            <td>ID pracownika:</td>
            <td><?php echo($row["EmployeeID"] ? $row["EmployeeID"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Imię:</td>
            <td><?php echo($row["First_name"] ? $row["First_name"] : "brak") ?></td>
        </tr>
        <tr>
            <td>Nazwisko:</td>
            <td><?php echo($row["Last_name"] ? $row["Last_name"] : "brak") ?></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
