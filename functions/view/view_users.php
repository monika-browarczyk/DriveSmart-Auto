<?php
global $mysql;
include("../config.php");
include ("../../header.php");
?>
<html lang="pl">
<head>
    <title>Lab10</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Użytkownicy </h1>
    <div class="d-flex justify-content-between mb-3">
        <?php
        if(!isset($_SESSION)) {
            session_start();
        }
        session_regenerate_id();
        if ($_SESSION['logged'] == '1') { ?>
            <a href="single-add/add_single_user.php" class="btn btn-success btn-sm d-flex align-items-center justify-content-center mb-3 w-25">Dodaj</a>
        <?php } ?>
        <form class="form-inline w-75 ml-5">
            <input type="text" class="form-control rounded w-75" name="search" placeholder="Search">
            <input type="submit" class="btn btn-outline-dark w-25" value="Search">
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Login</th>
            <th>Rola</th>
            <th>ID pracownika</th>
            <th>Zobacz</th>
            <th>Edytuj</th>
            <th>Usuń</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_GET["search"])) {
            $search = $_GET["search"];
            $stmt = $mysql->prepare("SELECT users.UserID, users.Login, users.Employees_EmployeeID, users.Roles_RolesID, roles.Name FROM users
                LEFT JOIN roles ON users.Roles_RolesID = roles.RolesID
                WHERE Login LIKE ? OR Name LIKE ? OR Employees_EmployeeID = ? ORDER BY Login");
            $searchParam = "$search%";
            $stmt->bind_param("ssi", $searchParam, $searchParam, $search);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $mysql->query("SELECT users.UserID, users.Login, users.Roles_RolesID, users.Employees_EmployeeID, roles.Name FROM users
                LEFT JOIN roles ON users.Roles_RolesID = roles.RolesID
                ORDER BY Login");
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Login"] . "</td><td>" . $row["Name"] . "</td>" . "<td>" . $row["Employees_EmployeeID"] . "</td>";
            echo '<td><a href="single-view/view_single_user.php?id=' . $row["UserID"] . '" class="btn btn-info btn-sm">Zobacz</a></td>';
            if ($_SESSION['logged'] == '1' || $_SESSION['logged'] == '2') {
                echo '<td><a href="single-edit/edit_single_user.php?id=' . $row["UserID"] . '" class="btn btn-warning btn-sm">Edytuj</a></td>';
                echo '<td><a href="single-delete/delete_single_user.php?id=' . $row["UserID"] . '" class="btn btn-danger btn-sm">Usuń</a></td></tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
include ("../../footer.php");
?>