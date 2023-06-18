<?php
include_once ("./config.php");
include ("../header.php");
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
    } elseif ($option == 'addresses') {
        header("Location: /functions/view/view_addresses.php");
    }
}
?>

    <title>Panel administracyjny</title>
</head>
<body>
<h1 class="text-center my-5 px3">Panel administracyjny</h1>
<h4 class="text-center my-5 px3">Jesteś zalogowany jako:
    <?php if($_SESSION['logged'] == 1) {
        echo "Administrator";
    } elseif ($_SESSION['logged'] = 2) {
        echo "Moderator";
    } else {
        echo "Użytkownik";
    }
?></h4>
<form method="post">
    <div class="container my-5 px3">
        <label for="option-view">Wybierz opcję do wyświetlenia:</label>
        <select class="form-control" name="option-view" id="option-view">
            <option value="categories">Podgląd kategorii</option>
            <option value="clients">Podgląd klientów</option>
            <option value="employees">Podgląd pracowników</option>
            <option value="manufacturers">Podgląd producentów</option>
            <option value="cars">Podgląd samochodów</option>
            <?php if ($_SESSION['logged'] == 1) { ?>
                <option value="addresses">Podgląd adresów</option>
                <option value="roles">Podgląd ról</option>
                <option value="users">Podgląd użytkowników</option>
     <?php } ?>
        </select>
        <button class="btn btn-primary mt-2" type="submit" name="submit-view">Wybierz</button>
    </div>
</form>
</body>
</html>