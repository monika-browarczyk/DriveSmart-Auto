<?php
session_start();

if (isset($_POST['submit-view'])) {
    $option = $_POST['option-view'];

    if ($option == 'cars') {
        header("Location: /functions/view/view_cars.php");
        exit;
    } elseif ($option == 'users') {
        header("Location: /functions/view/view_users.php");
        exit;
    } elseif ($option == 'clients') {
        header("Location: /functions/view/view_clients.php");
        exit;
    } elseif ($option == 'roles') {
        header("Location: /functions/view/view_roles.php");
        exit;
    } elseif ($option == 'categories') {
        header("Location: /functions/view/view_categories.php");
        exit;
    } elseif ($option == 'manufacturers') {
        header("Location: /functions/view/view_manufacturers.php");
        exit;
    } elseif ($option == 'employees') {
        header("Location: /functions/view/view_employees.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<h1 class="text-center my-5 px3">Panel administracyjny</h1>
<h4 class="text-center my-5 px3">Jesteś zalogowany jako:
    <?php if($_SESSION['role'] == 'admin') {
        echo "Administrator";
    } elseif ($_SESSION['role'] = 'moderator') {
        echo "Moderator";
    } else {
        echo "Użytkownik";
    }
?></h4>
<form method="post">
    <div class="container my-5 px3">
        <label for="option-view">Wybierz opcję do wyświetlenia:</label>
        <select class="form-control" name="option-view" id="option-view">
            <option value="cars">Podgląd samochodów</option>
            <option value="clients">Podgląd klientów</option>
            <option value="categories">Podgląd kategorii</option>
            <option value="manufacturers">Podgląd firm</option>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <option value="roles">Podgląd ról</option>
            <option value="users">Podgląd użytkowników</option>
            <option value="employees">Podgląd pracowników</option>
     <?php } ?>
        </select>
        <button class="btn btn-primary mt-2" type="submit" name="submit-view">Wybierz</button>
    </div>
</body>
</html>