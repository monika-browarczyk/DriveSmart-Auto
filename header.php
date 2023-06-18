<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/favicon.svg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark py-4 px-5">
        <a class="navbar-brand" href="#">DriveSmart Auto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Strona główna</a>
                </li>
                <li class="nav-item pl-5">
                    <a class="nav-link" href="/functions/filtr.php">Nasza oferta</a>
                </li>
                <li class="nav-item pl-5">
                    <a class="nav-link" href="/o_nas.php">O nas</a>
                </li>
                <li class="nav-item pl-5">
                    <a class="nav-link" href="/kontakt.php">Kontakt</a>
                </li>
                <li class="nav-item pl-5">
                    <a class="nav-link" href="/functions/registration.php">Rejestracja</a>
                </li>
                <li class="nav-item pl-5">
                    <?php
                    if (isset($_SESSION["logged"])) {
                        echo '<a class="nav-link font-weight-bold text-white" href="/functions/admin.php">Panel administracyjny</a>';
                    } else {
                        echo '<a class="nav-link" href="/functions/login.php">Logowanie</a>';
                    }
                    ?>
                </li>
                <li class="nav-item pl-5">
                    <a class="nav-link" href="/functions/logout.php">Wyloguj</a>
                </li>
            </ul>
            <button class="btn btn-danger fixed-button">
                <a href="kontakt.php" style="color: white; text-decoration: none;">
                    Zamów już teraz
                </a>
            </button>
        </div>
    </header>
