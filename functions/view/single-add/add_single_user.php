<?php
global $mysql;
global $db;
include("../../config.php");
include("../../../header.php");
?>

    <title>Dodaj użytkownika</title>
</head>
<body>
<div class="container w-50 my-5 mx-auto">
    <a class="btn btn-info mb-5" href="/index.php" type="button"><- Strona Główna</a>
    <h1>Dodaj użytkownika</h1>

    <?php
    include_once("../../config.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();

        $login = $_POST["login"];
        $password = $_POST["password"];
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $role = $_POST["role"];
        $employeeID = $_POST["employeeID"];

        if (empty($login) || empty($password) || empty($role) || empty($employeeID)) {
            $errors[] = "Wszystkie pola muszą być wypełnione!";
        }

        $stmt = $mysql->prepare("SELECT UserID FROM users WHERE Login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Podana nazwa użytkownika jest już zajęta!";
        }

        $stmt = $mysql->prepare("SELECT EmployeeID FROM employees WHERE EmployeeID = ?");
        $stmt->bind_param("i", $employeeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $errors[] = "Podane ID pracownika nie istnieje!";
        }

        if (empty($errors)) {
            $sth = $db->prepare('INSERT INTO Users (Login, Password, Roles_RolesID, Employees_EmployeeID) VALUES (:login, :password, :role, :employeeID)');
            $sth->bindValue(':login', $login, PDO::PARAM_STR);
            $sth->bindValue(':password', $hashPassword, PDO::PARAM_STR);
            $sth->bindValue(':role', $role, PDO::PARAM_STR);
            $sth->bindValue(':employeeID', $employeeID, PDO::PARAM_STR);
            $sth->execute();

            echo '<div class="alert alert-success" role="alert">Nowy użytkownik został dodany</div>';
            echo '<a href="/functions/view/view_users.php">Zaloguj</a>';
        } else {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
        }
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="login">Login użytkownika:</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="form-group">
            <label for="password">Hasło:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="role">Rola:</label>
            <select class="form-control" id="role" name="role">
                <option value="1">Administrator</option>
                <option value="2">Pracownik</option>
                <option value="3">Użytkownik</option>
            </select>
        </div>
        <div class="form-group">
            <label for="employeeID">ID pracownika:</label>
            <input type="number" class="form-control" id="employeeID" name="employeeID">
        </div>
        <button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
    </form>
</div>

<?php include("../../../footer.php"); ?>

