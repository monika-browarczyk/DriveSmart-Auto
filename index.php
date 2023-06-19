<?php
include './header.php';
include './functions/config.php';
global $mysql;
?>

<body class="home">
    <div id="slider" class="carousel slide mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
            <li data-target="#slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="aspect-ratio">
                    <img src="/assets/images/image1.jpg" class="d-block img-fluid" alt="Image 1">
                </div>
            </div>
            <div class="carousel-item">
                <div class="aspect-ratio">
                    <img src="/assets/images/image2.jpg" class="d-block img-fluid" alt="Image 2">
                </div>
            </div>
            <div class="carousel-item">
                <div class="aspect-ratio">
                    <img src="/assets/images/image3.jpg" class="d-block img-fluid" alt="Image 3">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev ml-3" href="#slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next mr-3" href="#slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container pt-5">
        <h1 class="text-center mb-5">Kategorie</h1>
        <div class="input-group rounded mb-5">
        </div>

        <?php
        $stmt = $mysql->query("SELECT * FROM Categories");

        $columnsPerRow = 2;

        $rowCount = 0;
        while ($row = $stmt->fetch_assoc()) {
            if ($rowCount % $columnsPerRow === 0) {
                echo '<div class="row">';
            }

            echo '<div class="col-md-6 px-5">';
            echo '<div class="card mb-5 category-card">';
            echo '<img src="' . $row["ImagePath"] . '" class="card-img-top" alt="Obrazek">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title"><a href="/functions/filtr.php?CategoryID=' . $row["CategoryID"] . '">' . $row["Name"] . '</a></h5>';
            echo '<p class="card-text">Liczba samochodów: ' . getCarCountByCategoryId($mysql, $row["CategoryID"]) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $rowCount++;

            if ($rowCount % $columnsPerRow === 0) {
                echo '</div>';
            }
        }

        if ($rowCount % $columnsPerRow !== 0) {
            echo '</div>';
        }

        function getCarCountByCategoryId($mysql, $categoryId) {
            $stmt = $mysql->prepare("SELECT COUNT(*) as count FROM Cars WHERE CategoryID = ?");
            $stmt->bind_param("i", $categoryId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row["count"];
        }
        ?>
    </div>
    <div class="container my-5 py-5">
        <div class="row mb-5">
            <div class="col-md-6">
                <h1>Z nami stać cię na lepsze auto</h1>
                <br>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="fas fa-check"></i> Nasi doświadczeni, certyfikowani konsultanci finansowi zaoferują Państwu niezależną poradę finansową na podstawie pisemnej oferty finansowej od konkurencji</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Ocenią korzyści sfinansowania samochodu oraz innych usług</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Nasze usługi obejmują również kompleksową obsługę formalności związanych z zakupem, finansowaniem i ubezpieczeniem auta</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Zaufało nam już tysiące klientów, którzy skorzystali z naszych usług i cieszą się lepszymi samochodami</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="/assets/images/komis1.jpg" class="img-fluid" alt="Komis samochodowy">
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-6">
                <img src="/assets/images/komis2.png" class="img-fluid" alt="Komis samochodowy">
            </div>
            <div class="col-md-6">
                <h1>Zapłacimy gotówką za Twoje auto w każdym czasie.</h1>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="fas fa-check"></i> Tylko u nas otrzymasz najkorzystniejszą, rynkową wycenę skupu za swoje auto oraz pieniądze w gotówce</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Samochód przyjedziemy odkupić od Ciebie nawet z pod domu</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Działamy szybko i profesjonalnie, zapewniając pełne bezpieczeństwo i transparentność transakcji</li>
                    <li class="mb-3"><i class="fas fa-check"></i> Jesteśmy liderem na rynku skupu samochodów i gwarantujemy uczciwe i sprawiedliwe warunki sprzedaży</li>
                </ul>
            </div>
        </div>
    </div>

<?php
include './footer.php';
