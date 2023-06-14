<html lang="pl">
<head>
    <title>Lab10</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-5">Role administracyjne: </h1>
    <div class="d-flex justify-content-between mb-3">
        <?php
        if(!isset($_SESSION)) {
            session_start();
        }
        session_regenerate_id();
        if ($_SESSION['logged'] == '1') { ?>
            <a href="single-add/add_single_role.php" class="btn btn-success btn-sm d-flex align-items-center justify-content-center mb-3 w-25">Dodaj</a>
        <?php } ?>
        <form class="form-inline w-75 ml-5">
            <input type="text" class="form-control rounded w-75" name="search" placeholder="Search">
            <input type="submit" class="btn btn-outline-dark w-25" value="Search">
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Uprawnienia</th>
            <th>Zobacz</th>
            <th>Edytuj</th>
            <th>Usuń</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $mysql = new mysqli("localhost", "root", '', "wprg-project");
        if (isset($_GET["search"])) {
            $search = $_GET["search"];
            $stmt = $mysql->prepare("SELECT * FROM roles WHERE Name LIKE ? OR Permission LIKE ? ORDER BY Name");
            $searchParam = "$search%";
            $stmt->bind_param("ss", $searchParam, $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $mysql->query("SELECT * FROM roles ORDER BY Name");
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Permission"] . "</td>";
            echo '<td><a href="single-view/view_single_role.php?id=' . $row["RolesID"] . '" class="btn btn-info btn-sm">Zobacz</a></td>';
            if ($_SESSION['logged'] == '1' || $_SESSION['logged'] == '2') {
                echo '<td><a href="single-edit/edit_single_role.php?id=' . $row["RolesID"] . '" class="btn btn-warning btn-sm">Edytuj</a></td>';
                echo '<td><a href="single-delete/delete_single_role.php?id=' . $row["RolesID"] . '" class="btn btn-danger btn-sm">Usuń</a></td></tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
