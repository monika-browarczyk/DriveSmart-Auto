<?php
include './header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nas - Komis Samochodowy</title>
</head>

<body class="about-page">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Strona główna</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">O nas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Oferta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kontakt</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="about-section">
        <div class="row">
            <div class="col-md-12">
                <h2 class="about-heading">O nas</h2>
                <p class="about-content">Jesteśmy profesjonalnym komisem samochodowym działającym na rynku od
                    wielu lat. Oferujemy szeroki wybór samochodów używanych w atrakcyjnych cenach. Nasza misja to
                    zapewnienie klientom satysfakcji i pełnego zadowolenia z zakupionego samochodu. Zaufało nam już
                    wielu klientów, dołącz do nas i przekonaj się o naszych kompetencjach.</p>
            </div>
        </div>
    </div>

    <div class="team-section">
        <div class="row">
            <div class="col-md-12">
                <h2 class="about-heading">Nasz zespół</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="team-member">
                    <img src="/assets/images/employee1.jpg" alt="Członek zespołu 1">
                    <div class="team-member-name">Jan Kowalski</div>
                    <div class="team-member-position">Doradca ds. sprzedaży</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="/assets/images/employee2.jpg" alt="Członek zespołu 2">
                    <div class="team-member-name">Anna Nowak</div>
                    <div class="team-member-position">Specjalista ds. finansowania</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <img src="/assets/images/employee3.jpg" alt="Członek zespołu 3">
                    <div class="team-member-name">Piotr Wiśniewski</div>
                    <div class="team-member-position">Serwisant</div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="row">
            <div class="col-md-12">
                <h2 class="contact-heading">Kontakt</h2>
                <p class="contact-info">
                    Telefon: 123-456-789<br>
                    E-mail: info@komissamochodowy.pl<br>
                    Adres: ul. Plac Defilad 1, 00-901 Warszawa
                </p>
            </div>
        </div>
    </div>

    <div class="directions-section">
        <div class="row">
            <div class="col-md-12">
                <h2 class="directions-heading">Dojazd</h2>
                <p class="directions-content">
                    Nasz komis samochodowy znajduje się w centrum Warszawy, przy ulicy Przykładowej 1. Możesz do nas
                    dotrzeć korzystając z komunikacji miejskiej lub własnego samochodu. W pobliżu znajdują się
                    przystanki autobusowe i stacja metra. Zapewniamy także wygodne miejsca parkingowe dla naszych
                    klientów.
                </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19551.181531999286!2d21.00031622511029!3d52.227076529798225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc8c92692e49%3A0xc2e97ae5311f2dc2!2sPa%C5%82ac%20Kultury%20i%20Nauki!5e0!3m2!1spl!2spl!4v1687013048823!5m2!1spl!2spl" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <div class="offer-section">
        <div class="row">
            <div class="col-md-12">
                <h2 class="offer-heading">Oferta</h2>
                <ul class="offer-list">
                    <li class="offer-item">Bogaty wybór samochodów używanych</li>
                    <li class="offer-item">Sprzedaż samochodów marek premium</li>
                    <li class="offer-item">Atrakcyjne warunki finansowania</li>
                    <li class="offer-item">Gwarancja jakości</li>
                    <li class="offer-item">Profesjonalne doradztwo i obsługa klienta</li>
                </ul>
            </div>
        </div>
    </div>
</div>




<?php
include './footer.php';
