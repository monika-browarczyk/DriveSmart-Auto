    <?php
    global $mysql;
    $id = $_GET["id"];
    include_once("../../config.php");    $stmt = $mysql->prepare("SELECT users.*, roles.Name AS Role_name, employees.First_name, employees.Last_name FROM users 
        LEFT JOIN roles ON users.Roles_RolesID = roles.RolesID
        LEFT JOIN employees ON users.Employees_EmployeeID = employees.EmployeeID
        WHERE UserID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $role = $_POST["role"];
        $employeeID = $_POST["employeeID"];

        $stmt = $mysql->prepare("UPDATE users SET Login = ?, Roles_RolesID = ?, Employees_EmployeeID = ? WHERE UserID = ?");
        $stmt->bind_param("siii", $login, $role, $employeeID, $id);
        $stmt->execute();
        echo '<div class="alert alert-success" role="alert">Dane użytkownika zostały zaktualizowane!</div>';
    }
    ?>

    <title>Edytuj użytkownika</title>
    </head>
    <body>
    <div class="container w-50 my-5 mx-auto">
        <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
        <h1>Edytuj użytkownika</h1>
    <form method="POST">
        <div class="form-group">
            <label for="login">Login użytkownika:</label>
            <input type="text" class="form-control" id="login" name="login" value="<?php echo $row['Login']; ?>">
        </div>
        <div class="form-group">
            <label for="role">Rola:</label>
            <select class="form-control" id="role" name="role">
                <option value="1" <?php if ($row['Roles_RolesID'] == 1) echo 'selected'; ?>>Administrator</option>
                <option value="2" <?php if ($row['Roles_RolesID'] == 2) echo 'selected'; ?>>Pracownik</option>
                <option value="3" <?php if ($row['Roles_RolesID'] == 3) echo 'selected'; ?>>Użytkownik</option>
            </select>
        </div>
        <div class="form-group">
            <label for="employeeID">ID pracownika:</label>
            <input type="number" class="form-control" id="employeeID" name="employeeID" value="<?php echo $row['Employees_EmployeeID']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>

